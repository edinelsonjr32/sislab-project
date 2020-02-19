<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoSolicitanteRequest;
use App\TipoSolicitante;
use Illuminate\Http\Request;

class TipoSolicitanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TipoSolicitante $model)
    {
        return view('tipo_solicitante.index', ['tipos' => $model->paginate(15)]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipo_solicitante.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoSolicitanteRequest $request, TipoSolicitante $model)
    {
        $model->create($request->all());

        return redirect()->route('tipo_solicitante.index')->withStatus(__('Tipo Solicitante criado com sucesso.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoSolicitante $tipoSolicitante)
    {
        return view('tipo_solicitante.edit', compact('tipoSolicitante'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipoSolicitanteRequest $request, TipoSolicitante $tipoSolicitante)
    {
        $tipoSolicitante->update($request->all());

        return redirect()->route('tipo_solicitante.index')->withStatus(__('Tipo Solicitante Editado com sucesso!!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoSolicitante $tipoSolicitante)
    {
        $tipoSolicitante->delete();

        return redirect()->route('tipo_solicitante.index')->withStatus(__('Tipo Solicitante removido com sucesso'));
    }
}
