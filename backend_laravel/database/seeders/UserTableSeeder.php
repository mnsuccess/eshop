<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Manasse',
            'email' => 'admin@admin.com',
            'is_admin' => 1,
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Client',
            'email' => 'user@user.com',
            'is_admin' => 0,
            'password' => Hash::make('password'),
        ]);
    }
}
