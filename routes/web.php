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
Route::get('/produksi', 'ProduksiController@index')->name('produksi');
Route::get('/produksi/getdata', 'ProduksiController@getdata');
Route::get('/produksi/create', 'ProduksiController@create')->name('addproduksi');
Route::post('/produksi/save', 'ProduksiController@store')->name('saveproduksi');
Route::delete('/produksi/delete/{id}', 'ProduksiController@destroy');
Route::get('/produksi/show/{id}', 'ProduksiController@show');
Route::get('/produksi/edit/{id}', 'ProduksiController@edit')->name('editproduksi');
Route::post('/produksi/update/{id}', 'ProduksiController@update')->name('updateproduksi');

Route::get('/payments', 'PaymentsController@index')->name('payments');
Route::get('/payments/getdata', 'PaymentsController@getdata');
Route::post('/payments/store', 'PaymentsController@store');