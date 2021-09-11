<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    public const EXCELENTE = 3.56;
    public const NOTABLE = 2.43;
    public const BUENO = 1.57;
    public const SATISFACTORIO = 1;
    public const INSUFICIENTE = 0;

    protected $table = 'evaluacions';
    protected $primaryKey ="idEvaluacion";
    protected $fillable = [
        'noControl',
        'idAct',
        'periodo',
        'year', 
        'criterio1',
        'criterio2',
        'criterio3',
        'criterio4',
        'criterio5',
        'criterio6',
        'criterio7',
        'observaciones',
        'promedio',
        'nivel',
    ];

    public static function setExtraParams($model){
        $promedio = self::getPromedio($model);
        $nivel = self::getNivel($promedio);
        $model->nivel = $nivel;
        $model->promedio = $promedio;
    }

    public static function getPromedio($model){
        $totalCriterios = $model->attributes['criterio1']+$model->attributes['criterio2']+$model->attributes['criterio3']+$model->attributes['criterio4']+$model->attributes['criterio5']+$model->attributes['criterio6']+$model->attributes['criterio7'];
        $promedio = $totalCriterios / 7;
        return $promedio;
    }

    public static function getNivel($promedio){
        if( $promedio >= self::EXCELENTE ){
			$nivel = 'Excelente';
        } elseif( $promedio >= self::NOTABLE ){
			$nivel ='Notable';
        } elseif( $promedio >= self::BUENO ){
			$nivel = 'Bueno';
        } elseif( $promedio >= self::SATISFACTORIO ){
			$nivel = "Suficiente";
        } else {
			$nivel ='Insuficiente';
        }
		return $nivel;
    }

    public static function boot(){
        parent::boot();
        self::saving(function($model){
			self::setExtraParams($model);
        });
    }
   
}