<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DesainerController;
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

header('Access-Control-Allow-Origin: *'); 

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
Route::resource('keranjang', App\Http\Controllers\API\KeranjangController::class);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('login', [ApiController::class, 'login']);
Route::post('user', 'App\Http\Controllers\API\UserController@store');

// route khusus
Route::get('konveksi_desc_rating', 'App\Http\Controllers\API\KonveksiController@desc_rating');
Route::get('desainer_desc_rating', 'App\Http\Controllers\API\DesainerController@desc_rating');
Route::get('document', 'App\Http\Controllers\API\DocumentController@index');
Route::post('store-file', 'App\Http\Controllers\API\DocumentController@store');
Route::get('get-user/{username}', 'App\Http\Controllers\API\UserController@getUser');
Route::get('pengalaman_desainer', 'App\Http\Controllers\API\PengalamanDesainerController@index');
Route::get('pengalaman_konveksi', 'App\Http\Controllers\API\PengalamanKonveksiController@index');
Route::get('atasan', 'App\Http\Controllers\API\AtasanController@index');
Route::get('bawahan', 'App\Http\Controllers\API\BawahanController@index');

//Sign Up
Route::get('list_akun_konveksi', 'App\Http\Controllers\API\KonveksiAkunController@index');
Route::post('signup_konveksi', 'App\Http\Controllers\API\KonveksiAkunController@store');
Route::get('list_akun_desainer', 'App\Http\Controllers\API\DesainerAkunController@index');
Route::post('signup_desainer', 'App\Http\Controllers\API\DesainerAkunController@store');

//Produk
Route::get('produk_desc_rating', 'App\Http\Controllers\API\ProdukController@desc_rating');
Route::get('filter_category_id/{id_kategori}', 'App\Http\Controllers\API\ProdukController@filter_kategori_id');
Route::get('filter_category_nama/{nama_kategori}', 'App\Http\Controllers\API\ProdukController@filter_kategori_nama');
Route::post('upload_produk', 'App\Http\Controllers\API\ProdukController@store');

//Project
Route::get('preorder/{id_user}', 'App\Http\Controllers\API\ProjectController@riwayat');
Route::get('requestProjectDesainer', 'App\Http\Controllers\API\RequestProjectDesainerController@index');
Route::post('createRequestProjectDesainer', 'App\Http\Controllers\API\RequestProjectDesainerController@store');
Route::get('requestProjectKonveksi', 'App\Http\Controllers\API\RequestProjectKonveksiController@index');
Route::post('createRequestProjectKonveksi', 'App\Http\Controllers\API\RequestProjectKonveksiController@store');

//Accept Desainer Konveksi
Route::put('accept_desainer/{id}', 'App\Http\Controllers\API\AcceptController@accept_desainer');
Route::put('accept_konveksi/{id}', 'App\Http\Controllers\API\AcceptController@accept_konveksi');


