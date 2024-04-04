<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('users')->insert([
            'nom' => 'AKOBI',
            'prenom' => 'Harouna',
            'ville' => 'Cotonou',
            'date_naissance' => '30/03/1995',
            'numero_tel' => '90270469',
            'email' => 'contact@group-ilt.com',
            'password' => Hash::make('@Admin_ILT_2024'),
            'type_compte' => 'Admin',
        ]);

    }
}
