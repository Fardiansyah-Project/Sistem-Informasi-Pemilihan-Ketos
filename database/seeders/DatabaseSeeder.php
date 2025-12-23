<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $users = [
            [
                'name' => 'TestUser',
                'email' => 'test@gmail.com',
                'password' => Hash::make('test123'),
                'role' => 'voter',
                'nis' => '1234567890',
            ],
            [
                'name' => 'TestUser2',
                'email' => 'test2@gmail.com',
                'password' => Hash::make('test123'),
                'role' => 'voter',
                'nis' => '1234567891',
            ],
            [
                'name' => 'TestUser3',
                'email' => 'test3@gmail.com',
                'password' => Hash::make('test123'),
                'role' => 'voter',
                'nis' => '1234567892',
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ],
        ];

        foreach($users as $user)
        {
            User::create($user);
        }

        $this->call(CandidateSeeder::class);
        $this->call(SettingSeeder::class);
    }
}
