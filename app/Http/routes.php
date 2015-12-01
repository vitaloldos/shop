<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/', [
    'as' => 'home',
    'uses' => 'PagesController@home'
]);

Route::resource('products', 'ProductsController');
Route::get('api/products', array('as'=>'api.products', 'uses'=>'ProductsController@getDatatable'));
Route::get('api/dropdown', array('as'=>'api.dropdown', 'uses'=>'ProductsController@getDropdown'));

Route::resource('categories', 'CategoriesController');
Route::get('api/categories', array('as'=>'api.categories', 'uses'=>'CategoriesController@getDatatable'));
//Route::get('api/dropdown', array('as'=>'api.dropdown', 'uses'=>'ProductsController@getDropdown'));

Route::resource('images', 'ImagesController');
Route::post('images/change', array('as'=>'images.change', 'uses'=>'ImagesController@postChange'));

Route::resource('discounts', 'DiscountsController');
Route::get('api/discounts', array('as'=>'api.discounts', 'uses'=>'DiscountsController@getDatatable'));