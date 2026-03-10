<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Scheme;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    /**
     * Show the application form (Multi-Step APL-01).
     */
    public function create(Request $request)
    {
        $schemes = Scheme::where('is_active', true)->get(['id', 'name', 'code']);

        return Inertia::render('Asesi/RegisterScheme', [
            'schemes' => $schemes,
            'selectedSchemeId' => $request->query('scheme_id')
        ]);
    }

    /**
     * Store the newly created application.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'scheme_id' => 'required|exists:schemes,id',
            'personal_data' => 'required|array',
            'work_data' => 'required|array',
        ]);

        $year = date('Y');
        $uniqueHex = strtoupper(Str::random(6));
        $registrationNumber = "REG/LSP-SD/{$year}/{$uniqueHex}";

        $application = Application::create([
            'user_id' => auth()->id(),
            'scheme_id' => $validated['scheme_id'],
            'registration_number' => $registrationNumber,
            'personal_data' => $validated['personal_data'],
            'work_data' => $validated['work_data'],
            'status' => 'pending',
        ]);

        // Trigger Email Notification
        \Illuminate\Support\Facades\Mail::to(auth()->user()->email)->send(new \App\Mail\ApplicationRegistered($application));

        return redirect()->route('asesi.index')
                         ->with('success', 'Pendaftaran sertifikasi (APL-01) berhasil dikirim.');
    }
}
