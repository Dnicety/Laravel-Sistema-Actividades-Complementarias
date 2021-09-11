<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    use HasFactory;
    protected $primaryKey ="idCredito";
    protected $fillable = [
        'idAct',
        'noControl',
        'oficio',
        'docFirmado',
        'status',
    ];
}
