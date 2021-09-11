<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departamentos')->insert([
            'departamento' => 'Sistemas y computacion'            
        ]);
        DB::table('departamentos')->insert([
            'departamento' => 'Ingenieria Industrial'
        ]);
        DB::table('departamentos')->insert([
            'departamento' => 'Actividades Extraescolares'
        ]);
        DB::table('departamentos')->insert([
            'departamento' => 'Ingenieria Electrica y Electronica'
        ]);
        DB::table('departamentos')->insert([
            'departamento' => 'Centro de Computo'
        ]);
        DB::table('departamentos')->insert([
            'departamento' => 'Servicios Escolares'
        ]);
        DB::table('departamentos')->insert([
            'departamento' => 'Ciencias Económico-Administrativas'
        ]);
        DB::table('departamentos')->insert([
            'departamento' => 'Desarrollo Academico'
        ]);
        DB::table('departamentos')->insert([
            'departamento' => 'Division de Estudios Profesionales'
        ]);
        
    }
}
