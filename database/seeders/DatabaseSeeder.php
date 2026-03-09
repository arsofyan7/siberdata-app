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
        \App\Models\User::firstOrCreate(
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
        ]);
    }
}
