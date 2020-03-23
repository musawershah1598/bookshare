<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::group(["namespace" => "Api"], function () {
    Route::post('auth/login', "AuthController@login");
    Route::post("auth/register", "AuthController@register");
    Route::group(['middleware'=>"auth:api"],function(){
        Route::get('/user', "AuthController@getUser");
        Route::put("/user","AuthController@updateUser");
        Route::post('/user/image/upload',"AuthController@uploadimage");

        // books route
        Route::get('/book',"BookController@getbook");
        Route::get("/books","BookController@getbooks");
        Route::get("/books/search","BookController@search");
    });
});
