<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    public function __construct(string $departamento){
        $this->departamento = $departamento;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->departamento == 'ADMIN'){
            return User::all();
        }
        return User::where('departamento', $this->departamento)->get();
    }
}
