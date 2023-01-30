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
        User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'user_type' => 1,
            'password' => 123456,
        ]);
        User::create([
            'name' => 'biker',
            'email' => 'biker@biker.com',
            'user_type' => 2,
            'password' => 123456,
        ]);

        User::factory(5)->create();
        User::factory(10)->biker()->create();
    }
}
