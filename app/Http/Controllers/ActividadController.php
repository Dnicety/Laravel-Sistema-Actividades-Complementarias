<?php
namespace App\Http\Controllers;
use App\Models\Actividad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class ActividadController extends Controller
{

    public function index()
    {
        $actividades = DB::select('SELECT act.idAct, act.nombre, act.categoria, dict.periodo, dict.year, dict.departamento FROM dictamens as dict
        JOIN actividads as act ON act.numDictamen = dict.id WHERE dict.departamento = ?', [Auth::user()->departamento]);
        return view('actividades.actividades', compact('actividades'));   
    }

    public function actividadesRevision(){
        $actividades = db::select('SELECT p.status, al.nombre as alumnoname, al.noControl , act.idAct, act.nombre as actname, dict.periodo, dict.year, dict.departamento FROM participantes AS p 
        JOIN alumnos AS al ON al.noControl = p.noControl 
        JOIN actividads AS act ON act.idAct = p.idAct
        JOIN dictamens as dict ON act.numDictamen = dict.id
        WHERE status = ? AND departamento = ? ', ['EN REVISION', Auth::user()->departamento]);
        $listAct = db::select('SELECT DISTINCT act.idAct, act.nombre as actname, dict.departamento FROM participantes AS p 
        JOIN actividads AS act ON act.idAct = p.idAct
        JOIN dictamens AS dict ON act.numDictamen = dict.id
        WHERE status = ? AND departamento = ?', ['EN REVISION', Auth::user()->departamento]);
        return view('actividades.actividadesrevision', compact('actividades', 'listAct'));
    }

    public function misActividades(){
        $actividades = DB::select('SELECT act.idAct, act.nombre, act.categoria, act.prestador, dict.periodo, dict.year, dict.departamento FROM dictamens as dict
        JOIN actividads as act ON act.numDictamen = dict.id WHERE act.prestador = ?', [Auth::user()->id]);
        return view('actividades.actividades', compact('actividades'));
    }

    public function create(Request $request)
    {
        $dictamens = DB::select('SELECT * FROM dictamens WHERE departamento = ? AND periodo = ? AND year = ?', [Auth::user()->departamento, $request->periodo, $request->year]);
        $prestadores = DB::select('SELECT * FROM users WHERE departamento = ?', [Auth::user()->departamento]);
        return view("actividades.newactividad", compact('dictamens', 'prestadores'));
    }

    public function store(Request $request)
    {
        $actividades = new Actividad();
        $actividades->nombre = $request->nombre;
        $actividades->descripcion = $request->descripcion;
        $actividades->numDictamen = $request->numDictamen;
        $actividades->categoria = $request->categoria;
        $actividades->lugar = $request->lugar;
        $actividades->horas = $request->horas;
        $actividades->prestador = $request->prestador;
        $actividades->save();
        return redirect()->route('actividades.index');
    }

    public function show($idAct)
    {
        $prestador = DB::select('SELECT prestador from actividads WHERE idAct = ?', [$idAct]);
        if($prestador[0]->prestador == null){
            $actividades = DB::select('SELECT act.idAct, act.nombre, act.descripcion, act.horas, act.categoria, dict.numDictamen, dict.actividad, dict.periodo, dict.year, dict.departamento, dict.creditos, act.prestador FROM dictamens as dict
            JOIN actividads as act ON act.numDictamen = dict.id 
            WHERE act.idAct = ?', [$idAct]);
            if(!Auth::user()->tipo == "ADMIN"){
                if(Auth::user()->id != $actividades->prestador){
                    return abort(401);
                }
            }
        } else {
            $actividades = DB::select('SELECT act.idAct, act.nombre, act.descripcion, act.horas, act.categoria, dict.numDictamen, dict.actividad, dict.periodo, dict.year, dict.departamento, dict.creditos, act.prestador, u.id, u.name FROM dictamens as dict
            JOIN actividads as act ON act.numDictamen = dict.id 
            JOIN users as u ON u.id = act.prestador WHERE act.idAct = ?', [$idAct]);
            if(!Auth::user()->tipo == "ADMIN"){
                if(Auth::user()->id != $actividades->prestador){
                    return abort(401);
                }
            }
        }
        $prestadores = DB::select('SELECT * FROM users WHERE tipo = ? AND departamento = ?', ["PRESTADOR", Auth::user()->departamento]);
        $participantes = DB::select('SELECT p.idAct, p.idParticipante, a.noControl, nombre, carrera, email, p.status, c.status AS cstatus, e.observaciones FROM alumnos AS a 
        JOIN participantes AS p ON a.noControl = p.noControl
        JOIN creditos AS c ON c.idAct = p.idAct AND c.noControl = p.noControl
        JOIN evaluacions AS e ON e.idAct = p.idAct AND e.noControl = p.noControl
        WHERE p.idAct = ?', [$idAct]);
        return view('actividades.showactividades', compact('actividades', 'participantes', 'prestadores'));
    }

    public function edit($idAct)
    {
        $actividades = Actividad::findOrFail($idAct);
        $prestadores = DB::select('SELECT * FROM users WHERE departamento = ?', [Auth::user()->departamento]);
        return view('actividades.editactividades', compact('actividades', 'prestadores'));
    }

    public function update(Request $request, $idAct)
    {
        $actividades = Actividad::findorfail($idAct);
        $actividades->nombre = $request->nombre;
        $actividades->descripcion = $request->descripcion;
        $actividades->categoria = $request->categoria;
        $actividades->lugar = $request->lugar;
        $actividades->horas = $request->horas;
        $actividades->prestador = $request->prestador;
        $actividades->save();
        switch(Auth::user()->tipo){
            case 'JEFEDEPTO':
                return redirect()->route('actividades.index');
                break;
            case 'PRESTADOR':
                return redirect()->route('misactividades');
                break;
        }
    }

    public function updatePrestador(Request $request, $idAct){
        DB::update('UPDATE actividads SET prestador= ? WHERE idAct = ?', [$request->prestador , $idAct]);
        return redirect()->route('actividades.show', $request->idAct)->withSuccess('Se asigno prestador a la actividad');
    }

    public function destroy($idAct)
    {
        if(DB::select('SELECT * FROM participantes WHERE idAct = ?', [$idAct])){
            return back()->withErrors('La actividad cuenta con participantes registrados, elimine participantes antes de eliminar actividad.');
        } else {
            Actividad::destroy($idAct);
            return redirect()->route('actividades.index')->withSuccess('Actividad eliminada exitosamente!');
        }
    }
}
