<?php

namespace Database\Seeders;

use App\Models\user;
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
        user::create ([
            'name' => 'Kasir Apotek',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('kasirapotek'),
            'role' => 'user',
        ]);
    }
}
