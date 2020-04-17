<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route::get('/login', function () {
//     return response()->json(['error' => "Invalid token."],400);
// })->name('login');

Auth::routes();

Route::group(['middleware'=>"CheckForAdmin"],function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('genre',"GenreController");
    Route::resource('book',"BookController");

    // user
    Route::resource('user',"UserController");
    Route::post('/user/search',"UserController@search")->name('user.search');
});

