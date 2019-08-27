<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCiudadTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('ciudad', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombreCiudad');
            $table->BigInteger('departamento_id')->unsigned();  
            $table->foreign('departamento_id')->references('id')->on('departamento')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('ciudad');

        Schema::table('ciudad', function (Blueprint $table) {
            $table->dropForeign('departamento_id');
        });
    }
}
