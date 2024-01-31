<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'Deveint',
            'email' => 'info@deveint.com',
            'phone_number' => '0710767015',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'phone_number' => '0707128374',
            'password' => Hash::make('password'),
            'is_admin' => true
        ]);
    }
}
