<?php

namespace Database\Seeders;

use App\Models\Type;
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
        Type::factory()->create([
            'name' => 'Test Type 1',
        ]);
        Type::factory()->create([
            'name' => 'Test Type 2',
        ]);

        User::factory()->create([
            'username' => 'User1',
            'password' => Hash::make('password1'),
            'id_type' => 1,
        ]);
        User::factory()->create([
            'username' => 'User2',
            'password' => Hash::make('password2'),
            'id_type' => 2,
        ]);
    }
}
