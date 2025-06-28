<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RajaOngkirController;
// use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    // return view('welcome')
    return redirect()->route('beranda');
});

Route::get('backend/beranda', [BerandaController::class, 'berandaBackend'])->name('backend.beranda')->middleware('auth');

Route::get('backend/login', [LoginController::class, 'loginBackend'])->name('backend.login');
Route::post('backend/login', [LoginController::class, 'authenticateBackend'])->name('backend.login');
Route::post('backend/logout', [LoginController::class, 'logoutBackend'])->name('backend.logout');

// Route untuk user
Route::resource('backend/user', UserController::class, ['as' => 'backend'])->middleware('auth');

// Route untuk anggota
Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');


// Route unruk laporan user
Route::get('backend/laporan/formuser', [UserController::class, 'formUser'])->name('backend.laporan.formuser')->middleware('auth');
Route::post('backend/laporan/cetakuser', [UserController::class, 'cetakUser'])->name('backend.laporan.cetakuser')->middleware('auth');

// Route untuk kategori
Route::resource('backend/kategori', KategoriController::class, ['as' => 'backend'])->middleware('auth');

// Route untuk produk
Route::resource('backend/produk', ProdukController::class, ['as' => 'backend'])->middleware('auth');

Route::get('/produk/detail/{id}', [ProdukController::class, 'detail'])->name('produk.detail');

Route::get('/produk/kategori/{id}', [ProdukController::class, 'produkKategori'])->name('produk.kategori');

Route::get('/produk/all', [ProdukController::class, 'produkAll'])->name('produk.all');

// Route untuk menambahkan foto
Route::post('foto-produk/store', [ProdukController::class, 'storeFoto'])->name('backend.foto_produk.store')->middleware('auth');
// Route untuk menghapus foto
Route::delete('foto-produk/{id}', [ProdukController::class, 'destroyFoto'])->name('backend.foto_produk.destroy')->middleware('auth');

// Route unruk laporan produk
Route::get('backend/laporan/formproduk', [ProdukController::class, 'formProduk'])->name('backend.laporan.formproduk')->middleware('auth');
Route::post('backend/laporan/cetakproduk', [ProdukController::class, 'cetakProduk'])->name('backend.laporan.cetakproduk')->middleware('auth');

// frontend
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');

// API 
use App\Http\Controllers\CustomerController;
//API Google 
Route::get('/auth/redirect', [CustomerController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/google/callback', [CustomerController::class, 'callback'])->name('auth.callback');
// Logout 
Route::post('/customer/logout', [CustomerController::class, 'logout'])->name('customer.logout');

// Route untuk customer
Route::resource('backend/customer', CustomerController::class, ['as' => 'backend'])->middleware('auth');

// Route show detail data customer
Route::get('backend/customer/{id}/detail', [CustomerController::class, 'show'])->name('backend.customer.show');

// menampilkan data customer bagian fe
// Route::get('/customer/akun/{id}', [CustomerController::class, 'akun'])->name('customer.akun')->middleware('is.customer');
// Route::put('/customer/akun/{id}/update', [CustomerController::class, 'updateAkun'])->name('customer.akun.update')->middleware('is.customer');

//Group route untuk customer 
Route::middleware('is.customer')->group(function () {
    // Route untuk menampilkan halaman akun customer 
    Route::get('/customer/akun/{id}', [CustomerController::class, 'akun'])->name('customer.akun');

    // Route untuk mengupdate data akun customer 
    Route::put('/customer/akun/{id}/update', [CustomerController::class, 'updateAkun'])
        ->name('customer.akun.update');

    // Route untuk menambahkan produk ke keranjang 
    Route::post('add-to-cart/{id}', [OrderController::class, 'addToCart'])->name('order.addToCart');
    Route::get('cart', [OrderController::class, 'viewCart'])->name('order.cart');
    Route::post('cart/update/{id}', [OrderController::class, 'updateCart'])->name('order.updateCart');
    Route::post('remove/{id}', [OrderController::class, 'removeFromCart'])->name('order.remove');

    // Ongkir
    Route::post('select-shipping', [OrderController::class, 'selectShipping'])->name('order.selectShipping');
    Route::get('provinces', [OrderController::class, 'getProvinces']);
    Route::get('cities', [OrderController::class, 'getCities']);
    Route::post('cost', [OrderController::class, 'getCost']);
    Route::post('updateongkir', [OrderController::class, 'updateongkir'])->name('order.updateongkir');

});
