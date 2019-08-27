<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
    	App\User::create([
	        'name' => 'Usuario Test',
	        'username' => 'laravel',
	        'email' => 'laravel@example.com',
	        'password' => bcrypt('laravel'),
            'perfil_id' => 1,
            'ciudad_id' => 3,
	    ]);
    }
}
 