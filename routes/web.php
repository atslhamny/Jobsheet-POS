<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StokController;

// Halaman Home
// Route::get('/', [HomeController::class, 'index']);

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'postregister']);

Route::pattern('id', '[0-9]+'); // Menentukan pola untuk parameter id

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function () { // artinya semua route di dalam group ini harus login dulu
    // masukan semua route yang perlu authentikasi di sini

    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware(['auth', 'authorize:ADM'])->group(function () { // artinya semua route di dalam group ini harus login dulu
        // masukan semua route yang perlu authentikasi di sini
        Route::get('/level', [LevelController::class, 'index']);
        Route::post('/level/list', [LevelController::class, 'list']);
        Route::get('/level/create', [LevelController::class, 'create']);
        Route::post('/level', [LevelController::class, 'store']);
        Route::get('/level/{id}/edit', [LevelController::class, 'edit']);
        Route::put('/level/{id}', [LevelController::class, 'update']);
        Route::delete('/level/{id}', [LevelController::class, 'destroy']);
    });

    Route::middleware(['authorize:ADM,MNG'])->group(function () { // artinya semua route di dalam group ini harus login dulu
        // masukan semua route yang perlu authentikasi di sini
        Route::get('/barang', [BarangController::class, 'index']);
        Route::post('/barang/list', [BarangController::class, 'list']);
        Route::get('/barang/create_ajax', [BarangController::class, 'create_ajax']);
        Route::post('/barang_ajax', [BarangController::class, 'store_ajax']);
        Route::get('/barang/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);
        Route::put('/barang/{id}/update_ajax', [BarangController::class, 'update_ajax']);
        Route::delete('/barang/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);
        Route::get('/barang/import', [BarangController::class, 'import']);
        Route::post('/barang/import_ajax', [BarangController::class, 'import_ajax']);
        Route::get('/barang/export_excel', [BarangController::class, 'export_excel']);
    });

    Route::middleware(['authorize:ADM,MNG,STF'])->group(function () { // artinya semua route di dalam group ini harus login dulu
        // masukan semua route yang perlu authentikasi di sini
        Route::get('/kategori', [KategoriController::class, 'index']);
        Route::post('/kategori/list', [KategoriController::class, 'list']);
        Route::get('/kategori/create', [KategoriController::class, 'create']);
        Route::post('/kategori', [KategoriController::class, 'store']);
        Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit']);
        Route::put('/kategori/{id}', [KategoriController::class, 'update']);
        Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);
        route::get('/kategori/import', [KategoriController::class, 'import']);
        route::post('/kategori/import_ajax', [KategoriController::class, 'import_ajax']);
    });

    Route::middleware(['authorize:ADM,MNG'])->group(function () { // artinya semua route di dalam group ini harus login dulu
        // masukan semua route yang perlu authentikasi di sini
        Route::get('/supplier', [SupplierController::class, 'index']);
        Route::post('/supplier/list', [SupplierController::class, 'list']);
        Route::get('/supplier/create', [SupplierController::class, 'create']);
        Route::post('/supplier', [SupplierController::class, 'store']);
        Route::get('/supplier/{id}/edit', [SupplierController::class, 'edit']);
        Route::put('/supplier/{id}', [SupplierController::class, 'update']);
        Route::delete('/supplier/{id}', [SupplierController::class, 'destroy']);
        Route::get('/supplier/import', [SupplierController::class, 'import']);
        Route::post('/supplier/import_ajax', [SupplierController::class, 'import_ajax']);
    });

    Route::middleware(['authorize:ADM,STF,KSR'])->group(function () { // artinya semua route di dalam group ini harus login dulu
        // masukan semua route yang perlu authentikasi di sini
        Route::get('/stok', [StokController::class, 'index']);
        Route::post('/stok/list', [StokController::class, 'list']);
        Route::get('/stok/create', [StokController::class, 'create']);
        Route::post('/stok', [StokController::class, 'store']);
        Route::get('/stok/{id}/edit', [StokController::class, 'edit']);
        Route::put('/stok/{id}', [StokController::class, 'update']);
        Route::delete('/stok/{id}', [StokController::class, 'destroy']);
    });
});




Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/tambah', [UserController::class, 'tambah']);
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);








// Halaman Products dengan Prefix Route
Route::prefix('category')->group(function () {
    Route::get('/food-beverage', [ProductController::class, 'foodBeverage']);
    Route::get('/beauty-health', [ProductController::class, 'beautyHealth']);
    Route::get('/home-care', [ProductController::class, 'homeCare']);
    Route::get('/baby-kid', [ProductController::class, 'babyKid']);
});

// Halaman User dengan Route Parameter
Route::get('/user/{id}/name/{name}', [UserController::class, 'show']);

// Halaman Penjualan (POS)
Route::get('/sales', [SalesController::class, 'index']);

//JS 5
Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/list', [UserController::class, 'list']);
    Route::get('/create', [UserController::class, 'create']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/create_ajax', [UserController::class, 'create_ajax']);
    Route::post('/ajax', [UserController::class, 'store_ajax']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::get('/{id}/edit', [UserController::class, 'edit']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);
    Route::put('/{id}/ajax_update', [UserController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // untuk tampilkan form confirm  delete user Ajax
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // untuk menghapus data user Ajax
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

// Route::group(['prefix' => 'level'], function () {
//     Route::get('/', [LevelController::class, 'index'])->name('level.index');
//     Route::post('/list', [LevelController::class, 'list'])->name('level.list');
//     Route::get('/create', [LevelController::class, 'create'])->name('level.create');
//     Route::get('/{id}', [LevelController::class, 'show']);
//     Route::post('/', [LevelController::class, 'store']);
//     Route::get('/{id}/edit', [LevelController::class, 'edit'])->name('level.edit');
//     Route::put('/{id}', [LevelController::class, 'update']);
//     Route::delete('/{id}', [LevelController::class, 'destroy']);
// });

// Route::group(['prefix' => 'kategori'], function () {
//     Route::get('/', [KategoriController::class, 'index'])->name('kategori.index');
//     Route::post('/list', [KategoriController::class, 'list'])->name('kategori.list');
//     Route::get('/create', [KategoriController::class, 'create'])->name('kategori.create');
//     Route::post('/', [KategoriController::class, 'store']);
//     Route::get('/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
//     Route::put('/{id}', [KategoriController::class, 'update']);
//     Route::delete('/{id}', [KategoriController::class, 'destroy']);
// });

// Route::group(['prefix' => 'barang'], function () {
//     Route::get('/', [BarangController::class, 'index']);
//     Route::post('/list', [BarangController::class, 'list']);
//     Route::get('/create', [BarangController::class, 'create']);
//     Route::post('/', [BarangController::class, 'store']);
//     Route::get('/{id}/edit', [BarangController::class, 'edit']);
//     Route::put('/{id}', [BarangController::class, 'update']);
//     Route::delete('/{id}', [BarangController::class, 'destroy']);
// });

// Route::group(['prefix' => 'supplier'], function () {
//     Route::get('/', [SupplierController::class, 'index']);
//     Route::post('/list', [SupplierController::class, 'list']);
//     Route::get('/create', [SupplierController::class, 'create']);
//     Route::post('/', [SupplierController::class, 'store']);
//     Route::get('/{id}', [SupplierController::class, 'show']);
//     Route::get('/{id}/edit', [SupplierController::class, 'edit']);
//     Route::put('/{id}', [SupplierController::class, 'update']);
//     Route::delete('/{id}', [SupplierController::class, 'destroy']);
// });

// Route::group(['prefix' => 'stok'], function () {
//     Route::get('/', [StokController::class, 'index']);
//     Route::post('/list', [StokController::class, 'list']);
//     Route::get('/create', [StokController::class, 'create']);
//     Route::post('/', [StokController::class, 'store']);
//     Route::get('/{id}', [StokController::class, 'show']);
//     Route::get('/{id}/edit', [StokController::class, 'edit']);
//     Route::put('/{id}', [StokController::class, 'update']);
//     Route::delete('/{id}', [StokController::class, 'destroy']);
// });

// Route::group(['prefix' => 'penjualan'], function () {
//     Route::get('/', [penjualanController::class, 'index']);
//     Route::post('/list', [penjualanController::class, 'list']);
//     Route::post('/', [penjualanController::class, 'store']);
//     Route::get('/{id}', [penjualanController::class, 'show']);
//     Route::delete('/{id}', [penjualanController::class, 'destroy']);
//     Route::get('/{id}/edit', [penjualanController::class, 'edit']);
// });

?>