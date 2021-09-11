<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluacions', function (Blueprint $table) {
            $table->bigIncrements('idEvaluacion')->unique();
            $table->unsignedBigInteger('noControl')->nullable();
            $table->unsignedBigInteger('idAct')->nullable();
            $table->string('periodo', 50);
            $table->string('year', 4);
            $table->integer('criterio1');
            $table->integer('criterio2');
            $table->integer('criterio3');
            $table->integer('criterio4');
            $table->integer('criterio5');
            $table->integer('criterio6');
            $table->integer('criterio7');
            $table->string('observaciones');
            $table->float('promedio');
            $table->string('nivel', 50);

            $table->foreign('noControl')->references('noControl')->on('alumnos');
            $table->foreign('idAct')->references('idAct')->on('actividads');

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
        Schema::dropIfExists('evaluacions');
    }
}
