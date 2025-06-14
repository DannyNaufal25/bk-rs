<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Dr. John Doe',
                'email' => 'jondoe@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'dokter',
                'alamat' => 'Jl. Kesehatan No. 1',
                'no_ktp' => '1234567890123456',
                'no_hp' => '081234567890',
                'no_rm' => 'RM123456',
                'poli' => 'Umum',
            ],
            [
                'name' => 'Emanuel Smith',
                'email' => 'Smitherlin@gmail.com',
                'password' => Hash::make('Smith111'),
                'role' => 'pasien',
                'alamat' => 'Jl. Bawang No. 10',
                'no_ktp' => '9087761890981725',
                'no_hp' => '081234567899',
                'no_rm' => 'RM123091',
                'poli' => null,
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
        //
    }
}
