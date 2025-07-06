<?php

use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\HelloWorldController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\HtmlController;
use App\Http\Controllers\LatihanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ContactUsController;
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

Route::get('backend', [LoginController::class, 'loginBackend'])->name('backend.login');
Route::get('backend/login', [LoginController::class, 'loginBackend'])->name('backend.login');
Route::post('backend/login', [LoginController::class, 'authenticateBackend'])->name('backend.login');
Route::post('backend/logout', [LoginController::class, 'logoutBackend'])->name('backend.logout');

// Route untuk user
Route::resource('backend/user', UserController::class, ['as' => 'backend'])->middleware('auth');

//Route Reset Password

Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLinkEmail'])->name('resetpass.request')->middleware('guest');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware(['auth'])->group(function () {
    // Route untuk anggota
    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
    Route::get('anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
    Route::get('anggota/edit/{id}', [AnggotaController::class, 'edit'])->name('anggota.edit');
    Route::post('anggota/update/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
    Route::post('anggota/store', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::delete('anggota/destroy/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');

    // Route Helloworld
    Route::get('helloworld', [HelloWorldController::class, 'index'])->name('helloworld');
    Route::get('ambilfile', [HelloWorldController::class, 'ambilfile'])->name('ambilfile');

    // Route HTML
    Route::get('getlorem', [HtmlController::class, 'getlorem'])->name('getlorem');

    // Route Latihan
    Route::get('getTabel', [LatihanController::class, 'getTabel'])->name('getTabel');
    Route::get('getForm', [LatihanController::class, 'getForm'])->name('getForm');
});


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
Route::get('/contactus', [ContactUsController::class, 'index'])->name('contactus');
Route::get('/lokasi', [ContactUsController::class, 'location'])->name('location');

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
    Route::get('add-to-cart/{id}', [OrderController::class, 'addToCart'])->name('order.addToCart');
    Route::post('add-to-cart/{id}', [OrderController::class, 'addToCart'])->name('order.addToCart');
    Route::get('cart', [OrderController::class, 'viewCart'])->name('order.cart');
    Route::post('cart/update/{id}', [OrderController::class, 'updateCart'])->name('order.updateCart');
    Route::post('remove/{id}', [OrderController::class, 'removeFromCart'])->name('order.remove');
    // Route::post('cart/update/{id}', [OrderController::class, 'updateCart'])->name('order.updateCart');
    // Route::post('remove/{id}', [OrderController::class, 'removeFromCart'])->name('order.remove');

    // Ongkir
    Route::post('select-shipping', [OrderController::class, 'selectShipping'])->name('order.selectShipping');
    Route::get('select-shipping', [OrderController::class, 'selectShipping'])->name('order.selectShipping.get');
    Route::get('provinces', [OrderController::class, 'getProvinces']);
    Route::get('cities', [OrderController::class, 'getCities']);
    Route::post('cost', [OrderController::class, 'getCost']);
    Route::post('update-ongkir', [OrderController::class, 'updateOngkir'])->name('order.update-ongkir');
    Route::get('select-payment', [OrderController::class, 'selectPayment'])->name('order.selectpayment');

    // midtrans
    Route::post('/midtrans-callback', [OrderController::class, 'callback']);
    Route::get('/order/complete', [OrderController::class, 'complete'])->name('order.complete');

    // Route history 
    Route::get('history', [OrderController::class, 'orderHistory'])->name('order.history');
    Route::get('order/invoice/{id}', [OrderController::class, 'invoiceFrontend'])->name('order.invoice');
});

// cek ongkir
Route::get('/list-ongkir', function () {
    $response = Http::withHeaders([
        'key' => '794a5d197b9cb469ae958ed043ccf921'
    ])->get('https://api.rajaongkir.com/starter/province'); //ganti 'province' atau 'city' 
    dd($response->json());
});

Route::get('/cek-ongkir', function () {
    return view('ongkir');
});

Route::get('/provinces', [RajaOngkirController::class, 'getProvinces']);
Route::get('/cities', [RajaOngkirController::class, 'getCities']);
Route::post('/cost', [RajaOngkirController::class, 'getCost']);