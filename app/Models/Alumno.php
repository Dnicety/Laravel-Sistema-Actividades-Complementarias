<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    protected $primaryKey ="noControl";

    protected $fillable = [
        'noControl',
        'nombre',
        'carrera',
        'email',
        'sexo',
        'nip',
    ];
}
