<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthResource;
use Exception;
use Illuminate\Support\Facades\Hash;
use Nette\Schema\Message;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request )
    {
        $field=$request->all();
        $user=User::where("email", $field["email"])->first();
 
   if(!$user||!Hash::check($field["password"],$user->password)){

      return response()->json([
        "success"=>false,
         "message"=>"الرمز او الايميل غير صحيح"  
      ],422);

   }

    $token=$user->createToken("auth-token")->plainTextToken;    
    
    return AuthResource::make($user)->additional(["token"=>$token,
     
    "status"=>201,
    "message"=>"تم التسجيل بنجاح"
 

    ])->response()->setStatusCode(200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        $fields=$request->validated();

          $fields["password"]=Hash::make($fields["password"]);

       $user= User::create($fields);
        return(AuthResource::make($user)->additional(["success"=>true,"message"=>"تم التسجيل بنجاح"])); 
    }

    /**
     * Display the specified resource.
     */
    public function logout(Request $request)
    {
          try{
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => true,
            'message' => 'تم تسجيل الخروج بنجاح.'
        ], 200);
          }
          catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'حدث خطا غير متوقع'
            ], 500);
          }
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function checkAuth(Request $request)
    {
        return response()->json([
            "message"=>"المستخدم مسجل"
        ]
        ,200);
    }

    
}
