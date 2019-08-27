<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PasatiempoXUser extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('pasatiempoXuser', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('pasatiempo_id')->unsigned();  
            $table->foreign('pasatiempo_id')->references('id')->on('pasatiempo')->onDelete('cascade');
            $table->BigInteger('users_id')->unsigned();  
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('pasatiempoXuser');

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_id');
        });

        Schema::table('pasatiempo', function (Blueprint $table) {
            $table->dropForeign('pasatiempo_id');
        });
    }
}
