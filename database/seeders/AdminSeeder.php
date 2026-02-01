<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin BarberGest',
            'email' => 'admin@barbergest.local',
            'password' => bcrypt('12345678'), // senha padrão
        ]);
    }
}
