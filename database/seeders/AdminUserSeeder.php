<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'admin@admin.admin'],
            [
                'name' => 'admin',
                'password' => Hash::make('admin@admin.admin'),
                'role' => 'admin',
                'email_verified_at' => null,
            ]
        );
    }
}
