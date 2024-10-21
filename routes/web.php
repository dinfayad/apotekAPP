<?php

use Illuminate\Support\Facades\Route;
// use : import file : namespace\nameclass;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;

// use App\Http\Controllers\LandingPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });

// routes/web.php
route::middleware(['isGuest'])->group(function () {
    Route::get('/', action: [AkunController::class, 'login'])->name('login');
    Route::post('/login', action: [AkunController::class, 'loginAuth'])->name('login.auth');
});

Route::middleware(['login'])->group(function () {

    Route::get('/logout', action: [AkunController::class, 'logout'])->name('logout');

    Route::get('/home', action: [AkunController::class, 'landing'])->name('home');

    Route::middleware(['isAdmin'])->group(function () {
        Route::prefix('/medicine')->name('medicine.')->group(function () {
            Route::get('/create', [MedicineController::class, 'create'])->name('create');
            Route::post('/store', [MedicineController::class, 'store'])->name('store');
            Route::get('/', [MedicineController::class, 'index'])->name('home');
            Route::get('/{id}', [MedicineController::class, 'edit'])->name('edit');
            Route::patch('/{id}', [MedicineController::class, 'update'])->name('update');
            Route::delete('/{id}', [MedicineController::class, 'destroy'])->name('delete');
            Route::get('/data/stock', [MedicineController::class, 'stock'])->name('stock');
            Route::get('/data/stock/{id}', [MedicineController::class, 'stockEdit'])->name('stock.edit');
            Route::patch('/data/stock/{id}', [MedicineController::class, 'stockUpdate'])->name('stock.update');
        });

        Route::prefix('/user')->name('user.')->group(function () {
            Route::get('/akun', [AkunController::class, 'index'])->name('akun');
            Route::get('/pengguna', [AkunController::class, 'create'])->name('create');
            Route::post('/PenggunaBaru', [AkunController::class, 'store'])->name('store');
            Route::get('/', [AkunController::class, 'index'])->name('home');
            Route::get('/rubah/{id}', [AkunController::class, 'edit'])->name('edit');
            Route::patch('/rubah/{id}', [AkunController::class, 'update'])->name('update');
            Route::delete('/{id}', [AkunController::class, 'destroy'])->name('delete');
        });
    });

    Route::get('/pembelian',  [OrderController::class, 'index'])->name('pembelian');
    Route::post('/pembelian/create', [OrderController::class, 'create'])->name('tambah.pembelian');
    Route::get('/pembelian/print', [OrderController::class, 'show'])->name('print');


    // struktur routing laravel :
    // Route::httpMethod('/name-path', (NamaController::class, 'namaFUnc')) ->name('identitas_route');
    // Http Method :
    // 1. get -> mengambil data/menampilkan halaman
    // 2. post -> menambahkan data baru ke db
    // 3. patch/put -> mengubah data di db
    // 4. delete -> menghapus data di db
    // Route::get('/landing-page' , [LandingPageController::class, 'index']) -> name('landing_page');
});
