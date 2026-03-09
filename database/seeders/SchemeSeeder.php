<?php

namespace Database\Seeders;

use App\Models\Scheme;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class SchemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Scheme::truncate();

        $schemes = [
            // PDP
            ['category' => 'pdp', 'level' => 8, 'name' => 'Pejabat Pengawas PDP/ PPDP (DPO)', 'code' => 'SKM-PDP-001'],
            ['category' => 'pdp', 'level' => 8, 'name' => 'Pejabat Pelaksana PDP (Data Protection Executive)', 'code' => 'SKM-PDP-002'],
            ['category' => 'pdp', 'level' => 7, 'name' => 'Manajer Operasional PDP (PDP Operational Manager)', 'code' => 'SKM-PDP-003'],
            ['category' => 'pdp', 'level' => 6, 'name' => 'Pelaksana Kepatuhan PDP (PDP Compliance)', 'code' => 'SKM-PDP-004'],
            ['category' => 'pdp', 'level' => 6, 'name' => 'Auditor PDP', 'code' => 'SKM-PDP-005'],
            ['category' => 'pdp', 'level' => 6, 'name' => 'Analis Risiko PDP (PDP Risk Analyst and DPIA)', 'code' => 'SKM-PDP-006'],

            // Cyber
            ['category' => 'cyber', 'level' => 5, 'name' => 'Pelaksana Keamanan Informasi (Junior Information Security)', 'code' => 'SKM-CYB-001'],
            ['category' => 'cyber', 'level' => 6, 'name' => 'Auditor Keamanan Informasi (Information Security Auditor)', 'code' => 'SKM-CYB-002'],
            ['category' => 'cyber', 'level' => 8, 'name' => 'SPESIALIS FORENSIK SIBER (CYBER FORENSIC SPECIALIST)', 'code' => 'SKM-CYB-003'],
            ['category' => 'cyber', 'level' => 6, 'name' => 'Analis SOC Tingkat 3 (L3 SOC Analyst)', 'code' => 'SKM-CYB-004'],
            ['category' => 'cyber', 'level' => 6, 'name' => 'Analis Tanggap Insiden (Incident Response Analyst)', 'code' => 'SKM-CYB-005'],
            ['category' => 'cyber', 'level' => 3, 'name' => 'Penguji Keamanan Siber Pertama (Junior Penetration Tester)', 'code' => 'SKM-CYB-006'],
            ['category' => 'cyber', 'level' => 5, 'name' => 'Penguji Keamanan Siber (Penetration Tester)', 'code' => 'SKM-CYB-007'],
        ];

        $jsonPath = base_path('JSON Detil Skema .txt');
        $jsonData = [];

        if (File::exists($jsonPath)) {
            $parsed = json_decode(File::get($jsonPath), true);
            if (isset($parsed['schemes'])) {
                $jsonData = $parsed['schemes'];
            }
        }

        foreach ($schemes as $scheme) {
            $details = null;

            // Cari details yg cocok buat skema ini
            foreach ($jsonData as $item) {
                if ($item['code'] === $scheme['code']) {
                    $details = $item['details'];
                    break;
                }
            }

            Scheme::create([
                'name' => $scheme['name'],
                'slug' => Str::slug($scheme['name']),
                'code' => $scheme['code'],
                'category' => $scheme['category'],
                'level' => $scheme['level'],
                'details' => $details,
            ]);
        }
    }
}
