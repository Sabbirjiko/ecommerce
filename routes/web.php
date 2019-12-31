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

Route::get('/','IndexController@index')->name('frontend_index');
Route::any('/admin','AdminController@login')->name('admin_login');
Auth::routes();

Route::group(['middleware' => ['auth'],'prefix'=>'admin'], function () {
	
	Route::get('dashboard', 'AdminController@dashboard')->name('admin_dashboard');
	Route::get('settings', 'AdminController@settings')->name('admin_settings');
	Route::get('check_pass', 'AdminController@check_pass')->name('admin_check_pass');
	Route::any('update_pass', 'AdminController@update_pass')->name('admin.update_pass');

	//Categories Routes

	Route::group(['prefix'=>'categories'], function () {
		Route::get('/', 'CategoryController@index')->name('categories');
		Route::any('add_category', 'CategoryController@addCategory')->name('categories.add');
		Route::any('edit_category/{id}', 'CategoryController@editCategory')->name('categories.edit');
		Route::any('delete_category/{id}', 'CategoryController@destroy')->name('categories.delete');
	});

	//Product Route

	Route::group(['prefix'=>'products'], function () {
		Route::get('/', 'ProductsController@index')->name('products');
		Route::any('add_product', 'ProductsController@addProduct')->name('products.add');
		Route::any('edit_product/{id}', 'ProductsController@editProduct')->name('products.edit');
		Route::any('delete_product/{id}', 'ProductsController@destroy')->name('products.delete');
	});

	//Product Attributes Route

	Route::group(['prefix'=>'product_attribute'], function () {
		Route::any('add/{id}', 'ProductsController@addProductAttribute')->name('products.add_attributes');
		Route::get('view/{id}', 'ProductsController@ProductAttribute')->name('products.attributes');
		Route::get('delete_productattribute/{id}', 'ProductsController@deleteProductAttribute')->name('products.deleteattribute');
	});


});

Route::get('/logout', 'AdminController@logout')->name('admin_logout');

