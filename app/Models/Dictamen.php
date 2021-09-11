<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dictamen extends Model
{
    use HasFactory;
    protected $primarykey = "numDictamen";

    protected $fillable = [
        'numDictamen',
        'actividad',
        'descripcion',
        'creditos',
        'departamento',
        'periodo',
        'year'
    ];
}
