<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'is_admin' => true,
            'name' => 'Charles Ferreira Nunes',
            'email' => 'charles.comercial.nunes@gmail.com',
            'curso' => 'Sistemas de Informação',
            'password' => Hash::make('10026082')
        ]);
    }
}
