<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'is_admin' => true,
            'name' => 'Charles Ferreira Nunes',
            'email' => 'charles.comercial.nunes@gmail.com',
            'curso' => 'Sistemas de Informação',
            'password' => Hash::make('10026082')
        ]);
    }
}
