<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', 'App\Http\Controllers\GoodsControl@lastProducts');
Route::get('/cart', 'App\Http\Controllers\CartControl@index')->name('cart');
Route::post('/addtocart', 'App\Http\Controllers\CartControl@addToCart')->name('addtocart');
Route::post('/delfromcart', 'App\Http\Controllers\CartControl@delFromCart')->name('delfromcart');
Route::post('/submit', 'App\Http\Controllers\GoodsControl@submit')->name('submit');
Route::post('/delete', 'App\Http\Controllers\GoodsControl@deleteGoods')->name('delete');
Route::get('/clearcart', 'App\Http\Controllers\CartControl@cartClear')->name('clearcart');
//Route::get('/catalog', 'App\Http\Controllers\GoodsControl@allProducts')->name('catalog');
Route::get('/search', 'App\Http\Controllers\GoodsControl@searchProducts')->name('search');
Route::post('/addcomment', 'App\Http\Controllers\CommentControl@submit')->name('addcomment');

Route::get('/category/{alias}/{orderby?}', 'App\Http\Controllers\GoodsControl@showCategory')->name('category');
Route::get('/product/{id}', 'App\Http\Controllers\GoodsControl@oneProduct')->name('product');

Route::get('/contacts', function(){
	return view('contacts');
})->name('contacts');

Route::name('user.')->group(function() {
	Route::view('/private','private')->middleware('auth')->name('cabinet');
	Route::get('/private/adminpanel','App\Http\Controllers\UsersControl@adminPan')->middleware('auth')->name('adminpanel');
	
	Route::get('/login',function() {
		if(Auth::check()) {
			return redirect(route('user.cabinet'));
		}
		return view('login');
	})->name('log');
	Route::post('/login',[App\Http\Controllers\UsersControl::class, 'auth'])->name('login');
	
	Route::get('/registration',function() {
		if(Auth::check()){
			return redirect(route('user.cabinet'));
		}
		return view('registration');
	})->name('reg');
	Route::post('/registration',[App\Http\Controllers\UsersControl::class, 'regist'])->name('regist');
		
	Route::get('/logout',function() {
		Auth::logout();
		return back();
	})->name('logout');
});	