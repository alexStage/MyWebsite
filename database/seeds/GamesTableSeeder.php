<?php

use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert([
        	'titre' => 'mario',
        	'slug' => 'games.game1',
            'photo' => 'IMG_20190811_115051.jpg',
        ]);

        DB::table('games')->insert([
        	'titre' => 'RPG',
        	'slug' => 'games.gameTest',
            'photo' => 'IMG_20190811_115051.jpg',
        ]);
    }


}
