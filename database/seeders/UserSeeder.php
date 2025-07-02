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
            'email' => 'hutabulumejan1@gmail.com',
            'password' => Hash::make('password1'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'Admin Desa',
            'email' => 'hutabulumejan2@gmail.com',
            'password' => Hash::make('password2'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'Admin Desa',
            'email' => 'hutabulumejan3@gmail.com',
            'password' => Hash::make('password3'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'Admin Desa',
            'email' => 'hutabulumejan4@gmail.com',
            'password' => Hash::make('password4'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'Admin Desa',
            'email' => 'hutabulumejan5@gmail.com',
            'password' => Hash::make('password5'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'Admin Desa',
            'email' => 'hutabulumejan6@gmail.com',
            'password' => Hash::make('password6'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'Admin Desa',
            'email' => 'hutabulumejan7@gmail.com',
            'password' => Hash::make('password7'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'Admin Desa',
            'email' => 'hutabulumejan8@gmail.com',
            'password' => Hash::make('password8'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'Admin Desa',
            'email' => 'hutabulumejan9@gmail.com',
            'password' => Hash::make('password9'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'Admin Desa',
            'email' => 'hutabulumejan10@gmail.com',
            'password' => Hash::make('password10'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'Admin Desa',
            'email' => 'hutabulumejan11@gmail.com',
            'password' => Hash::make('password11'),
            'role' => 'admin'
        ]);
    }
}
