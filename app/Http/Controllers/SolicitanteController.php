<?php

namespace App\Http\Controllers;

use App\Http\Requests\SolicitanteRequest;
use App\Solicitante;
use App\TipoSolicitante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SolicitanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Solicitante $model)
    {
        $solicitantes = $model->select('solicitantes.*', 'tipo_solicitante.nome as nomeTipo')->join('tipo_solicitante', 'solicitantes.tipo_solicitante_id', '=', 'tipo_solicitante.id')->paginate(15);




        return view('solicitante.index', ['solicitantes'=> $solicitantes]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoSolicitante = TipoSolicitante::all();

        return view('solicitante.create', ['tipoSolicitante'=> $tipoSolicitante]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SolicitanteRequest $request ,Solicitante $model )
    {
        $model->create($request->all());

        return redirect(route('solicitante.index'))->withStatus(__('Solicitante criado com sucesso.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Solicitante  $solicitante
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitante $solicitante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Solicitante  $solicitante
     * @return \Illuminate\Http\Response
     */
    public function edit(Solicitante $solicitante)
    {
        $tipos = TipoSolicitante::all();

        return view ('solicitante.edit', ['solicitante'=>$solicitante, 'tipos'=> $tipos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Solicitante  $solicitante
     * @return \Illuminate\Http\Response
     */
    public function update(SolicitanteRequest $request, Solicitante $solicitante)
    {
        $solicitante->update($request->all());

        return redirect(route('solicitante.index'))->withStatus(__('Dados de Solicitante Alterado com sucesso!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Solicitante  $solicitante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solicitante $solicitante)
    {

        $idSolicitante = $solicitante->id;

        $reservas = DB::table('reserva')->select('reserva.*')->where('reserva.solicitante_id', '=', $idSolicitante)->get();

        $todasReservasEquipamento = DB::table('reserva_equipamento')->select('reserva.*', 'reserva_equipamento.*')->join('reserva', 'reserva.id', 'reserva_equipamento.reserva_id')->where('reserva.solicitante_id', '=', $idSolicitante)->get();
        if($reservas == null){
            $solicitante->delete();
        }elseif($reservas !== null){
            if($todasReservasEquipamento == null){
                $reservasSolicitante = DB::table('reserva')->where('reserva.solicitante_id', '=', $idSolicitante)->delete();
                $solicitante->delete();
            }elseif($todasReservasEquipamento !== null){
                $todasReservasEquiopamento = DB::table('reserva_equipamento')->join('reserva', 'reserva.id', 'reserva_equipamento.reserva_id')->where('reserva.solicitante_id', '=', $idSolicitante)->delete();
                $reservasSolicitante = DB::table('reserva')->where('reserva.solicitante_id', '=', $idSolicitante)->delete();
                $solicitante->delete();
            }

        }


        return redirect(route('solicitante.index'))->withStatus(__('Solicitante excluido com sucesso!'));
    }
}
