<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDictamensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dictamens', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('numDictamen');
            $table->string('actividad', 255);
            $table->string('descripcion', 255);
            $table->integer('creditos');
            $table->string('departamento', 100);
            $table->string('periodo', 50)->nullable();
            $table->string('year', 4)->nullable();
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
        Schema::dropIfExists('dictamens');
    }
}
