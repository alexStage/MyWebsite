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
        	'name' => 'Alex',
        	'email' => 'opif@gmail.com',
        	'password' => bcrypt('Onepiece@ir91'),
            'admin' => true,
            'family' => true,
        ]);

	    DB::table('users')->insert([
                'name' => 'Manu',
                'email' => 'madoune5@hotmail.fr',
                'password' => '$2y$10$mJwDIap33CjS12EEhf.Zsuuy5dE2siVUvLEIW74812.hLSQTEK4sS',
                'admin' => false,
                'family' => true,
        ]);

        DB::table('users')->insert([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => bcrypt('testicule'),
            'admin' => false,
            'family' => false,
        ]);

        

    }
}
