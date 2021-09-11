<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use PDF;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documento = Documento::find(1);
        return view('evaluaciones.formatoevaluacion', compact('documento'));
    }

    public function showFormato(){
        $documento = Documento::find(1);
        $pdf = PDF::loadview('exports.constanciaAct', compact('documento'));
        return $pdf->stream('formatoConstancia.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $documento = new Documento();
        $documento->id = 1;
        $documento->imgheader = $request->header;
        $documento->imgbody = $request->body;
        $documento->imgfooter = $request->footer;
        $documento->fonturl = $request->fonturl;
        $documento->font = $request->font;
        $documento->frase = $request->frase;
        $documento->save();

        return back()->withSuccess('Cambios realizados al formato');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function show(Documento $documento)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function edit(Documento $documento)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        $documento = Documento::find($id);
        $documento->imgheader = $request->header;
        $documento->imgbody = $request->body;
        $documento->imgfooter = $request->footer;
        $documento->fonturl = $request->fonturl;
        $documento->font = $request->font;
        $documento->frase = $request->frase;
        $documento->save();

        return back()->withSuccess('Cambios realizados al formato');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Documento $documento)
    {
        //
    }
}
