<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Default admin
        User::factory()->create([
            'name' => 'Default Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => UserRole::MINICOM->value,
            'status' => UserStatus::APPROVED->value,
        ]);
        //Default Seller
        User::factory()->create([
            'name' => 'Default Seller',
            'email' => 'seller@example.com',
            'password' => bcrypt('password'),
            'role' => UserRole::SELLER->value,
            'status' => UserStatus::APPROVED->value,
        ]);
        //Default Exporter
        User::factory()->create([
            'name' => 'Default Exporter',
            'email' => 'exporter@example.com',
            'password' => bcrypt('password'),
            'role' => UserRole::EXPORTER->value,
            'status' => UserStatus::APPROVED->value,
        ]);
    }
}
