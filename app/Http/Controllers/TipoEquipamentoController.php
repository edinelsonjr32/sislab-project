<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoEquipamentoRequest;
use App\TipoEquipamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoEquipamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TipoEquipamento $tipo)
    {
        return view('tipo_equipamento.index', ['tipos'=>$tipo->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipo_equipamento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoEquipamentoRequest $request, TipoEquipamento $tipoEquipamento)
    {
        $tipoEquipamento->create($request->all());

        return redirect()->route('tipo_equipamento.index')->with('status', 'Dados Cadastrados com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoEquipamento  $tipoEquipamento
     * @return \Illuminate\Http\Response
     */
    public function show(TipoEquipamento $tipoEquipamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoEquipamento  $tipoEquipamento
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoEquipamento $tipoEquipamento)
    {
        return view('tipo_equipamento.edit', ['tipoEquipamento' => $tipoEquipamento]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoEquipamento  $tipoEquipamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoEquipamento $tipoEquipamento)
    {
        $tipoEquipamento->update($request->all());

        return redirect(route('tipo_equipamento.index'))->with('status', 'Dados Atualizados com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoEquipamento  $tipoEquipamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoEquipamento $tipoEquipamento)
    {
        $idTipoEquipamento = $tipoEquipamento->id;

        $equipamentos = DB::table('equipamento')->select('equipamento.*')->where('equipamento.tipo_equipamento_id', '=', $idTipoEquipamento)->get();

        if ($equipamentos == null) {
            //se solicitante or vazio ele exclui somente o tipo solicitante
            $tipoEquipamento->delete();
        } elseif ($equipamentos !== null) {

            //se solicitante for diferente devazio ele não exclui ainda, ele precisa saber se existe reserva e reserva equipamento


            $todasReservas = DB::table('reserva')->select('reserva_equipamento.*')->join('reserva_equipamento', 'reserva.id', 'reserva_equipamento.reserva_id')->join('equipamento', 'equipamento.id', 'reserva_equipamento.equipamento_id')->where('equipamento.tipo_equipamento_id', '=', $idTipoEquipamento)->get();

            if ($todasReservas == null) {
                //se existir não existir reserva, exclui  solicitantes e tipo solicitantes
                $equipamentos = DB::table('equipamento')->select('equipamento.*')->where('equipamento.tipo_equipamentos_id', '=', $idTipoEquipamento)->delete();
                $tipoEquipamento->delete();
            } elseif ($todasReservas !== null) {
                //se existir reserva, deverá analisar se existe reserva de equipamento

                $todasReservas = DB::table('reserva')->select('reserva_equipamento.*')->join('reserva_equipamento', 'reserva.id', 'reserva_equipamento.reserva_id')->join('equipamento', 'equipamento.id', 'reserva_equipamento.equipamento_id')->where('equipamento.tipo_equipamento_id', '=', $idTipoEquipamento)->delete();
                $equipamentos = DB::table('equipamento')->select('equipamento.*')->where('equipamento.tipo_equipamento_id', '=', $idTipoEquipamento)->delete();
                $tipoEquipamento->delete();
            }
        }

        return redirect(route('tipo_equipamento.index'))->with('status', 'Dados excluidos com sucesso');
    }
}
