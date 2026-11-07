<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Mail\NewPostNotificationMail;
use Illuminate\Support\Facades\Mail;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(post $post): void
    {
           $post->load("user");
        $users=User::select(["name", "email","id"])->get();
        if($users && $post->user->name && $post){

            foreach ($users as $user) {
                Mail::to($user->email)->send(new NewPostNotificationMail($post, $user));
            }
        }
        }

    /**
     * Handle the Post "updated" event.
     */
    public function updating(Post $post): void
    {
        if ($post->isDirty('image')) {
            $oldImage = $post->getRawOriginal('image');
            if(!empty($oldImage)){

                Storage::disk('public')->delete($oldImage);
            }
        }
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        if($post->image && Storage::disk("public")->exists($post->image)){

            Storage::disk("public")->delete($post->image);
        }
        

    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}
