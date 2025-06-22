<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Import your model
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
               // Create sample users
        User::create([
            'name' => 'Admin Desa',
            'email' => 'hutabulumejan@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

    }
}
