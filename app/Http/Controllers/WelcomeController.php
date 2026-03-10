<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Models\Post;
use App\Models\Document;
use App\Models\Scheme;
use App\Models\Setting;

class WelcomeController extends Controller
{
    public function index()
    {
        $aboutSetting = Setting::where('key', 'about_page')->first();
        $settings = $aboutSetting ? $aboutSetting->value : [];

        $landingSetting = Setting::where('key', 'landing_page')->first();
        $landingSettings = $landingSetting ? $landingSetting->value : [];

        $posts = Post::where('is_published', true)->orderBy('created_at', 'desc')->take(3)->get();
        $documents = Document::orderBy('created_at', 'desc')->get();

        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'settings' => $settings,
            'landingSettings' => $landingSettings,
            'schemes' => Scheme::where('is_active', true)->orderBy('category')->orderBy('level')->get(),
            'posts' => $posts,
            'documents' => $documents,
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

    public function posts()
    {
        $posts = Post::where('is_published', true)->orderBy('created_at', 'desc')->get();
        return Inertia::render('Post/Index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'posts' => $posts,
        ]);
    }

    public function postShow($slug)
    {
        $post = Post::where('slug', $slug)->where('is_published', true)->firstOrFail();
        return Inertia::render('Post/Show', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'post' => $post,
        ]);
    }

    public function documents()
    {
        $documents = Document::orderBy('created_at', 'desc')->get();
        return Inertia::render('Document/Index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'documents' => $documents,
        ]);
    }
}
