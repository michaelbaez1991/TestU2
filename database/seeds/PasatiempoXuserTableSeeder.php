<?php

use Illuminate\Database\Seeder;

class PasatiempoXuserTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        App\PasatiempoXuser::create([
            'pasatiempo_id' => 1,
            'users_id' => 1,
        ]);
    }
}