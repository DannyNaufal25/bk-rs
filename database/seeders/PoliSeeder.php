<?php

namespace Database\Seeders;

use App\Models\Poli;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polis = [
            [
                'nama' => 'Umum',
                'deskripsi' => 'Poli Umum melayani berbagai macam penyakit umum yang tidak memerlukan spesialisasi khusus.',
            ],
            [
                'nama' => 'Kandungan',
                'deskripsi' => 'Poli Kandungan khusus menangani masalah kesehatan wanita, terutama yang berkaitan dengan kehamilan dan persalinan.',
            ],
            [
                'nama' => 'Anak',
                'deskripsi' => 'Poli Anak fokus pada kesehatan dan perawatan anak-anak dari bayi hingga remaja.',
            ],
            [
                'nama' => 'Gigi',
                'deskripsi' => 'Poli Gigi menyediakan layanan perawatan gigi dan mulut, termasuk pencegahan dan pengobatan penyakit gigi.',
            ],
            [
                'nama' => 'THT',
                'deskripsi' => 'Poli THT (Telinga, Hidung, Tenggorokan) menangani masalah kesehatan terkait organ THT.',
            ],
        ];
        foreach ($polis as $poli) {
            Poli::create($poli);
        }
    }
}
