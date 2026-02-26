<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'ii5543135@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('ii5543135@gmail.com'),
                'role' => 'admin',
                'email_verified_at' => null,
            ]
        );
    }
}
