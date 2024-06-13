<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'index'])->name('auth.index')->middleware('guest');
Route::post('/login', [AuthController::class, 'verify'])->name('auth.verify');


Route::group(['middleware' => 'auth:user'], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
        Route::get('/reset-password', [DashboardController::class, 'resetPassword'])->name('dashboard.resetPassword');
        Route::post('/reset-password', [DashboardController::class, 'prosesResetPassword'])->name('dashboard.prosesResetPassword');

        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/kategori/tambah', [KategoriController::class, 'tambah'])->name('kategori.tambah');
        Route::post('/kategori/prosesTambah', [KategoriController::class, 'prosesTambah'])->name('kategori.prosesTambah')->middleware('role.admin');;
        Route::get('/kategori/ubah/{id}', [KategoriController::class, 'ubah'])->name('kategori.ubah')->middleware('role.admin');;
        Route::post('/kategori/prosesUbah', [KategoriController::class, 'prosesUbah'])->name('kategori.prosesUbah')->middleware('role.admin');;
        Route::get('/kategori/hapus/{id}', [KategoriController::class, 'hapus'])->name('kategori.hapus')->middleware('role.admin');;

        Route::get('/artist', [ArtistController::class, 'index'])->name('artist.index');
        Route::get('/artist/tambah', [ArtistController::class, 'tambah'])->name('artist.tambah')->middleware('role.admin');;
        Route::post('/artist/prosesTambah', [ArtistController::class, 'prosesTambah'])->name('artist.prosesTambah')->middleware('role.admin');;
        Route::get('/artist/ubah/{id}', [ArtistController::class, 'ubah'])->name('artist.ubah');
        Route::post('/artist/prosesUbah', [ArtistController::class, 'prosesUbah'])->name('artist.prosesUbah')->middleware('role.admin');;
        Route::get('/artist/hapus/{id}', [ArtistController::class, 'hapus'])->name('artist.hapus')->middleware('role.admin');;

        Route::get('/album', [AlbumController::class, 'index'])->name('album.index');
        Route::get('/album/tambah', [AlbumController::class, 'tambah'])->name('album.tambah')->middleware('role.admin');;
        Route::post('/album/prosesTambah', [AlbumController::class, 'prosesTambah'])->name('album.prosesTambah')->middleware('role.admin');;
        Route::get('/album/ubah/{id}', [AlbumController::class, 'ubah'])->name('album.ubah')->middleware('role.admin');;
        Route::post('/album/prosesUbah', [AlbumController::class, 'prosesUbah'])->name('album.prosesUbah')->middleware('role.admin');;
        Route::get('/album/hapus/{id}', [AlbumController::class, 'hapus'])->name('album.hapus')->middleware('role.admin');;

        Route::get('/user', [UserController::class, 'index'])->name('user.list');
        Route::get('/user/tambah', [UserController::class, 'tambah'])->name('user.tambah')->middleware('role.admin');;
        Route::post('/user/prosesTambah', [UserController::class, 'prosesTambah'])->name('user.prosesTambah')->middleware('role.admin');;
        Route::get('/activate/{token}', [UserController::class, 'activate'])->name('user.activate')->middleware('role.admin');;
        Route::get('/user/ubah/{id}', [UserController::class, 'ubah'])->name('user.ubah')->middleware('role.admin');;
        Route::post('/user/prosesUbah', [UserController::class, 'prosesUbah'])->name('user.prosesUbah')->middleware('role.admin');;
        Route::get('/user/hapus/{id}', [UserController::class, 'hapus'])->name('user.hapus')->middleware('role.admin');;

        Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index');
        Route::post('/kasir/search-barcode', [KasirController::class, 'searchProduct'])->name('kasir.searchBarcode');
        Route::post('/kasir/insert', [KasirController::class, 'insert'])->name('kasir.insert');

        Route::get('/transaksi', [TransactionController::class, 'index'])->name('transaksi.index');
        Route::get('/transaksi/{id}/pdf', [TransactionController::class, 'printPDF'])->name('transaksi.printPDF');
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::get('files/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
})->name('storage');
