<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Models\Scheme;
use App\Models\Setting;
use Illuminate\Support\Facades\File;

class WelcomeController extends Controller
{
    public function index()
    {
        $aboutSetting = Setting::where('key', 'about_page')->first();
        $settings = $aboutSetting ? $aboutSetting->value : [];

        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'settings' => $settings,
            // Only pass active schemes, might limit to top 3 or just meta later, but keep it available if needed
            'schemes' => Scheme::where('is_active', true)->orderBy('category')->orderBy('level')->get(),
        ]);
    }

    public function schemes()
    {
        return Inertia::render('Scheme/Index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'schemes' => Scheme::where('is_active', true)->orderBy('category')->orderBy('level')->get(),
        ]);
    }

    public function about()
    {
        $aboutSetting = Setting::where('key', 'about_page')->first();
        $settings = $aboutSetting ? $aboutSetting->value : [];

        return Inertia::render('About', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'settings' => $settings,
        ]);
    }

    public function show($slug)
    {
        $scheme = Scheme::where('slug', $slug)->firstOrFail();
        $aboutSetting = Setting::where('key', 'about_page')->first();
        $settings = $aboutSetting ? $aboutSetting->value : [];

        return Inertia::render('Scheme/Detail', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'scheme' => $scheme,
            'detail' => $scheme->details ? (is_string($scheme->details) ? json_decode($scheme->details, true) : $scheme->details) : null,
            'settings' => $settings,
        ]);
    }
}
