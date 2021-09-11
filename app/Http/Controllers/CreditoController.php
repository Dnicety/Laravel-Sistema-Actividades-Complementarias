<?php

namespace App\Http\Controllers;

use App\Models\Credito;
use App\Models\Alumno;
use App\Models\Actividad;
use App\Models\Evaluacion;
use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Auth;
use PDF;
use ZipArchive;

class CreditoController extends Controller
{
    public function liberarConstancia($noControl, $idAct){
        if(DB::select('SELECT docFirmado FROM creditos WHERE idAct = ? AND noControl = ?', [$idAct, $noControl])){
            DB::update('UPDATE creditos SET creditos.status = ? WHERE noControl = ? AND idAct = ?', ['LIBERADO', $noControl, $idAct]);
            $alumno = Alumno::findorfail($noControl);
            $actividad = Actividad::findorfail($idAct);
            $evaluacion = Evaluacion::where('noControl', $noControl)->where('idAct', $idAct)->get();
            if($actividad->categoria){
                switch($actividad->categoria){
                    case "Tutoria": // Verifica no exista credito por tutoria y asigna el credito disponible al campo disponible
                        if(!$alumno->actTutoria){
                            DB::update('UPDATE alumnos SET actTutoria = ? WHERE noControl = ?', [$evaluacion[0]->idAct, $alumno->noControl]);
                            break;
                        }
                    case "Actividad Cultural": // Verifica no exista credito extraescolar 1 y 2, y asigna el credito disponible al campo disponible
                        if(!$alumno->actExt1){
                            DB::update('UPDATE alumnos SET actExt1 = ? WHERE noControl = ?', [$evaluacion[0]->idAct, $alumno->noControl]);
                            break;
                        }
                        if(!$alumno->actExt2){
                            DB::update('UPDATE alumnos SET actExt2 = ? WHERE noControl = ?', [$evaluacion[0]->idAct, $alumno->noControl]);
                            break;
                        }
                    case "Actividad Deportiva": // Verifica no exista credito extraescolar 1 y 2, y asigna el credito disponible al campo disponible
                        if(!$alumno->actExt1){
                            DB::update('UPDATE alumnos SET actExt1 = ? WHERE noControl = ?', [$evaluacion[0]->idAct, $alumno->noControl]);
                            break;
                        }
                        if(!$alumno->actExt2){
                            DB::update('UPDATE alumnos SET actExt2 = ? WHERE noControl = ?', [$evaluacion[0]->idAct, $alumno->noControl]);
                            break;
                        }
                    default: // Verifica no exista credito academico 1 y 2, y asigna el credito disponible al campo disponible
                        if(!$alumno->actAca1){
                            DB::update('UPDATE alumnos SET actAca1 = ? WHERE noControl = ?', [$evaluacion[0]->idAct, $alumno->noControl]);
                            break;
                        }
                        if(!$alumno->actAca2){
                            DB::update('UPDATE alumnos SET actAca2 = ? WHERE noControl = ?', [$evaluacion[0]->idAct, $alumno->noControl]);
                            break;
                        }
                }
            }
            return back()->withSuccess('Se libero el credito exitosamente!');
        } else {
            return back()->withErrors('Ocurrio un error al intentar liberar el credito');
        }
    }

    public function regresarConstancia($noControl, $idAct){
        if(DB::select('SELECT docFirmado FROM creditos WHERE idAct = ? AND noControl = ?', [$idAct, $noControl])){
            DB::update('UPDATE creditos SET creditos.status = ?, docFirmado = ? WHERE noControl = ? AND idAct = ?', ['NO LIBERADO', null, $noControl, $idAct]);
            DB::update('UPDATE participantes SET participantes.status = ? WHERE noControl = ? AND idAct = ?', ['EN REVISION', $noControl, $idAct]);
            return back()->withSuccess('Se regreso a revision la constancia exitosamente!');
        } else {
            return back()->withErrors('Ocurrio un error al intentar regresar el credito a revision');
        }
    }

    public function verConstancia($noControl, $idAct){
        $credito = DB::select('SELECT docFirmado FROM creditos WHERE idAct = ? AND noControl = ?', [$idAct, $noControl]);
        $public_path = public_path();
        $url = $public_path.$credito[0]->docFirmado;
        return response()->file($url);
    }

    // Opcion para la consulta por parte del alumno
    public function descargarConstancia($noControl, $idAct){
        if(DB::select('SELECT docFirmado FROM creditos WHERE idAct = ? AND noControl = ?', [$idAct, $noControl])){
            $credito = DB::select('SELECT docFirmado FROM creditos WHERE idAct = ? AND noControl = ?', [$idAct, $noControl]);
            $public_path = public_path();
            $url = $public_path.$credito[0]->docFirmado;
            return response()->download($url);
        } else {
            abort(404);
        }
    }

    // Opcion para la revision de constancias
    public function descargarDocumento($id){
        if(DB::select('SELECT docFirmado FROM creditos WHERE idCredito = ?', [$id])){
            $credito = DB::select('SELECT docFirmado FROM creditos WHERE idCredito = ?', [$id]);
            $public_path = public_path();
            $url = $public_path.$credito[0]->docFirmado;
            return response()->download($url);
        } else {
            abort(404);
        }
    }

    // Descarga de constancias comprimidas .zip
    public function descargarDocumentos(Request $request){
        $pendientes = db::select('SELECT p.status, p.noControl, act.idAct, act.nombre as actname FROM participantes AS p 
        JOIN actividads AS act ON act.idAct = p.idAct
        WHERE status = ? AND act.idAct = ?', ['EN REVISION', $request->actividad]);

        $zip = new ZipArchive;        
        $filename =  'constancias.zip';
        $zip->open($filename, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE);
            foreach($pendientes as $act){
                $actividad = DB::select('SELECT act.idAct, act.nombre, act.descripcion, act.categoria, act.lugar, act.horas, act.prestador, dict.numDictamen, dict.creditos, dict.departamento, dict.periodo, dict.year, user.id, user.name, user.sexo, user.docente
                FROM actividads AS act 
                JOIN dictamens AS dict ON dict.id = act.numDictamen 
                JOIN users AS user ON act.prestador = user.id
                WHERE idAct = ?', [$act->idAct]);
                $alumno =  DB::select('SELECT a.noControl, a.nombre, a.email ,a.carrera, a.sexo FROM participantes as p 
                JOIN alumnos AS a ON a.noControl = p.noControl 
                WHERE p.noControl = ? AND p.idAct = ?', [$act->noControl, $act->idAct]);
                $evaluacion = DB::select('SELECT nivel, promedio FROM evaluacions WHERE noControl = ? AND idAct = ?', [$act->noControl, $act->idAct]);
                $credito = DB::select('SELECT * FROM creditos WHERE idAct = ? AND noControl = ?', [$act->idAct, $act->noControl]);
                $jefeescolares = DB::select('SELECT * FROM users WHERE tipo = ? AND departamento = ?', ['Servicios escolares', 'Servicios escolares']);
                $jefedepto = DB::select('SELECT * FROM users WHERE tipo = ? AND departamento = ?', ['JEFEDEPTO', Auth::user()->departamento]);
                $documento = Documento::find(1);
                $data = compact('alumno', 'actividad', 'evaluacion', 'credito', 'jefeescolares','jefedepto', 'documento');
                $pdf = PDF::loadview('exports.constanciaAct', $data);

                file_put_contents($alumno[0]->noControl . $actividad[0]->periodo . $actividad[0]->year . '.pdf', $pdf->stream());
                $files = $alumno[0]->noControl . $actividad[0]->periodo . $actividad[0]->year . '.pdf';
                $zip->addFile($files);
            };

        $zip->close();
        return response()->download($filename);
    }

    public function index()
    {
        $creditos = DB::select('SELECT act.nombre AS actNombre, act.idAct, al.noControl, al.nombre, al.carrera, c.oficio, c.docFirmado FROM creditos AS c
        JOIN alumnos AS al ON c.noControl = al.noControl
        JOIN actividads AS act ON c.idAct = act.idAct
        WHERE c.docFirmado IS NOT NULL AND c.status = ?', ['NO LIBERADO']);
        return view('creditos.creditos', compact('creditos'));
    }

    public function historial(){
        $creditos = DB::select('SELECT act.nombre AS actNombre, al.noControl, al.nombre, al.carrera, c.oficio, c.docFirmado FROM creditos AS c
        JOIN alumnos AS al ON c.noControl = al.noControl
        JOIN actividads AS act ON c.idAct = act.idAct
        WHERE c.docFirmado IS NOT NULL AND c.status = ?', ['LIBERADO']);
        return view('creditos.historialcreditos', compact('creditos'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Credito $credito)
    {
        //
    }

    public function edit(Credito $credito)
    {
        //
    }

    public function update(Request $request, $idAct, $idEva, $noControl)
    {
        $request->validate([
            'file' => 'required|image|max:2048'
        ]);
        $path = $request->file('file')->store('public/constancia');
        $url = Storage::url($path);
        DB::update('UPDATE creditos SET docFirmado = ? WHERE noControl = ? AND idAct = ?', [$url, $noControl, $idAct]);
        DB::update('UPDATE participantes AS p SET p.status = ? WHERE idAct = ? AND noControl = ?', ['EVALUADO', $idAct, $noControl]);
        return redirect()->route('actividadesrevision');
    }

    public function destroy(Credito $credito)
    {
        //
    }
}
