<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creditos', function (Blueprint $table) {
            $table->bigIncrements('idCredito')->unique();
            $table->unsignedBigInteger('idAct');
            $table->unsignedBigInteger('noControl');
            $table->string('oficio')->nullable();
            $table->string('docFirmado')->nullable();
            $table->string('status')->default('NO LIBERADO');
            $table->timestamps();

            $table->foreign('idAct')->references('idAct')->on('actividads');
            $table->foreign('noControl')->references('noControl')->on('alumnos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creditos');
    }
}
