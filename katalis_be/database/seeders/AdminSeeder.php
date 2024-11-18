<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123')
        ]);
        $admin->assignRole('admin');

        // Create operator user
        $operator = User::create([
            'name' => 'Operator',
            'email' => 'operator@example.com',
            'password' => Hash::make('password123')
        ]);
        $operator->assignRole('operator');
    }
}
