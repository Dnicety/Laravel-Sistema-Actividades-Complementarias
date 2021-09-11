<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartamentoController extends Controller
{
    public function index()
    {
        $departamentos = DB::select('SELECT * FROM departamentos');
        return view('departamentos.departamentos', compact('departamentos'));
    }

    public function create()
    {
        return view('departamentos.newdepartamento');
    }

    public function store(Request $request)
    {
        $departamento = new Departamento();
        $departamento->departamento = $request->departamento;
        $departamento->abr = $request->abr;
        $departamento->save();
        return redirect()->route('departamentos.index')->withSuccess('Departamento agregado exitosamente');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $departamento = Departamento::findorfail($id);
        return view('departamentos.editdepartamentos', compact('departamento'));
    }

    public function update(Request $request, $id)
    {
        $departamento = Departamento::findorfail($id);
        $departamento->departamento = $request->departamento;
        $departamento->abr = $request->abr;
        $departamento->save();
        return redirect()->route('departamentos.index')->withSuccess('Departamento editado exitosamente');
    }

    public function destroy($id)
    {
        Departamento::destroy($id);
        return redirect()->route('departamentos.index')->withSuccess('Departamento eliminado exitosamente');
    }
}
