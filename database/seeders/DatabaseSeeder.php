<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ObatSeeder::class,
            UserSeeder::class,
            JadwalPeriksaSeeder::class,
            JanjiPeriksaSeeder::class,
            PeriksaSeeder::class,
            DetailPeriksaSeeder::class,
            DokterSeeder::class,
        ]);
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'), // atau Hash::make('password')
            'role' => 'pasien', // atau 'dokter'
            'alamat' => 'Jl. Contoh No. 1',
            'no_ktp' => '1234567890123456',
            'no_hp' => '081234567890',
            'no_rm' => 'RM000001',
            'poli' => null, // atau isi sesuai kebutuhan
        ]);
    }
}
