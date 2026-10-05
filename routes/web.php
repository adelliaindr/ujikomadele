<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProgramKeahlianController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RatingController; 
use App\Http\Controllers\KontakController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminStrukturController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\ProdukController as AdminProdukController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\ArtikelController as AdminArtikelController;
use App\Http\Controllers\Admin\PesanKontakController as AdminKontakController;

//form login Admin
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//halaman dashboard admin (harus login pokoknya)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profil Sekolah
    Route::get('/profil', [AdminProfileController::class, 'index'])->name('profil.index');
    Route::get('/profil/edit', [AdminProfileController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [AdminProfileController::class, 'update'])->name('profil.update');

    // Struktur Organisasi
    Route::get('/profil/struktur/create', [AdminStrukturController::class, 'create'])->name('struktur.create');
Route::post('/profil/struktur', [AdminStrukturController::class, 'store'])->name('struktur.store');
Route::get('/profil/struktur/{struktur}/edit', [AdminStrukturController::class, 'edit'])->name('struktur.edit');
Route::put('/profil/struktur/{struktur}', [AdminStrukturController::class, 'update'])->name('struktur.update');
Route::delete('/profil/struktur/{struktur}', [AdminStrukturController::class, 'destroy'])->name('struktur.destroy');

    // Produk
   Route::get('/produk', [AdminProdukController::class, 'index'])->name('produk.index');
   Route::get('/produk/create', [AdminProdukController::class, 'create'])->name('produk.create');
   Route::post('/produk', [AdminProdukController::class, 'store'])->name('produk.store');
   Route::get('/produk/{produk}/edit', [AdminProdukController::class, 'edit'])->name('produk.edit');
   Route::put('/produk/{produk}', [AdminProdukController::class, 'update'])->name('produk.update');
   Route::delete('/produk/{produk}', [AdminProdukController::class, 'destroy'])->name('produk.destroy');

    // Program Keahlian
    Route::resource('program', AdminProgramController::class);

    // Galeri & Interaksi
    Route::resource('galeri', AdminGaleriController::class);
    Route::get('/galeri/{galeri}/interactions', [AdminGaleriController::class, 'showInteractions'])->name('galeri.interactions');
    Route::delete('/comment/{comment}', [AdminGaleriController::class, 'destroyComment'])->name('comment.destroy');
    Route::delete('/like/{like}', [AdminGaleriController::class, 'destroyLike'])->name('like.destroy');

    // Artikel
    Route::resource('artikel', AdminArtikelController::class);

    // Kontak
    Route::get('/kontak', [AdminKontakController::class, 'index'])->name('kontak.index');
    Route::get('/kontak/{id}', [AdminKontakController::class, 'show'])->name('kontak.show');
    Route::delete('/kontak/{id}', [AdminKontakController::class, 'destroy'])->name('kontak.destroy');
});

route::get('/', [BerandaController::class,'index'])->name('beranda');

Route::get('/profil', [ProfileController::class, 'index'])->name('profil.index');

Route::get('/program-keahlian', [ProgramKeahlianController::class,'index'])->name('program-keahlian');
Route::get('/program-keahlian/{id}', [ProgramKeahlianController::class,'show'])->name('program-keahlian.show');
//produk
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/{slug}', [ProdukController::class, 'show'])->name('produk.show');
//artikel
Route::resource('artikel', ArtikelController::class);
Route::get('/artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.show');
Route::resource('galeri', GaleriController::class);
Route::get('/galeri/{galeri}', [GaleriController::class,'show'])->name('galeri.show');
//like
Route::post('/galeri/{galeri}/like', [GaleriController::class,'toggleLike'])->name('galeri.like');
//komen
Route::post('/galeri/{galeri}/comment', [CommentController::class,'storeComment'])->name('galeri.comment.store');
Route::delete('/comment/{comment}', [CommentController::class,'destroyComment'])->name('galeri.comment.destroy');
//route untuk rating
Route::post('/rating', [RatingController::class, 'store'])->name('rating.store');
//kontak
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');


