<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@bless.com',
            'password' => bcrypt('12345678'),
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'user1',
            'email' => 'user1@bless.com',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole('user');
    }
}
