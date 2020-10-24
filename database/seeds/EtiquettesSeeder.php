<?php

use Illuminate\Database\Seeder;

class EtiquettesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('etiquettes')->insert([
            'name' => 'paysage',
        ]);

        DB::table('etiquettes')->insert([
            'name' => 'singapour',
        ]);

        DB::table('etiquettes')->insert([
            'name' => 'tahiti',
        ]);
    }
}
