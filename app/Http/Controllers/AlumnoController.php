<?php
namespace App\Http\Controllers;
use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class AlumnoController extends Controller
{
    public function consulta(Request $request){
        if(DB::select('SELECT * FROM alumnos WHERE noControl = ? AND nip = ?', [$request->noControl, $request->nip])){
            $alumno = Alumno::findorfail($request->noControl);
            $cTutoria = DB::select('SELECT a.nombre, c.idCredito, c.oficio, c.docFirmado, c.created_at FROM creditos AS c
            JOIN actividads AS a ON c.idAct = a.idAct
            WHERE c.noControl = ? AND c.idAct = ? AND c.status = ?', [$request->noControl, $alumno->actTutoria, 'LIBERADO']);
            $cActAca1 = DB::select('SELECT a.nombre, c.idCredito, c.oficio, c.docFirmado, c.created_at FROM creditos AS c
            JOIN actividads AS a ON c.idAct = a.idAct
            WHERE c.noControl = ? AND c.idAct = ? AND c.status = ?', [$request->noControl, $alumno->actAca1, 'LIBERADO']);
            $cActAca2 = DB::select('SELECT a.nombre, c.idCredito, c.oficio, c.docFirmado, c.created_at FROM creditos AS c
            JOIN actividads AS a ON c.idAct = a.idAct
            WHERE c.noControl = ? AND c.idAct = ? AND c.status = ?', [$request->noControl, $alumno->actAca2, 'LIBERADO']);
            $cActExt1 = DB::select('SELECT a.nombre, c.idCredito, c.oficio, c.docFirmado, c.created_at FROM creditos AS c
            JOIN actividads AS a ON c.idAct = a.idAct
            WHERE c.noControl = ? AND c.idAct = ? AND c.status = ?', [$request->noControl, $alumno->actExt1, 'LIBERADO']);
            $cActExt2 = DB::select('SELECT a.nombre, c.idCredito, c.oficio, c.docFirmado, c.created_at FROM creditos AS c
            JOIN actividads AS a ON c.idAct = a.idAct
            WHERE c.noControl = ? AND c.idAct = ? AND c.status = ?', [$request->noControl, $alumno->actExt2, 'LIBERADO']);
            return view('alumnos.consultaCreditos', compact('alumno', 'cTutoria', 'cActAca1', 'cActAca2', 'cActExt1', 'cActExt2'));
        } else {
            return redirect()->route('login')->withErrors('Numero de control o NIP incorrecto!');
        }
    }

    public function index()
    {
        $alumnos = Alumno::orderBy('noControl', 'asc')->get();
        $countAlumnos = Alumno::count();
        return view('alumnos.alumnos', compact('alumnos', 'countAlumnos'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($noControl)
    {
        
    }

    public function edit($noControl)
    {
        $alumno = Alumno::findorfail($noControl);
        return view('alumnos.editalumno', compact('alumno'));
    }

    public function update(Request $request, $noControl)
    {
        $alumno = Alumno::findorfail($noControl);
        $alumno->nombre = $request->nombre;
        $alumno->sexo = $request->sexo;
        $alumno->email = $request->email;
        $alumno->nip = $request->nip;
        $alumno->carrera = $request->carrera;
        $alumno->save();

        return redirect()->route('alumnos.index')->withSuccess('Alumno editado exitosamente!');
    }

    public function destroyAll(){
        $array = array(); 
        $alumnos = DB::select('SELECT noControl FROM alumnos');
        foreach($alumnos as $alumno){
            if(DB::select('SELECT * FROM participantes WHERE noControl = ?', [$alumno->noControl])){
                $array[] = $alumno->noControl;
            } else {
                Alumno::destroy($alumno->noControl);
            }
        }
        if(count($array) != 0){
            return back()->withSuccess('Alumnos eliminados exitosamente! Elementos que no se pudieron eliminar: ' . count($array));
        } else {
            return back()->withSuccess('Alumnos eliminados exitosamente!');
        }
    }

    public function destroy($noControl)
    {
        if(DB::select('SELECT * FROM participantes WHERE noControl = ?', [$noControl])){
            return back()->withErrors('No se pudo eliminar: el alumno se encuentra registrado en una actividad.');
        } else {
            Alumno::destroy($noControl);
            return back()->withSuccess('Alumno eliminado exitosamente!');
        }        
    }
}
