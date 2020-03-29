<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoLaboratorioRequest;
use App\TipoLaboratorio;

class TipoLaboratorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TipoLaboratorio $model)
    {
        return view('tipo_laboratorios.index', ['tipos' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipo_laboratorios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoLaboratorioRequest $request, TipoLaboratorio $model)
    {
        $model->create($request->all());

        return redirect()->route('tipo_laboratorio.index')->withStatus(__('Tipo Laboratório criado com sucesso.'));
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
    public function edit(TipoLaboratorio $tipoLaboratorio)
    {



        return view('tipo_laboratorios.edit', compact('tipoLaboratorio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipoLaboratorioRequest $request, TipoLaboratorio $tipoLaboratorio)
    {
        $tipoLaboratorio->update($request->all());

        return redirect()->route('tipo_laboratorio.index')->withStatus(__('Tipo Laboratório Editado com sucesso!!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoLaboratorio $tipoLaboratorio)
    {
        $tipoLaboratorio->delete();

        return redirect()->route('tipo_laboratorio.index')->withStatus(__('Tipo Laboratório Excluido com sucesso.'));
    }
}
