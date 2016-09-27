<?php

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
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@teccargo.dk',
                'password' => bcrypt('admin123')
            ],
            [
                'name' => 'Kasper Laukamp',
                'email' => 'godofdenmark@gmail.com',
                'password' => bcrypt('admin123')
            ]
        ]);


    }
}