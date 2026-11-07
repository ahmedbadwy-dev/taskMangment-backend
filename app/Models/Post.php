<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
protected $fillable = ["title","post_content","image","user_id"];

function user(){

return $this->belongsTo(User::class);

}
}

