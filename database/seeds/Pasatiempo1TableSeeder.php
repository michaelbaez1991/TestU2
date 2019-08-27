<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PasatiempoTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
    	App\Pasatiempo::create([
            'pasatiempo' => 'Practica algun deporte',
        ]);

        App\Pasatiempo::create([
            'pasatiempo' => 'Escuchar musica',
        ]);

        App\Pasatiempo::create([
            'pasatiempo' => 'Cocinar',
        ]);

        App\Pasatiempo::create([
            'pasatiempo' => 'Ir al cine',
        ]);

        App\Pasatiempo::create([
            'pasatiempo' => 'Hacer ejercicio',
        ]);

        App\Pasatiempo::create([
            'pasatiempo' => 'Otros',
        ]);
    }
}
