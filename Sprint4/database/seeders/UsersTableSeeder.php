<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::firstOrCreate(
        ['email' => 'ceo@ceo.com'],
        [
            'name' => 'CEO',
            'password' => bcrypt('password'),
        ]
    );
    }
}
