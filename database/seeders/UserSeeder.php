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
            'name' => 'Hugo Enrique Canul Poot',
            'email' => 'hu2deal@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
