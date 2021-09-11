<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\AlumnosImport;
use App\Imports\ParticipanteImport;
use App\Imports\SemestreImport;
use App\Imports\ActividadesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Auth;

class LaravelExcelController extends Controller
{
    // Import de Semestre (Alumnos y Participantes)
    public function importSemestre(Request $request){
        $request->validate([
            'file' => 'required|max:50000|mimes:xlsx',
        ]);

        if($request->hasFile('file')){
            Excel::import(new SemestreImport($request->year, $request->periodo), $request->file);
            return redirect()->route('actividades.index')->withSuccess('Documento importado exitosamente!');
        }
    }

    // Import de Alumnos
    public function import(Request $request){
        $request->validate([
            'file' => 'required|max:50000|mimes:xlsx',
        ]);
        
        if($request->hasFile('file')){
            Excel::import(new AlumnosImport, $request->file);
            return redirect()->route('alumnos.index')->withSuccess('Documento importado exitosamente!');
        }
    }

    // Import de participantes a actividades
    public function importParticipantes(Request $request, $idAct){
        $request->validate([
            'file' => 'required|max:50000|mimes:xlsx',
        ]);
        if(DB::select('SELECT * FROM alumnos')){
            if($request->hasfile('file')){
                Excel::import(new ParticipanteImport($request->idAct), $request->file);
                return redirect()->route('actividades.show', $request->idAct)->withSuccess('Documento importado exitosamente!');
            }
        } else {
            return back()->withErrors('Verificar existencia de alumnos en el registro');
        }
    }
}
