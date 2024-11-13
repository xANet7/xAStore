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
        User::create([
            'name' => 'Ali Darmawan',
            'username' => '10521003',
            'email' => 'admin@gmail.com',
            'password' => bcrypt(10521003),
        ]);
    }
}
