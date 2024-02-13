<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminData = [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'remember_token' => Str::random(10),
        ];
        $admin = User::create($adminData);
        $admin->assignRole('ADMIN');
    }
}
