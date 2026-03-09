<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Models\Scheme;
use Illuminate\Support\Facades\File;

class WelcomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
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
        return Inertia::render('About', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }

    public function show($slug)
    {
        $scheme = Scheme::where('slug', $slug)->firstOrFail();

        // Load details from JSON
        $jsonPath = base_path('JSON Detil Skema .txt');
        $detailData = null;

        if (File::exists($jsonPath)) {
            $jsonData = json_decode(File::get($jsonPath), true);
            if (isset($jsonData['schemes'])) {
                foreach ($jsonData['schemes'] as $item) {
                    if ($item['code'] === $scheme->code) {
                        $detailData = $item['details'];
                        break;
                    }
                }
            }
        }

        return Inertia::render('Scheme/Detail', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'scheme' => $scheme,
            'detail' => $detailData,
        ]);
    }
}
