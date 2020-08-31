<?php

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
        DB::table('users')->insert(array(
            array(
                'username' => 'amtnester',
                'email' => 'amtnester@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'developer',
                'created_at' => now()
            ),
            array(
                'username' => 'amtnet',
                'email' => 'amtnet@hotmail.com',
                'password' => Hash::make('password'),
                'role' => 'developer',
                'created_at' => now()
            ),
            array(
                'username' => 'maurotnet',
                'email' => 'maurotnet@yahoo.com',
                'password' => Hash::make('password'),
                'role' => 'client',
                'created_at' => now()
            ),
        ));
    }
}
