<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoSolicitanteRequest;
use App\TipoSolicitante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $idTipoSolicitante = $tipoSolicitante->id;

        $solicitantes = DB::table('solicitantes')->select('solicitantes.*')->where('solicitantes.tipo_solicitante_id', '=', $idTipoSolicitante)->get();

        if ($solicitantes == null) {
            //se solicitante or vazio ele exclui somente o tipo solicitante
            $tipoSolicitante->delete();
        } elseif ($solicitantes !== null) {

            //se solicitante for diferente devazio ele não exclui ainda, ele precisa saber se existe reserva e reserva equipamento

            $reservasEquipamentos = DB::table('reserva')->select('reserva_equipamento.*')->join('reserva_equipamento', 'reserva.id', 'reserva_equipamento.reserva_id')->join('solicitantes', 'solicitantes.id', 'reserva.solicitante_id')->join('tipo_solicitante', 'tipo_solicitante.id', 'solicitantes.tipo_solicitante_id')->where('tipo_solicitante.id', '=', $idTipoSolicitante)->get();
            $todasReservas = DB::table('reserva')->select('reserva.*')->join('solicitantes', 'solicitantes.id', 'reserva.solicitante_id')->join('tipo_solicitante', 'tipo_solicitante.id', 'solicitantes.tipo_solicitante_id')->where('tipo_solicitante.id', '=', $idTipoSolicitante)->get();

            if ($todasReservas == null) {
                //se existir não existir reserva, exclui  solicitantes e tipo solicitantes
                $solicitantes = DB::table('solicitantes')->where('solicitantes.tipo_solicitante_id', '=', $idTipoSolicitante)->delete();
                $tipoSolicitante->delete();

            } elseif ($todasReservas !== null) {
                //se existir reserva, deverá analisar se existe reserva de equipamento
                $todasReservasEquiopamento = DB::table('reserva_equipamento')->join('reserva', 'reserva.id', 'reserva_equipamento.reserva_id')->join('solicitantes', 'reserva.solicitante_id', 'solicitantes.id')->join('tipo_solicitante', 'tipo_solicitante.id', 'solicitantes.tipo_solicitante_id')->where('tipo_solicitante.id', '=', $idTipoSolicitante)->get();

                if($todasReservasEquiopamento == null){
                    //se não existir reserva de equipamento, so será excluido , reserva, solicitante e tipo reserva
                    $todasReservas = DB::table('reserva')->join('solicitantes', 'solicitantes.id', 'reserva.solicitante_id')->join('tipo_solicitante', 'tipo_solicitante.id', 'solicitantes.tipo_solicitante_id')->where('tipo_solicitante.id', '=', $idTipoSolicitante)->delete();
                    $solicitantes = DB::table('solicitantes')->where('solicitantes.tipo_solicitante_id', '=', $idTipoSolicitante)->delete();
                    $tipoSolicitante->delete();
                }elseif($todasReservasEquiopamento !== null){
                    //senão, será excluido todos, as reservas de equipamento, reservas, solicitantes e tipos solicitantes.
                    $todasReservasEquiopamento = DB::table('reserva_equipamento')->join('reserva', 'reserva.id', 'reserva_equipamento.reserva_id')->join('solicitantes', 'reserva.solicitante_id', 'solicitantes.id')->join('tipo_solicitante', 'tipo_solicitante.id', 'solicitantes.tipo_solicitante_id')->where('tipo_solicitante.id', '=', $idTipoSolicitante)->delete();
                    $todasReservas = DB::table('reserva')->join('solicitantes', 'solicitantes.id', 'reserva.solicitante_id')->join('tipo_solicitante', 'tipo_solicitante.id', 'solicitantes.tipo_solicitante_id')->where('tipo_solicitante.id', '=', $idTipoSolicitante)->delete();
                    $solicitantes = DB::table('solicitantes')->where('solicitantes.tipo_solicitante_id', '=', $idTipoSolicitante)->delete();
                    $tipoSolicitante->delete();
                }
            }
        }



        return redirect()->route('tipo_solicitante.index')->withStatus(__('Tipo Solicitante removido com sucesso'));
    }
}
