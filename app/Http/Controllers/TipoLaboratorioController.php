<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoLaboratorioRequest;
use App\TipoLaboratorio;
use Illuminate\Support\Facades\DB;

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

        $idTipoLaboratorio = $tipoLaboratorio->id;

        $laboratorios = DB::table('laboratorio')->select('laboratorio.*')->where('laboratorio.tipo_laboratorio_id', '=', $idTipoLaboratorio)->get();

        if ($laboratorios == null) {
            //se solicitante or vazio ele exclui somente o tipo solicitante
            $laboratorios->delete();
        } elseif ($laboratorios !== null) {

            //se solicitante for diferente devazio ele não exclui ainda, ele precisa saber se existe reserva e reserva equipamento


            $todasReservas = DB::table('reserva')->select('reserva.*')->join('solicitantes', 'solicitantes.id', 'reserva.solicitante_id')->join('laboratorio', 'laboratorio.id', 'reserva.laboratorio_id')->join('tipo_laboratorio', 'tipo_laboratorio.id', 'laboratorio.tipo_laboratorio_id')->where('tipo_laboratorio.id', '=', $idTipoLaboratorio)->get();

            if ($todasReservas == null) {
                //se existir não existir reserva, exclui  solicitantes e tipo solicitantes
                $laboratorios = DB::table('laboratorio')->where('laboratorio.tipo_laboratorio_id', '=', $idTipoLaboratorio)->delete();
                $tipoLaboratorio->delete();
            } elseif ($todasReservas !== null) {
                //se existir reserva, deverá analisar se existe reserva de equipamento
                $reservasEquipamentos = DB::table('reserva')->select('reserva_equipamento.*')->join('reserva_equipamento', 'reserva.id', 'reserva_equipamento.reserva_id')->join('laboratorio', 'laboratorio.id', 'reserva.laboratorio_id')->join('tipo_laboratorio', 'tipo_laboratorio.id', 'laboratorio.tipo_laboratorio_id')->where('tipo_laboratorio.id', '=', $idTipoLaboratorio)->get();

                if ($reservasEquipamentos == null) {
                    //se não existir reserva de equipamento, so será excluido , reserva, solicitante e tipo reserva
                    $todasReservas = DB::table('reserva')->select('reserva.*')->join('solicitantes', 'solicitantes.id', 'reserva.solicitante_id')->join('laboratorio', 'laboratorio.id', 'reserva.laboratorio_id')->join('tipo_laboratorio', 'tipo_laboratorio.id', 'laboratorio.tipo_laboratorio_id')->where('tipo_laboratorio.id', '=', $idTipoLaboratorio)->delete();
                    $laboratorios = DB::table('laboratorio')->where('laboratorio.tipo_laboratorio_id', '=', $idTipoLaboratorio)->delete();
                    $tipoLaboratorio->delete();
                } elseif ($reservasEquipamentos !== null) {
                    //senão, será excluido todos, as reservas de equipamento, reservas, solicitantes e tipos solicitantes.
                    $todasReservasEquiopamento = DB::table('reserva')->select('reserva_equipamento.*')->join('reserva_equipamento', 'reserva.id', 'reserva_equipamento.reserva_id')->join('laboratorio', 'laboratorio.id', 'reserva.laboratorio_id')->join('tipo_laboratorio', 'tipo_laboratorio.id', 'laboratorio.tipo_laboratorio_id')->where('tipo_laboratorio.id', '=', $idTipoLaboratorio)->delete();
                    $todasReservas = DB::table('reserva')->select('reserva.*')->join('solicitantes', 'solicitantes.id', 'reserva.solicitante_id')->join('laboratorio', 'laboratorio.id', 'reserva.laboratorio_id')->join('tipo_laboratorio', 'tipo_laboratorio.id', 'laboratorio.tipo_laboratorio_id')->where('tipo_laboratorio.id', '=', $idTipoLaboratorio)->delete();
                    $solicitantes = DB::table('laboratorio')->where('laboratorio.tipo_laboratorio_id', '=', $idTipoLaboratorio)->delete();
                    $tipoLaboratorio->delete();
                }
            }
        }
        $tipoLaboratorio->delete();

        return redirect()->route('tipo_laboratorio.index')->withStatus(__('Tipo Laboratório Excluido com sucesso.'));
    }
}
