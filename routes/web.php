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
});


Route::get('/catalog', "ItemController@showItems");                        //showItems 
Route::get('/menu/mycart', "ItemController@showCart");                     //showCart 
Route::get('/menu/mycart/{id}/delete', "ItemController@deleteCart");       //deleteCart 
Route::get('/menu/clearcart', "ItemController@clearCart");                 //clearCart 
Route::patch('/menu/mycart/{id}/changeQty', "ItemController@updateCart");  //updateCart 
Route::post('/addToCart/{id}',"ItemController@addToCart");           		//addToCart
Route::get("menu/categories/{id}", "CategoryController@findItems");              

	
Route::middleware("auth")->group(function() {
	Route::get('/menu/add', "ItemController@showAddItemForm");              //showItems
	Route::post("/menu/add", "ItemController@saveItems");                   //showCart
	Route::get('/menu/{id}', "ItemController@itemDetails");                 //deleteCart
	Route::delete('/menu/{id}/delete', "ItemController@deleteItem");        //clearCart
	Route::get('/menu/{id}/edit', "ItemController@showEditForm");           //updateCart
	Route::patch('/menu/{id}/edit', "ItemController@editItem");             //addToCart
});


// php artisan:make auth=
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
