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
    Route::get("auth/email/verify","AuthController@verify")->name("api.email.verify");
    Route::get("auth/email/resend","AuthController@resendEmail");
    Route::group(['middleware'=>"auth:api"],function(){
        Route::get('/user', "AuthController@getUser");
        Route::put("/user","AuthController@updateUser");
        Route::post('/user/image/upload',"AuthController@uploadimage");

        // authors
        Route::get('/authors',"BookController@getAuthors");

        // books route
        Route::get('/book',"BookController@getbook");
        Route::get("/books","BookController@getbooks");
        Route::get("/books/search","BookController@search");
		Route::get("/books/addview","BookController@addview");
        Route::get("/books/adddownload","BookController@adddownload");
        Route::get('/books/all',"BookController@allBooks");

        // reviews
        Route::get("/review","ReviewController@getReviews");
        Route::post("/review/create","ReviewController@create");

        // bookmarks
        Route::get('/bookmark','BookmarkController@getbookmarks');
        Route::get('/bookmark/check',"BookmarkController@checkbookmark");
        Route::post("/bookmark/add","BookmarkController@add");
        Route::post('bookmark/remove',"BookmarkController@removebookmark");

        // genres
        Route::get("/genre","GenreController@index");
        Route::get("/genre/books","GenreController@books");
    });
});
