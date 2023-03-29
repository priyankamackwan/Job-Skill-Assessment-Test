<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'salutation' => 'Mr',
            'first_name' => 'Brandon',
            'last_name' => 'Hayden',
            'email' => 'Hayden@mailinator.com',
            'password' => bcrypt('password'),
            'profile_photo' => null,
            'user_type' => 'teacher',
        ]);

        \DB::table('users')->insert([
            'salutation' => 'Mrs',
            'first_name' => 'Karen',
            'last_name' => 'Hill',
            'email' => 'Karen@email.com',
            'password' => bcrypt('password'),
            'profile_photo' => null,
            'user_type' => 'parent',
        ]);

        \DB::table('users')->insert([
            'salutation' => null,
            'first_name' => 'William',
            'last_name' => 'Smith',
            'email' => 'William@email.com',
            'password' => bcrypt('password'),
            'profile_photo' => null,
            'user_type' => 'student',
        ]);
    }
}
