<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Scheme;
use App\Models\User;
use App\Models\Certification;
use App\Models\Document;

class SiberdataStatsWidget extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalSchemes = Scheme::count();
        $cyberSchemes = Scheme::where('category', 'cyber')->count();
        $pdpSchemes = Scheme::where('category', 'pdp')->count();

        $totalUsers = User::whereIn('role', ['asesor', 'asesi'])->count();
        $totalAsesor = User::where('role', 'asesor')->count();
        $totalAsesi = User::where('role', 'asesi')->count();

        $certificationsDone = Certification::where('status', '!=', 'pending')->count();

        $totalDocs = Document::count();
        $skkniDocs = Document::whereIn('type', ['SKKNI TIK', 'SKKNI PDP'])->count();

        return [
            Stat::make('Skema Aktif', $totalSchemes)
            ->description("{$cyberSchemes} Cyber Security | {$pdpSchemes} PDP")
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('primary')
            ->icon('heroicon-m-shield-check'),

            Stat::make('Total Personel', $totalUsers)
            ->description("{$totalAsesor} Asesor Terverifikasi | {$totalAsesi} Asesi Terdaftar")
            ->descriptionIcon('heroicon-m-users')
            ->color('warning')
            ->icon('heroicon-m-users'),

            Stat::make('Sertifikasi Terlaksana', $certificationsDone)
            ->description('Update real-time dari sistem')
            ->descriptionIcon('heroicon-m-check-badge')
            ->color('success')
            ->icon('heroicon-m-academic-cap'),

            Stat::make('Dokumen Kompetensi', $totalDocs)
            ->description("{$skkniDocs} Standar SKKNI")
            ->descriptionIcon('heroicon-m-document-check')
            ->color('danger')
            ->icon('heroicon-m-clipboard-document-check'),
        ];
    }
}
