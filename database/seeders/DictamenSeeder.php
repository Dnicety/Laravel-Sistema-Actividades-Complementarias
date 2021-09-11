<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DictamenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dictamens')->insert([
            'id' => 1,
            'numDictamen' => '000000',
            'actividad' => 'Actividades Extraescolares',
            'descripcion' => 'Dictamen generico',
            'creditos' => 1,
            'departamento' => 'Actividades Extraescolares',
            'periodo' => 'Enero-Junio',
            'year' => '2021',
        ]);
    }
}
