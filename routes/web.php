<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransactionController;
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
        Route::post('/kategori/prosesTambah', [KategoriController::class, 'prosesTambah'])->name('kategori.prosesTambah');
        Route::get('/kategori/ubah/{id}', [KategoriController::class, 'ubah'])->name('kategori.ubah');
        Route::post('/kategori/prosesUbah', [KategoriController::class, 'prosesUbah'])->name('kategori.prosesUbah');
        Route::get('/kategori/hapus/{id}', [KategoriController::class, 'hapus'])->name('kategori.hapus');

        Route::get('/artist', [ArtistController::class, 'index'])->name('artist.index');
        Route::get('/artist/tambah', [ArtistController::class, 'tambah'])->name('artist.tambah');
        Route::post('/artist/prosesTambah', [ArtistController::class, 'prosesTambah'])->name('artist.prosesTambah');
        Route::get('/artist/ubah/{id}', [ArtistController::class, 'ubah'])->name('artist.ubah');
        Route::post('/artist/prosesUbah', [ArtistController::class, 'prosesUbah'])->name('artist.prosesUbah');
        Route::get('/artist/hapus/{id}', [ArtistController::class, 'hapus'])->name('artist.hapus');

        Route::get('/album', [AlbumController::class, 'index'])->name('album.index');
        Route::get('/album/tambah', [AlbumController::class, 'tambah'])->name('album.tambah');
        Route::post('/album/prosesTambah', [AlbumController::class, 'prosesTambah'])->name('album.prosesTambah');
        Route::get('/album/ubah/{id}', [AlbumController::class, 'ubah'])->name('album.ubah');
        Route::post('/album/prosesUbah', [AlbumController::class, 'prosesUbah'])->name('album.prosesUbah');
        Route::get('/album/hapus/{id}', [AlbumController::class, 'hapus'])->name('album.hapus');

        Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index');
        Route::post('/kasir/searchAlbum', [KasirController::class, 'searchAlbum'])->name('kasir.searchAlbum');
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
