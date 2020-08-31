<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(array(
            array(
                'name' => 'Game',
                'image' => 'img/categories/game-icon.png',
                'created_at' => now()
            ),
            array(
                'name' => 'Work',
                'image' => 'img/categories/work-icon.png',
                'created_at' => now()
            ),
            array(
                'name' => 'Music',
                'image' => 'img/categories/music-icon.png',
                'created_at' => now()
            ),
            array(
                'name' => 'Phone',
                'image' => 'img/categories/phone-icon.png',
                'created_at' => now()
            ),
            array(
                'name' => 'Sport',
                'image' => 'img/categories/sports-icon.png',
                'created_at' => now()
            )
        ));
    }
}
