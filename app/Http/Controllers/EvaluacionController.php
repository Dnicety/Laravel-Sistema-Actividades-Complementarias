<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\Actividad;
use App\Models\Alumno;
use App\Models\Credito;
use App\Models\Documento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use PDF;
use Auth;

class EvaluacionController extends Controller
{
    public function export(Request $request){
        $actividad = DB::select('SELECT act.idAct, act.nombre, act.descripcion, act.categoria, act.lugar, act.horas, act.prestador, dict.numDictamen, dict.creditos, dict.departamento, dict.periodo, dict.year, user.id, user.name, user.sexo, user.docente
        FROM actividads AS act 
        JOIN dictamens AS dict ON dict.id = act.numDictamen 
        JOIN users AS user ON act.prestador = user.id
        WHERE idAct = ?', [$request->idAct]);
        $alumno =  DB::select('SELECT a.noControl, a.nombre, a.email ,a.carrera, a.sexo FROM participantes as p 
        JOIN alumnos AS a ON a.noControl = p.noControl 
        WHERE p.noControl = ? AND p.idAct = ?', [$request->noControl, $request->idAct]);
        $evaluacion = DB::select('SELECT nivel, promedio FROM evaluacions WHERE noControl = ? AND idAct = ?', [$request->noControl, $request->idAct]);
        $credito = DB::select('SELECT * FROM creditos WHERE idAct = ? AND noControl = ?', [$request->idAct, $request->noControl]);
        $jefeescolares = DB::select('SELECT * FROM users WHERE tipo = ? AND departamento = ?', ['Servicios escolares', 'Servicios escolares']);
        $jefedepto = DB::select('SELECT * FROM users WHERE tipo = ? AND departamento = ?', ['JEFEDEPTO', Auth::user()->departamento]);
        if($request->action == 4){
            $data = compact('alumno', 'actividad', 'evaluacion', 'credito', 'jefeescolares','jefedepto');
        } else {
            $documento = Documento::find(1);
            $data = compact('alumno', 'actividad', 'evaluacion', 'credito', 'jefeescolares','jefedepto', 'documento');
        }
        $pdf = PDF::loadview('exports.constanciaAct', $data);
        if($request->action == 0){
            foreach($evaluacion as $e){
                if($e->nivel == 'Insuficiente'){
                    return redirect()->route('actividades.show', $request->idAct);
                }
            }
            return $pdf->stream($alumno[0]->noControl . $actividad[0]->periodo . $actividad[0]->year . '.pdf');
        } elseif (($request->action == 1) || ($request->action == 4)){
            return $pdf->download($alumno[0]->noControl . $actividad[0]->periodo . $actividad[0]->year . '.pdf');
        } elseif ($request->action == 2) {
            return redirect()->route('mailConstancia', ['idCredito' => $credito[0]->idCredito, 'mail' => $alumno[0]->email]);
        }
    }

    public function index()
    {
        //
    }

    public function create(Request $request)
    {   
        if(DB::select('SELECT * FROM actividads WHERE prestador IS NULL AND idAct = ?', [$request->idAct])){
            return back()->withErrors('Se requiere asignar un encargado de actividad para llevar a cabo una evaluacion');
        }
        if(DB::select('SELECT * FROM actividads WHERE prestador = ?', [Auth::user()->id])){
            $alumno = DB::select('SELECT a.noControl, act.nombre, dict.periodo, dict.year, act.idAct FROM participantes as p 
            JOIN alumnos AS a ON a.noControl = p.noControl 
            JOIN actividads AS act ON act.idAct = p.idAct 
            JOIN dictamens as dict ON dict.id = act.numDictamen WHERE p.noControl = ? AND p.idAct = ?', [$request->noControl, $request->idAct]);
            return view("evaluaciones.newevaluacion", compact('alumno'));
        } else {
            return back()->withErrors('Solo el encargado tiene permitido llevar a cabo una evaluacion');
        }
    }

    public function store(Request $request)
    {        
        $evaluacion = new Evaluacion();        
        $evaluacion->fill($request->all());
        $evaluacion->save();
        $count = DB::table('evaluacions')
        ->join('actividads', 'evaluacions.idAct', '=', 'actividads.idAct')
        ->join('dictamens', 'actividads.numDictamen', '=', 'dictamens.id')
        ->where('dictamens.departamento', '=', Auth::user()->departamento)
        ->where('evaluacions.nivel', '!=', 'Insuficiente')
        ->where('dictamens.year', '=', now()->year)->count();
        if($count < 10){ $count = "00" . (string)$count; } else { if($count < 100){ $count = "0" . (string)$count; } else { (string)$count; }};
        

        $departamento = DB::select('SELECT abr FROM departamentos WHERE departamento = ?', [Auth::user()->departamento]);
        $credito = new Credito();
        $credito->idAct = $request->idAct;
        $credito->noControl = $request->noControl;
        $credito->oficio = $departamento[0]->abr . $count . now()->year;
        $credito->save();
        return redirect()->route('updateStatus', ['noControl' => $request->noControl, 'idAct' => $request->idAct, 'nivel' => $evaluacion->nivel]);
    }

    public function show($noControl, $idAct)
    {
        $alumno = Alumno::find($noControl);
        $actividad = DB::select('SELECT act.idAct, act.nombre, act.descripcion, act.categoria, act.lugar, act.horas, act.prestador, dict.numDictamen, dict.creditos, dict.departamento, dict.periodo, dict.year, user.id, user.name, user.sexo
        FROM actividads AS act 
        JOIN dictamens AS dict ON dict.id = act.numDictamen 
        JOIN users AS user ON act.prestador = user.id
        WHERE idAct = ?', [$idAct]);
        $evaluacion = DB::select('SELECT * FROM evaluacions WHERE idAct = ? AND noControl = ?', [$idAct, $noControl]);
        $departamento = DB::select('SELECT abr FROM departamentos WHERE departamento = ?', [$actividad[0]->departamento]);
        return view('evaluaciones.showevaluacion', compact('evaluacion', 'alumno', 'actividad', 'departamento'));    
    }

    public function edit(Evaluacion $evaluacion)
    {
        
    }

    public function update(Request $request)
    {
        
    }

    public function destroy(Evaluacion $evaluacion)
    {
        //
    }
}
