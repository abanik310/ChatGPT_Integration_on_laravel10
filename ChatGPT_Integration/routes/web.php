<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OpenAiController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('login',[UserController::class,'view_login']);
Route::post('check_login',[UserController::class,'check_login']);

Route::group(['middleware' => 'auth:sanctum'],function(){
    Route::get('chat_page',[UserController::class,'chat_page']);
    Route::get('user',[UserController::class,'userDetails']);
    Route::post('chat_gpt',[OpenAiController::class,'index']);
    Route::get('logout',[UserController::class,'logout']);
});
