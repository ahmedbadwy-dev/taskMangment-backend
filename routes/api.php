<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::controller(AuthController::class)->group(function(){

    Route::post("/register", "store");
    Route::post("/login", "index");
    
    });
    Route::middleware("auth:sanctum")->group(function(){
        
    Route::post("/logout",[AuthController::class, "logout" ] );
    Route::post("/auth", [AuthController::class, "checkAuth"]);

Route::controller(PostController::class)->group(function(){

        Route::post("/posts", "store");
        Route::put("/posts/{post}", "update");
        Route::delete("/posts/{post}", "destroy");
        Route::get("/posts", "index");
        Route::post("/image/{post}", "upload");

});


});




