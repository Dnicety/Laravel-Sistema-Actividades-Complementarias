<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividads', function (Blueprint $table) {
            $table->bigIncrements('idAct')->unique();
            $table->string('nombre', 100);
            $table->string('descripcion')->nullable();
            $table->unsignedBigInteger('numDictamen')->nullable();
            $table->string('categoria', 100)->nullable();
            $table->string('lugar', 100)->nullable();
            $table->integer('horas')->default(2);
            $table->unsignedBigInteger('prestador')->nullable();

            $table->foreign('prestador')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('numDictamen')->references('id')->on('dictamens')->onDelete('cascade');;

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
        Schema::dropIfExists('actividads');
    }
}
