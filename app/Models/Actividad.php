<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;
    protected $primaryKey ="idAct";


    protected $fillable = [
        'idAct',
        'nombre',
        'descripcion',
        'numDictamen',
        'categoria',
        'periodo',
        'year',
        'lugar',
        'departamento',
        'horas',
        'creditos',
        'prestador',
    ];
}
