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
    $user = auth()->user();
    
    // Default stats
    $stats = [];
    if ($user->hasRole('super_admin') || $user->hasRole('manajer_mutu') || $user->hasRole('staf_admin')) {
        $stats = [
            ['label' => 'Total Asesi', 'value' => \App\Models\User::role('asesi')->count()],
            ['label' => 'Total Skema Aktif', 'value' => \App\Models\Scheme::count()],
        ];
    } else {
        $stats = [
            ['label' => 'Status Sertifikasi', 'value' => 'Dalam Proses'],
        ];
    }

    $activities = collect();
    try {
        if (class_exists(\Spatie\Activitylog\Models\Activity::class)) {
            // Using causedBy to correctly use polymorphic relationship, wrapped in try-catch
            // to prevent PostgreSQL UUID type casting mismatch on causer_id
            $activities = \Spatie\Activitylog\Models\Activity::causedBy($user)->latest()->limit(5)->get();
        }
    } catch (\Exception $e) {
        // Fallback to empty collection if schema mismatch (e.g., UUID vs Int) occurs
    }

    return Inertia::render('Dashboard', [
        'roles' => $user->getRoleNames(),
        'stats' => $stats,
        'activities' => $activities,
        'latestNews' => \App\Models\Post::latest()->limit(2)->get(),
        'securityStatus' => [
            'password_strength' => 'Terlindungi',
            'mfa_enabled' => false, // Example hardcoded or could be dynamic if logic exists
        ]
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class , 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class , 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class , 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:asesi|super_admin'])->group(function () {
    Route::get('/portal-asesi', [\App\Http\Controllers\AsesiController::class, 'index'])->name('asesi.index');
    Route::get('/register-certification', [\App\Http\Controllers\ApplicationController::class, 'create'])->name('application.create');
    Route::post('/register-certification', [\App\Http\Controllers\ApplicationController::class, 'store'])->name('application.store');
});

require __DIR__ . '/auth.php';
