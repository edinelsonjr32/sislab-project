<?php

namespace App\Http\Controllers;

use App\Http\Requests\LaboratorioRequest;
use App\Laboratorio;
use App\TipoLaboratorio;
use Illuminate\Http\Request;

class LaboratorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Laboratorio $model)
    {
        return view('laboratorio.index', ['laboratorios' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoLab = TipoLaboratorio::all();
        return view('laboratorio.create', compact('tipoLab'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LaboratorioRequest $request, Laboratorio $model)
    {
        $model->create($request->all());

        return redirect()->route('laboratorio.index')->withStatus(__('Laboratório criado com sucesso.'));
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
    public function edit(Laboratorio $laboratorio)
    {
        $tipoLab = TipoLaboratorio::all();
        return view('laboratorio.edit', compact('laboratorio', 'tipoLab'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LaboratorioRequest $request, Laboratorio $laboratorio)
    {
        $laboratorio->update($request->all());

        return redirect()->route('laboratorio.index')->withStatus(__('Laboratório Editado com sucesso!!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laboratorio $laboratorio)
    {
        $laboratorio->delete();

        return redirect()->route('laboratorio.index')->withStatus(__('Laboratório Excluido com sucesso.'));
    }
}
