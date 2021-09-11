<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->bigIncrements('noControl', 8)->unique();
            $table->string('nombre', 100);
            $table->string('sexo')->nullable();
            $table->string('carrera',50);
            $table->string('email')->unique();
            $table->string('actTutoria')->nullable();
            $table->string('actAca1')->nullable();
            $table->string('actAca2')->nullable();
            $table->string('actExt1')->nullable();
            $table->string('actExt2')->nullable();
            $table->string('nip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnos');
    }
}
