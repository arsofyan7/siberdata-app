<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AsesiController extends Controller
{
    /**
     * Display the Asesi Portal Mission Center.
     */
    public function index()
    {
        return Inertia::render('Asesi/Index', [
            'stats' => [
                'sertifikasi_saya' => 0, // Mock data
                'status_terakhir' => 'Menunggu Pendaftaran',
                'masa_berlaku' => '-',
            ]
        ]);
    }
}
