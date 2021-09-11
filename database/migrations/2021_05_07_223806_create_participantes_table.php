<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participantes', function (Blueprint $table) {
            $table->bigIncrements('idParticipante')->unique();
            $table->unsignedBigInteger('noControl');
            $table->unsignedBigInteger('idAct');
            $table->string('status', 30)->default('NO EVALUADO');

            $table->foreign('idAct')->references('idAct')->on('actividads');
            $table->foreign('noControl')->references('noControl')->on('alumnos');

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
        Schema::dropIfExists('participantes');
    }
}
