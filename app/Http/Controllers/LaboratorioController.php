<?php

namespace App\Http\Controllers;

use App\Http\Requests\LaboratorioRequest;
use App\Laboratorio;
use App\TipoLaboratorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaboratorioController extends Controller
{
    
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
        $idLaboratorio = $laboratorio->id;


        $reservas = DB::table('reserva')->select('reserva.*')->where('reserva.laboratorio_id', '=', $idLaboratorio)->get();


        $todasReservasEquipamento = DB::table('reserva_equipamento')->select('reserva.*', 'reserva_equipamento.*')->join('reserva', 'reserva.id', 'reserva_equipamento.reserva_id')->where('reserva.laboratorio_id', '=', $idLaboratorio)->get();
        if ($reservas == null) {
            $$laboratorio->delete();
        } elseif ($reservas !== null) {
            if ($todasReservasEquipamento == null) {
                $reservasSolicitante = DB::table('reserva')->where('reserva.laboratorio_id', '=', $idLaboratorio)->delete();
                $laboratorio->delete();
            } elseif ($todasReservasEquipamento !== null) {
                $todasReservasEquiopamento = DB::table('reserva_equipamento')->join('reserva', 'reserva.id', 'reserva_equipamento.reserva_id')->where('reserva.laboratorio_id', '=', $idLaboratorio)->delete();
                $reservasSolicitante = DB::table('reserva')->where('reserva.laboratorio_id', '=', $idLaboratorio)->delete();
                $laboratorio->delete();
            }
        }

        return redirect()->route('laboratorio.index')->withStatus(__('Laboratório Excluido com sucesso.'));
    }
}
