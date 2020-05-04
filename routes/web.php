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
    return redirect()->route('login');
})->name('welcome');

// Route::get('/login', function () {
//     return response()->json(['error' => "Invalid token."],400);
// })->name('login');

Auth::routes();

Route::group(['middleware'=>"CheckForAdmin"],function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('genre',"GenreController");
    Route::post("/genre/search",'GenreController@search')->name('genre.search');

    //books
    Route::get('/book/recommended',"BookController@recommended")->name('book.recommended');
    Route::get('/book/bestselling',"BookController@bestselling")->name('book.bestselling');
    Route::resource('book',"BookController");
    Route::post("/book/search","BookController@search")->name('book.search');
    Route::post('/book/handlerecommended','BookController@handleRecommended')->name('book.handle.recommended');
    Route::post('/book/handlebestselling','BookController@handleBestSelling')->name('book.handle.bestselling');
    
    // user
    Route::resource('user',"UserController");
    Route::post('/user/search',"UserController@search")->name('user.search');

    // reviews
    Route::resource('review',"ReviewController");
});

