<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('username', 50)->unique();
            $table->string('email', 128)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->BigInteger('perfil_id')->unsigned();  
            $table->foreign('perfil_id')->references('id')->on('perfil')->onDelete('cascade');
            $table->BigInteger('ciudad_id')->unsigned();  
            $table->foreign('ciudad_id')->references('id')->on('ciudad')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('users');

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('perfil_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('ciudad_id');
        });
    }
}