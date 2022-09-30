<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\API\DesainerController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\API\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); 
 
Route::resource('konveksi', App\Http\Controllers\API\KonveksiController::class);
Route::resource('kategori', App\Http\Controllers\API\KategoriController::class);
Route::resource('produk', App\Http\Controllers\API\ProdukController::class);
Route::resource('desainer', App\Http\Controllers\API\DesainerController::class);
Route::resource('project', App\Http\Controllers\API\ProjectController::class);
Route::resource('order', App\Http\Controllers\API\OrderController::class);
Route::resource('user', App\Http\Controllers\API\UserController::class);

// route khusus
Route::get('produk_desc_rating', 'App\Http\Controllers\API\ProdukController@desc_rating');
Route::get('konveksi_desc_rating', 'App\Http\Controllers\API\KonveksiController@desc_rating');
Route::get('desainer_desc_rating', 'App\Http\Controllers\API\DesainerController@desc_rating');
Route::get('document', 'App\Http\Controllers\API\DocumentController@index');
Route::get('product_filter_category/{nama_kategori}', 'App\Http\Controllers\API\ProdukController@filter_kategori');
Route::post('store-file', 'App\Http\Controllers\API\DocumentController@store');
Route::get('preorder/{id_user}', 'App\Http\Controllers\API\ProjectController@riwayat');
Route::get('get-user/{username}', 'App\Http\Controllers\API\UserController@getUser');

Route::put('accept_desainer/{id}/{id_desainer}', 'App\Http\Controllers\API\AcceptController@accept_desainer');
Route::put('accept_konveksi/{id}/{id_konveksi}', 'App\Http\Controllers\API\AcceptController@accept_konveksi');
// Route::post('order', 'App\Http\Controllers\API\OrderController@store');
// Route::get('order', 'App\Http\Controllers\API\OrderController@index');
// Route::post('order', 'OrderController@store');
// Route::get('order', OrderController::class,'store');
