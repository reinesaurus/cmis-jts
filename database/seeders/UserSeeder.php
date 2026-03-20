<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Nevile',
            'email' => 'neville@example.com',
            'email_verified_at' => null,
            'password' => Hash::make('123123123'),
            'role' => 'CUSTOMER',
            'remember_token' => null,
            'created_at' => null,
            'updated_at' => null
        ]);

        User::create([
            'name' => 'Sherleen',
            'email' => 'shers@example.com',
            'email_verified_at' => null,
            'password' => Hash::make('123123123'),
            'role' => 'ADMIN',
            'remember_token' => null,
            'created_at' => null,
            'updated_at' => null
        ]);
    }
}
