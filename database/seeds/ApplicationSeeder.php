<?php

use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('applications')->insert(array(
            array(
                'user_id' => 1,
                'category_id' => 1,
                'name' => 'App #1',
                'image' => 'img/applications/App_1.png',
                'price' => 50.5,
                'description' => 'Here comes the description of this Application',
                'created_at' => now()
            ),
            array(
                'user_id' => 1,
                'category_id' => 2,
                'name' => 'App #2',
                'image' => 'img/applications/App_2.png',
                'price' => 100.75,
                'description' => 'Here comes the description of this Application',
                'created_at' => now()
            ),
            array(
                'user_id' => 2,
                'category_id' => 3,
                'name' => 'App #3',
                'image' => 'img/applications/App_3.png',
                'price' => 80.25,
                'description' => 'Here comes the description of this Application',
                'created_at' => now()
            ),
            array(
                'user_id' => 2,
                'category_id' => 4,
                'name' => 'App #4',
                'image' => 'img/applications/App_4.png',
                'price' => 200.00,
                'description' => 'Here comes the description of this Application',
                'created_at' => now()
            ),
            array(
                'user_id' => 2,
                'category_id' => 5,
                'name' => 'App #5',
                'image' => 'img/applications/App_5.png',
                'price' => 25.57,
                'description' => 'Here comes the description of this Application',
                'created_at' => now()
            )
        ));

        // Using ApplicationFactory.php
        factory(\App\Application::class, 25)->create(); // Creates 25 Applications

    }
}
