<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'nama' => "user",
                'username' => "user",
                'password' => "user",
                'level' => "user",
            ],
            [
                'nama' => "admin",
                'username' => "admin",
                'password' => "admin",
                'level' => "admin",
            ]

        ]);
    }
}
