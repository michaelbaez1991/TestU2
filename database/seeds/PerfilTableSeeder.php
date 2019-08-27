<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfilTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        App\Perfil::create([
            'namePerfil' => 'Administrador',
            'descriptionPerfil' => 'Tiene permiso para ingresar al todos los menus',
        ]);

        App\Perfil::create([
            'namePerfil' => 'Usuario',
            'descriptionPerfil' => 'Se muestre sus datos básicos en modo consulta. No tiene acceso a todos los menus',
        ]);
    }
}
