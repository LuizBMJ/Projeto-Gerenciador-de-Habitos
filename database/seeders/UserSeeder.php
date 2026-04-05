<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->create([
            'name'     => 'Jorge',
            'email'    => 'jorge@gmail.com',
            'password' => bcrypt('123123'),
        ]);

        User::query()->create([
            'name'     => 'Marya',
            'email'    => 'marya@gmail.com',
            'password' => bcrypt('123123'),
        ]);
    }
}