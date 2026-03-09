<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::truncate();

        Setting::create([
            'key' => 'about_page',
            'value' => [
                'visi' => 'Menjadi lembaga sertifikasi profesi terkemuka dan terpercaya dalam mencetak SDM unggul yang kompeten di bidang keamanan siber dan pelindungan data pribadi untuk mendukung ketahanan digital Indonesia.',
                'misi' => '<ul><li>Melaksanakan sertifikasi kompetensi sesuai standar nasional (SKKNI) dan internasional.</li><li>Menjamin mutu asesmen dengan asesor profesional dan independen.</li><li>Membangun kemitraan strategis dengan industri, akademisi, dan pemerintah.</li><li>Menyelenggarakan operasional lembaga yang transparan, akuntabel, dan berbasis teknologi.</li></ul>',
                'alamat' => 'Jalan Banda No. 30, Kota Bandung, Jawa Barat',
                'kontak' => '+62 851-8999-8970',
                'email' => 'lspsiberdata@gmail.com',
            ],
        ]);
    }
}
