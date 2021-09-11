<?php
namespace App\Imports;
use App\Models\Participante;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;

class ParticipanteImport implements ToModel, WithHeadingRow, WithValidation
{
    public function __construct(int $idAct)
    {
        $this->idAct = $idAct;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Participante([
            'noControl' => $row['nocontrol'],
            'idAct' => $this->idAct,
        ]);        
    }

    public function rules(): array{
        $rules = [
            'nocontrol' => 'required',
        ];
        return $rules;
    }

    public function customValidationMessages(){
        return [
            'nocontrol.required' => 'Verifique el documento xlsx cuente con el formato correcto. Campo -nocontrol- requerido',
        ];
    }
}
