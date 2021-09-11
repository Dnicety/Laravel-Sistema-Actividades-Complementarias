<?php
namespace App\Imports;

use App\Models\Actividad;
use App\Models\Participante;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;

class SemestreImport implements ToModel, WithHeadingRow, WithValidation
{
    public function __construct(string $year, string $periodo){
        HeadingRowFormatter::default('none');
        $this->year = $year;
        $this->periodo = $periodo;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row){
        if(DB::select('SELECT nombre, dict.periodo, dict.year FROM actividads JOIN dictamens AS dict ON dict.id = actividads.numDictamen WHERE nombre = ? AND dict.periodo = ? AND dict.year = ?', [$row['Selecciona la Actividad Extraescolar y promotor'], $this->periodo, $this->year])) {
            if(DB::select('SELECT * FROM alumnos WHERE noControl = ?', [$row['Numero de control.']])){
                $actividad = DB::select('SELECT * FROM actividads WHERE nombre = ?', [$row['Selecciona la Actividad Extraescolar y promotor']]);
                $alumno = DB::select('SELECT * FROM alumnos WHERE noControl = ?', [$row['Numero de control.']]);
                if(DB::select('SELECT * FROM participantes WHERE idAct = ? AND noControl = ?', [$actividad[0]->idAct, $alumno[0]->noControl])){
                } else {
                    return new Participante([
                    'noControl' => $alumno[0]->noControl,
                    'idAct' => $actividad[0]->idAct,
                    ]);
                }
            }
        } else {
            if(preg_match( '!\(([^\)]+)\)!', $row['Selecciona la Actividad Extraescolar y promotor'], $match));
            if(count($match) == 2){
                if(User::where('name', $match[1])){
                    $user = DB::select('SELECT * FROM users WHERE name = ?', [$match[1]]);
                    foreach($user as $item){
                        return new Actividad([
                            'idAct' => $this->year . $row['ID'],
                            'nombre' => $row['Selecciona la Actividad Extraescolar y promotor'],
                            'prestador' => $item->id,
                            'numDictamen' => 1,
                        ]);
                    }
                }
            }
            return new Actividad([
                'idAct' => $this->year . $row['ID'],
                'nombre' => $row['Selecciona la Actividad Extraescolar y promotor'],
                'numDictamen' => 1,
            ]);
        }
    }

    public function rules(): array{
        $rules = [
            'ID' => 'required',
            'Selecciona la Actividad Extraescolar y promotor' => 'required',
        ];
        return $rules;
    }

    public function customValidationMessages(){
        return [
            'ID.required' => 'Verifique el documento xlsx cuente con el formato correcto. Campo con ID requerido',
            'Selecciona la Actividad Extraescolar y promotor.required' => 'Verifique el documento xlsx cuente con el formato correcto. Campo de actividad requerido',
        ];
    }

}






























/*


$actividades = DB::select('SELECT DISTINCT nombre FROM actividads'); // Se revisan las actividades en la base de datos (nombres)
        foreach($actividades as $item){

            if($row['Selecciona la Actividad Extraescolar y promotor'] == $item->nombre){
                $text = $item->nombre; preg_match('#\((.*?)\)#', $text, $match); // Sacar el prestador de los ()

                $actividad = DB::select('SELECT * FROM actividads WHERE nombre = ?', [$item->nombre]);
                $alumnos = DB::select('SELECT * FROM alumnos');
                foreach($actividad as $a){
                    foreach($alumnos as $alumno){
                        if($row['Numero de control.'] == $alumno->noControl){
                            //$participantes = DB::select('SELECT ');
                            return new Participante([
                                'noControl' => $row['Numero de control.'],
                                'idAct' => $a->idAct,
                            ]);       
                        }
                    }
                }
                break;
            } else {
                $nameActividad = $item->nombre; $porciones = explode("(", $nameActividad); // Separar nombre de la actividad

                return new Actividad([
                    'nombre' => $nameActividad,
                ]);
            }
        }
*/