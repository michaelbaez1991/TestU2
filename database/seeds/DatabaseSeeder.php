<?php
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
    	$this->call(PerfilTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CiudadTableSeeder::class);
        $this->call(PasatiempoTableSeeder::class);
        $this->call(PasatiempoXuserTableSeeder::class);
    }
}