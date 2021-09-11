<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrador / M.I. Juan Ramón Olague Sánchez',
            'email' => 'cc_piedrasnegras@tecnm.mx',
            'password' => Hash::make('password'),
            'institucion' => 'Instituto Tecnologico de Piedras Negras',
            'departamento' => 'Centro de Computo',
            'telefono' => 'Ext. 224',
            'tipo' =>'ADMIN',
            'sexo' => 'H',
        ]);
        DB::table('users')->insert([
            'name' => 'Ing. Ulises Valdez Rodríguez',
            'email' => 'se_piedrasnegras@tecnm.mx',
            'password' => Hash::make('password'),
            'institucion' => 'Instituto Tecnologico de Piedras Negras',
            'departamento' => 'Servicios Escolares',
            'telefono' => 'Ext. 107',
            'tipo' =>'Servicios Escolares',
            'sexo' => 'H',
        ]);
        DB::table('users')->insert([
            'name' => 'Ing. Luis Manuel Garcia Pizarro',
            'email' => 'ext_piedrasnegras@tecnm.mx',
            'password' => Hash::make('password'),
            'institucion' => 'Instituto Tecnologico de Piedras Negras',
            'departamento' => 'Actividades Extraescolares',
            'telefono' => 'Ext. 229',
            'tipo' =>'JEFEDEPTO',
            'sexo' => 'H',
        ]);
        DB::table('users')->insert([
            'name' => 'Ing. Luis Arturo Treviño Romo',
            'email' => 'industrial@piedrasnegras.tecnm.mx',
            'password' => Hash::make('password'),
            'institucion' => 'Instituto Tecnologico de Piedras Negras',
            'departamento' => 'Ingenieria Industrial',
            'telefono' => 'Ext. 215',
            'tipo' =>'JEFEDEPTO',
            'sexo' => 'H',
        ]);
        DB::table('users')->insert([
            'name' => 'Lic. Guadalupe Uribe Miranda',
            'email' => 'sistemas@piedrasnegras.tecnm.mx',
            'password' => Hash::make('password'),
            'institucion' => 'Instituto Tecnologico de Piedras Negras',
            'departamento' => 'Sistemas y computacion',
            'telefono' => 'Ext. 227',
            'tipo' =>'JEFEDEPTO',
            'sexo' => 'M',
        ]);
        DB::table('users')->insert([
            'name' => 'M.P.E. Carlos Patiño Chávez',
            'email' => 'electronica@piedrasnegras.tecnm.mx',
            'password' => Hash::make('password'),
            'institucion' => 'Instituto Tecnologico de Piedras Negras',
            'departamento' => 'Ingenieria Electrica y Electrónica',
            'telefono' => 'Ext. 215',
            'tipo' =>'JEFEDEPTO',
            'sexo' => 'H',
        ]);
        DB::table('users')->insert([
            'name' => 'Mtra. Rosalinda Yamanaka Galván',
            'email' => 'cead_piedrasnegras@tecnm.mx',
            'password' => Hash::make('password'),
            'institucion' => 'Instituto Tecnologico de Piedras Negras',
            'departamento' => 'Ciencias Economico-Administrativas',
            'telefono' => 'Ext. 218',
            'tipo' =>'JEFEDEPTO',
            'sexo' => 'M',
        ]);
    }
}
