<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('login', 'API\AuthController@login');
Route::post('register', 'API\AuthController@register');
 
Route::middleware('auth:api')->group(function(){
 
  Route::post('profile', 'API\AuthController@user_detail');
  
});