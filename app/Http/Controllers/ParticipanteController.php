<?php
namespace App\Http\Controllers;
use App\Models\Participante;
use App\Models\Actividad;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use PDF;
use Auth;

class ParticipanteController extends Controller
{

    public function updateStatus(Request $request){
        DB::update('UPDATE participantes SET status = ? WHERE noControl = ? AND idAct = ?', [($request->nivel != 'Insuficiente') ? 'EN REVISION' : 'NO ACREDITA' ,$request->noControl, $request->idAct]);
        return redirect()->route('actividades.show', $request->idAct)->withSuccess('Evaluacion realizada correctamente!');
    }

    public function export(Request $request){
        $actividades = DB::select('SELECT * FROM actividads AS act 
        JOIN dictamens AS dict ON dict.id = act.numDictamen
        WHERE act.idAct = ?', [$request->idAct]);
        $prestador = DB::select('SELECT u.id, u.name FROM users as u WHERE id = ?', [$actividades[0]->prestador]);
        $participantes = DB::select('SELECT p.idAct, p.idParticipante, a.noControl, nombre, carrera, p.status FROM alumnos AS a JOIN participantes as p ON a.noControl = p.noControl WHERE p.idAct = ?', [$request->idAct]);
        $data = compact('participantes', 'actividades', 'prestador');
        $pdf = PDF::loadview('exports.participantes', $data);
        return $pdf->stream();
    }

    public function index(Request $request)
    {
        $participantes = where('idParticipante', $request)->get();
        return $participantes;
    }

    public function create()
    {
        return view("participantes.newparticipante");
    }

    public function store(Request $request, $idAct)
    {
        if(!DB::select('SELECT * FROM alumnos WHERE noControl = ?', [$request->noControl])){
            return back()->withErrors('Verificar numero de control');
        }
        if(DB::select('SELECT * FROM participantes WHERE idAct = ? AND noControl = ?', [$idAct, $request->noControl])){
            return back()->withErrors('Ya existe un aprticipante con el numero de control ' . $request->noControl);
        } else {
            $participantes = new Participante();
            $participantes->noControl = $request->noControl;
            $participantes->idAct = $request->idAct;
            $participantes->save();
            return back()->withSuccess('Participante agregado correctamente.');
        }
    }

    public function show(Participante $participante)
    {
        //
    }

    public function edit(Participante $participante)
    {
        //
    }

    public function update(Request $request, Participante $participante)
    {
        //
    }

    public function destroy($idParticipante)
    {
        $participante = Participante::find($idParticipante);
        if($participante->status != 'NO EVALUADO'){
            return back()->withErrors("No se pudo eliminar participante porque ya fue evaluado");
        } else {
            Participante::destroy($idParticipante);
            return back()->withSuccess("Se elimino participante correctamente");
        }
    }

    public function destroyParticipantes($idAct){
        $participantes = DB::select('SELECT * FROM participantes WHERE idAct = ?', [$idAct]);
        foreach($participantes as $item){
            Participante::destroy($item->idParticipante);
        }        
        return back()->withSuccess('Participantes eliminados correctamente!');
    }
}
