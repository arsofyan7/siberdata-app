<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = \App\Models\User::firstOrCreate(
        ['email' => 'admin@siberdata.id'],
        [
            'name' => 'Admin Siberdata',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]
        );

        $this->call([
            SettingSeeder::class ,
            SchemeSeeder::class ,
            RoleSeeder::class ,
        ]);

        // Assign super_admin role
        if (!$admin->hasRole('super_admin')) {
            $admin->assignRole('super_admin');
        }

        // Insert Dummy Posts
        $dummyPosts = [
            [
                'title' => 'LSP Siberdata Resmi Terakreditasi Penuh BSSN & BNSP',
                'slug' => 'lsp-siberdata-resmi-terakreditasi-penuh-bssn-bnsp',
                'category' => 'Berita',
                'thumbnail' => 'posts/post_thumbnail_1.png',
                'content' => '<h3>Era Baru Sertifikasi Keamanan Siber</h3><p>LSP Siberdata dengan bangga mengumumkan bahwa kami kini secara sah menjadi lembaga sertifikasi yang diakui penuh untuk menyelenggarakan uji kompetensi Siber. Pengakuan ini tertuang dalam surat keputusan bersama antara BSSN dan BNSP.</p><ul><li>Standarisasi SKKNI terbaru.</li><li>Penguji/Asesor yang tersertifikasi internasional.</li><li>Sistem Uji Kompetensi daring yang aman dan terawasi.</li></ul><p>Mari tingkatkan kompetensi Anda bersama kami!</p>',
                'is_published' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pentingnya Sertifikasi PDP di Era Digital',
                'slug' => 'pentingnya-sertifikasi-pdp-di-era-digital',
                'category' => 'Artikel',
                'thumbnail' => 'posts/post_thumbnail_2.png',
                'content' => '<h3>Lindungi Data Pelanggan Anda</h3><p>Mengapa setiap perusahaan teknologi wajib memfasilitasi pelindungan data pelanggan secara profesional sesuai standar UU PDP? Regulasi Pelindungan Data Pribadi (PDP) menuntut setiap organisasi memiliki Data Protection Officer (DPO) yang kompeten.</p><p>Sertifikasi PDP membuktikan bahwa Anda menguasai manajemen risiko data, respon insiden, dan kepatuhan hukum terkait privasi data.</p>',
                'is_published' => true,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'title' => 'Membangun Arsitektur Zero Trust',
                'slug' => 'membangun-arsitektur-zero-trust',
                'category' => 'Artikel',
                'thumbnail' => 'posts/post_thumbnail_3.png',
                'content' => '<h3>Never Trust, Always Verify</h3><p>Zero Trust bukan sekadar jargon pemasaran, melainkan pergeseran paradigma arsitektur jaringan masa kini. Konsep ini mengharuskan semua entitas, baik di dalam maupun di luar jaringan lokal, untuk diotentikasi dan diotorisasi secara terus menerus.</p><p>Pada artikel ini kita membahas 5 pilar utama dalam membangun lingkungan Zero Trust yang kokoh.</p>',
                'is_published' => true,
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'title' => 'Cetak Biru Lulus Uji Kompetensi Siber',
                'slug' => 'cetak-biru-lulus-uji-kompetensi-siber',
                'category' => 'Tips & Trik',
                'thumbnail' => 'posts/post_thumbnail_4.png',
                'content' => '<h3>Persiapan Adalah Kunci</h3><p>Persiapan yang matang dan pemahaman mendalam tentang standar SKKNI menjadi kunci keberhasilan peserta. Berikut adalah beberapa tips sukses:</p><ol><li>Pahami elemen kompetensi dari skema yang Anda pilih.</li><li>Siapkan portofolio bukti kerja yang relevan (Minimal 2 tahun terakhir).</li><li>Berlatih menggunakan tools keamanan siber standar industri (Nmap, Wireshark, Metasploit, dll).</li><li>Istirahat yang cukup sebelum hari H Uji Kompetensi.</li></ol>',
                'is_published' => true,
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7),
            ],
        ];

        foreach ($dummyPosts as $post) {
            \App\Models\Post::updateOrCreate(['slug' => $post['slug']], $post);
        }

        // Insert Dummy Documents
        $dummyDocs = [
            [
                'name' => 'SKKNI Bidang Keamanan Siber 2026',
                'type' => 'SKKNI TIK',
                'description' => 'Standar Kompetensi Kerja Nasional Indonesia untuk bidang Keamanan Siber yang terbaru, diterbitkan bersama BSSN dan Kominfo.',
                'file_path' => 'documents/skkni_siber_2026.pdf',
            ],
            [
                'name' => 'SKKNI Pelindungan Data Pribadi (PDP)',
                'type' => 'SKKNI PDP',
                'description' => 'Pedoman kompetensi wajib bagi profesi Data Protection Officer (DPO) sesuai undang-undang PDP terbaru.',
                'file_path' => 'documents/skkni_pdp_2026.pdf',
            ],
            [
                'name' => 'Katalog Skema Sertifikasi LSP Siberdata 2026',
                'type' => 'Lainnya',
                'description' => 'Daftar lengkap 13 Skema Sertifikasi beserta unit kompetensi untuk tahun 2026.',
                'file_path' => null,
            ],
            [
                'name' => 'Panduan Teknis Asesmen Jarak Jauh (Daring)',
                'type' => 'Lainnya',
                'description' => 'Petunjuk penggunaan aplikasi portal Asesi saat melakukan ujian wawancara dan praktik jarak jauh.',
                'file_path' => null,
            ],
        ];

        foreach ($dummyDocs as $doc) {
            \App\Models\Document::updateOrCreate(['name' => $doc['name']], $doc);
        }
    }
}
