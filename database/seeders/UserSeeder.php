<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@football.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create coaches
        User::create([
            'name' => 'Coach Johnson',
            'email' => 'coach1@football.com',
            'password' => Hash::make('password'),
            'role' => 'coach',
        ]);

        User::create([
            'name' => 'Coach Smith',
            'email' => 'coach2@football.com',
            'password' => Hash::make('password'),
            'role' => 'coach',
        ]);

        // Create players
        User::create([
            'name' => 'Alex Rodriguez',
            'email' => 'alex@football.com',
            'password' => Hash::make('password'),
            'role' => 'player',
        ]);

        User::create([
            'name' => 'Jamie Wilson',
            'email' => 'jamie@football.com',
            'password' => Hash::make('password'),
            'role' => 'player',
        ]);

        User::create([
            'name' => 'Sam Taylor',
            'email' => 'sam@football.com',
            'password' => Hash::make('password'),
            'role' => 'player',
        ]);

        User::create([
            'name' => 'Jordan Brown',
            'email' => 'jordan@football.com',
            'password' => Hash::make('password'),
            'role' => 'player',
        ]);
    }
}
