<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JanjiPeriksa;
use App\Models\Periksa;

class PeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $janji = JanjiPeriksa::first();
        $data = [
            [
                'id_janji_periksa' => $janji->id,
                'tgl_periksa' => now(),
                'catatan' => 'Pasien mengalami gejala flu dan batuk',
                'biaya_periksa' => 50000,
            ],
        ];

        foreach ($data as $item) {
            Periksa::create($item);
        }
        //
    }
}
