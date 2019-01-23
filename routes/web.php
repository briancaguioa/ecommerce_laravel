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


Route::get('/catalog', "ItemController@showItems");

Route::get('/menu/add', "ItemController@showAddItemForm");

Route::post("/menu/add", "ItemController@saveItems");

Route::get('/menu/{id}', "ItemController@showDetails");

