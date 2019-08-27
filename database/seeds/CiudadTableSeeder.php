<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CiudadTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        DB::table('ciudad')->insert([
            'nombreCiudad' => 'Armenia',
            'departamento_id' => 1
        ]);

        DB::table('ciudad')->insert([
            'nombreCiudad' => 'Caicedo',
            'departamento_id' => 1
        ]);

        DB::table('ciudad')->insert([
            'nombreCiudad' => 'Medellin',
            'departamento_id' => 1
        ]);

        DB::table('ciudad')->insert([
            'nombreCiudad' => 'Barranquilla',
            'departamento_id' => 2
        ]);

        DB::table('ciudad')->insert([
            'nombreCiudad' => 'Candelaria',
            'departamento_id' => 2
        ]);

        DB::table('ciudad')->insert([
            'nombreCiudad' => 'Tubara',
            'departamento_id' => 2
        ]);

        DB::table('ciudad')->insert([
            'nombreCiudad' => 'Albania',
            'departamento_id' => 3
        ]);

        DB::table('ciudad')->insert([
            'nombreCiudad' => 'Bucaramanga',
            'departamento_id' => 3
        ]);

        DB::table('ciudad')->insert([
            'nombreCiudad' => 'Sucre',
            'departamento_id' => 3
        ]);

    }
}
