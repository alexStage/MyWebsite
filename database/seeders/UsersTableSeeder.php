<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use DB;

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
        	'name' => 'Alex',
            'familyName' => 'd\'haene',
            'pseudo' => 'ArctikGorillaz',
            'description' => 'un mec chaud',
        	'email' => 'opif@gmail.com',
        	'password' => bcrypt('Onepiece@ir91'),
            'admin' => true,
        ]);

        

    }
}
