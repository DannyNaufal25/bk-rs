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
                'name' => 'Emanuel Smith',
                'email' => 'Smitherlin@gmail.com',
                'password' => Hash::make('Smith111'),
                'role' => 'pasien',
                'alamat' => 'Jl. Bawang No. 10',
                'no_ktp' => '9087761890981725',
                'no_hp' => '081234567899',
                'no_rm' => 'RM123091',
                'id_poli' => null,
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
        //
    }
}
