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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function() {
    return redirect(route('login'));
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/produksi', 'HomeController@produksi')->name('produksi');
Route::get('/produksi/create', 'HomeController@addProduksi')->name('addproduksi');