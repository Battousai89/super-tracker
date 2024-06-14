<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(20)->create();

        User::factory()->create([
            'name' => 'Супер пользователь',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin12345'),
        ]);
    }
}
