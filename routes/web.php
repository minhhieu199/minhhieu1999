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
Route::get('/', 'shopcontroller@index');
// Trang liên hệ
Route::get('/lien-he', 'ShopController@contact');

// Trang danh mục
Route::get('/danh-muc', 'shopcontroller@listproduct');

//trang chi tiết
Route::get('/chi-tiết', 'ShopController@productdetail');

//trang giỏ hàng
Route::get('/gio-hang', 'cartController@index');

Route::group(['prefix' => 'admin','as' => 'admin.'/*, 'middleware' => 'checkLogin'*/], function() {
	Route::resource('category', 'categoryController');

  // QL Banner
	Route::resource('banner', 'BannerController');

// QL Vendor	
	Route::resource('vendor', 'VendorController');

// QL Product
	Route::resource('product', 'ProductsController');
//QL USER
	Route::resource('user', 'UserController');
});



Route::get('/admin/login', 'LoginController@index')->name('admin.login');
Route::post('/admin/postLogin', 'LoginController@postLogin')->name('admin.postLogin');

