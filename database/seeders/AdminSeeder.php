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
            [
                'nom' => 'AKOBI',
                'prenom' => 'Harouna',
                'ville' => 'Cotonou',
                'date_naissance' => '1995-03-30', // Assurez-vous que la date est au format Y-m-d
                'numero_tel' => '+22990270469',
                'email' => 'contact@group-ilt.com',
                'password' => Hash::make('@Admin_ILT_2024'),
                'type_compte' => 'Admin',
            ],
            [
                'nom' => 'DOVOEDO',
                'prenom' => 'Eugénie',
                'ville' => 'Cotonou',
                'date_naissance' => '1998-03-30', // Assurez-vous que la date est au format Y-m-d
                'numero_tel' => '+22995270470', // Numéro de téléphone unique
                'email' => 'e.dovoedo@group-ilt.com',
                'password' => Hash::make('@Admin_ILT_2024'),
                'type_compte' => 'Comptable',
            ]
        ]);

    }
}
