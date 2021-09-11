<?php

namespace App\Http\Controllers;

use App\Models\Dictamen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class DictamenController extends Controller
{
    public function index()
    {
        $dictamens = DB::select('SELECT * FROM dictamens WHERE departamento = ?', [Auth::user()->departamento]);
        return view('dictamens.dictamens', compact('dictamens'));
    }

    public function create()
    {
        return view('dictamens.newdictamens');
    }

    public function store(Request $request)
    {
        $dictamen = new Dictamen();
        $dictamen->numDictamen = $request->numDictamen;
        $dictamen->actividad = $request->actividad;
        $dictamen->descripcion = $request->descripcion;
        $dictamen->creditos = $request->creditos;
        $dictamen->departamento = $request->departamento;
        $dictamen->periodo = $request->periodo;
        $dictamen->year = $request->year;
        $dictamen->save();
        return redirect()->route('disctamens.index')->withSuccess('Numero de dictamen creado exitosamente!');
    }

    public function show($id)
    {
        $dictamen = Dictamen::findorfail($id);
        return view('dictamens.showdictamens', compact('dictamen'));
    }

    public function edit($numDictamen)
    {
        $dictamen = Dictamen::findOrFail($numDictamen);
        return view('dictamens.editdictamens', compact('dictamen'));
    }

    public function update(Request $request, $numDictamen)
    {
        $dictamen = Dictamen::findorfail($numDictamen);
        $dictamen->numDictamen = $request->numDictamen;
        $dictamen->actividad = $request->actividad;
        $dictamen->descripcion = $request->descripcion;
        $dictamen->creditos = $request->creditos;
        $dictamen->departamento = $request->departamento;
        $dictamen->periodo = $request->periodo;
        $dictamen->year = $request->year;
        $dictamen->save();
        return redirect()->route('disctamens.index')->withSuccess('Numero de dictamen editado exitosamente!');
    }

    public function destroy($numDictamen)
    {
        if(DB::select('SELECT * FROM actividads WHERE numDictamen = ?', [$numDictamen])){
            return back()->withErrors('El numero de dictamen fue asignado a una actividad, elimine la actividad antes.');
        } else {
            Dictamen::destroy($numDictamen);
            return redirect()->route('disctamens.index')->withSuccess('Numero de dictamen eliminado correctamente!');
        }
    }
}
