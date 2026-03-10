<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | contains the "web" middleware group. Now create something great! | */

use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class , 'index'])->name('home');
Route::get('/skema', [WelcomeController::class , 'schemes'])->name('scheme.index');
Route::get('/skema/{slug}', [WelcomeController::class , 'show'])->name('scheme.detail');
Route::get('/about', [WelcomeController::class , 'about'])->name('about');
Route::get('/berita', [WelcomeController::class , 'posts'])->name('post.index');
Route::get('/berita/{slug}', [WelcomeController::class , 'postShow'])->name('post.show');
Route::get('/dokumen', [WelcomeController::class , 'documents'])->name('document.index');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class , 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class , 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class , 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
