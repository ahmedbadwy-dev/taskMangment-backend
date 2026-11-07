<?php

namespace App\Http\Controllers;

use App\Http\Requests\posts\PostRequest;
use App\Http\Resources\PostPaginateResource;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Request  $request )
    {
        $querySearch=$request->input("search");
           $postQuery=Post::query()->select(["title","post_content","image","id"]);
        if($querySearch){
            $data=$postQuery->where("title","like","%".$querySearch."%")->paginate(10);
        }
        else{
          $data=$postQuery->paginate(10);
        
        }
        if($data){
            return PostPaginateResource::collection($data)
             ->response()->setStatusCode(200);
        }
        else{
            return response()->json(["success" => false, "message"=>"لا توجد نتائج الان "],404);
        }
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
         $field=$request->validated();
         $field["user_id"]=auth()->id();
        $post= Post::create($field);    
           
return(PostResource::make($post)->additional(["success"=>true,"message"=>"تم انشاء البوست بنجاح", "status" => 201])->response()->setStatusCode(201));
    }


     /* Show the form for editing the specified resource.
     */
    public function upload(Request $request,post $post)
    {
      
        if ($request->hasFile("image")) {

            $validator = Validator::make($request->all(), [
                'image' => 'required|image| mimes:jpeg,jpg| max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $newname=$request->file("image")->store("posts","public");
            try {
                DB::beginTransaction();

                $post->update([
                    'image' => $newname
                ]);
                  DB::commit();
                return response()->json(["message"=>"the image is ready","success"=>true,"data"=>["path"=>$newname]]);
                
            } catch (\Throwable $th) {
                 DB::rollBack();
                Storage::disk('public')->delete($newname); 
                return response()->json(["success"=>false,
                
                                        "message"=>"يوجد خطا اثناء رفع الصوره"
                                        
                
                ]);
            }

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, post $post)
    {
         $data=$request->validated();
        if ($request->hasFile("image")) {
        
            Storage::disk('public')->delete($post->image);
           $path= $request->file("image")->store("posts","public");
             $data["image"]=$path;
           }


        $post->update($data);
                 
          return (PostResource::make($post)->additional(["success"=>true,"message"=>"تم التعديل بنجاح"]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( post $post)
    {
        try{
            DB::beginTransaction();
            $path=$post->image;
            $post->delete();
            if($path){
            Storage::disk('public')->delete($path);
            }
            DB::commit();
          return response()->json(["message"=>"post deleted successfuly", "success"=>true],200);
    }catch(\Exception $e){
         DB::rollBack();
          return response()->json(["message"=>"there error is unexpected", "success"=>false],500);
         
     
    }
}




}
