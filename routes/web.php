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

 Route::get('/email',function(){
     return view('pages.misc.error');
 });

Route::get('/details/{id}',"WelcomeController@details")->name('details');

Route::get('/', "WelcomeController@index")->name('welcome');

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
    Route::get('/profile',"UserController@profile")->name('profile');
    Route::put('/profile/update',"UserController@updateProfile")->name('profile.update');

    // reviews
    Route::resource('review',"ReviewController");

    // Sub categories
    Route::group(['prefix'=>'subcategory'],function(){
        Route::get('/',"SubCategoryController@index")->name('subcategory.index');
        Route::get('/create',"SubCategoryController@create")->name('subcategory.create');
        Route::post('/store',"SubCategoryController@store")->name('subcategory.store');
        Route::get('/edit/{subcategory}',"SubCategoryController@edit")->name('subcategory.edit');
        Route::put('/update/{subcategory}',"SubCategoryController@update")->name('subcategory.update');
        Route::delete('/delete/{subcategory}',"SubCategoryController@delete")->name('subcategory.delete');
        Route::get('/get',"SubCategoryController@getsubcategory")->name('subcategory.get');
    });

    // author
    Route::resource('author',"AuthorController");

    //mobile slider
    Route::get("/mobile/slider","MobileSlider@index")->name('mobile.slider');
    Route::get('/mobile/slider/create',"MobileSlider@create")->name('mobile.slider.create');
    Route::post('/mobile/slider',"MobileSlider@store")->name('mobile.slider.store');
    Route::get("/mobile/slider/{id}/edit","MobileSlider@edit")->name('mobile.slider.edit');
    Route::put("/mobile/slider/{id}","MobileSlider@update")->name('mobile.slider.update');
    Route::delete('/mobile/slider/{id}',"MobileSlider@delete")->name('mobile.slider.delete');
});

