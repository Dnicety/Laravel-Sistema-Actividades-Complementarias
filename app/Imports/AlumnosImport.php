<?php

namespace App\Imports;

use App\Models\Alumno;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;

class AlumnosImport implements ToModel, WithValidation
{
    /**
    * @param array $row
    */
    public function model(array $row)
    {
        if(DB::select('SELECT * FROM alumnos WHERE noControl = ?', [$row[0]])){} 
        else {
            return new Alumno([
                'noControl'     => $row[0],
                'nombre'    => $row[1], 
                'carrera'    => $row[2], 
                'email' => "l" . $row[0] . "@piedrasnegras.tecnm.mx",
                'nip' => $row[0],
                'sexo' => $row[3],
            ]);
        }
    }

    public function rules(): array{
        $rules = [
            '0' => 'required|numeric',
            '3' => 'string|nullable',
        ];
        return $rules;
    }

    public function customValidationMessages(){
        return [
            '0.required' => 'Verifique el documento xlsx cuente con el formato correcto. Campo con numero de control requerido',
            '0.numeric' => 'Verifique el documento xlsx cuente con el formato correcto. Campo con numero de control requiere que sea numerico',
        ];
    }

}
