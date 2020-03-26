<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservaRequest;
use App\Laboratorio;
use App\Reserva;
use App\Solicitante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Reserva $reserva)
    {


        /**/

    }
    public function laboratorioIndex($idReserva){

        $reserva = new Reserva;

        $dataHoje = date('Y-m-d');




        return view('reserva.index', ['idReserva'=> $idReserva,'reservas'=> $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->where('reserva.laboratorio_id', '=', $idReserva)->whereDate('data', $dataHoje)->orderBy('data', 'desc')->paginate(15)]);
    }





    public function buscaData(Request $request, $idReserva){


        $reserva = new Reserva;

        $dataHoje = $request->data;

        return view('reserva.index', ['idReserva'=> $idReserva,'reservas'=> $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->where('reserva.laboratorio_id', '=', $idReserva)->whereDate('data', $dataHoje)->orderBy('data', 'desc')->paginate(15)]);
    }

    public function buscaMes($idReserva){

        $mesAtual = date('m');

        $reserva = new Reserva;

        return view('reserva.index', ['idReserva'=> $idReserva,'reservas'=> $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->where('reserva.laboratorio_id', '=', $idReserva)->whereMonth('data', $mesAtual)->orderBy('data', 'desc')->paginate(15)]);
    }

    public function buscaSemana(Reserva $reserva, $idReserva){

        $dataHoje =  date('y-m-d');

        $diaDaSemana = date('w', strtotime($dataHoje));



        if($diaDaSemana == 0){
            /**Domingo */
            $dataInicio = date('h-m-d');
            $dataFim = date('d/m/Y', strtotime('+6 days', strtotime($dataInicio)));

            return 'domingo';
            return view('reserva.index', ['idReserva' => $idReserva, 'reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->where('reserva.laboratorio_id', '=', $idReserva)->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->paginate(15)]);

        } elseif ($diaDaSemana == 1) {
            /**Segunda */
            $dataInicio = date('d/m/Y', strtotime('-1 days', strtotime($dataHoje)));
            $dataFim = date('d/m/Y', strtotime('+5 days', strtotime($dataHoje)));

            return 'segunda';
            return view('reserva.index', ['idReserva' => $idReserva, 'reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->where('reserva.laboratorio_id', '=', $idReserva)->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->paginate(15)]);
        } elseif ($diaDaSemana == 2) {
            /**Terça */
            return 'terça';
            $dataInicio = date('d/m/Y', strtotime('-2 days', strtotime($dataHoje)));
            $dataFim = date('d/m/Y', strtotime('+4 days', strtotime($dataHoje)));

            return view('reserva.index', ['idReserva' => $idReserva, 'reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->where('reserva.laboratorio_id', '=', $idReserva)->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->paginate(15)]);
        } elseif ($diaDaSemana == 3) {
            /**Quarta */
            return 'quarta';
            $dataInicio = date('d/m/Y', strtotime('-3 days', strtotime($dataHoje)));
            $dataFim = date('d/m/Y', strtotime('+3 days', strtotime($dataHoje)));

            return view('reserva.index', ['idReserva' => $idReserva, 'reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->where('reserva.laboratorio_id', '=', $idReserva)->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->paginate(15)]);
        } elseif ($diaDaSemana == 4) {
            /**Quinta */

            $dataInicio = date('y-m-d', strtotime('-4 days', strtotime($dataHoje)));
            $dataFim = date('y-m-d', strtotime('+2 days', strtotime($dataHoje)));

            return view('reserva.index', ['idReserva' => $idReserva, 'reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->where('reserva.laboratorio_id', '=', $idReserva)->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->paginate(15)]);
        } elseif ($diaDaSemana == 5) {
            /**Sexta */
            return 'sexta';
            $dataInicio = date('d/m/Y', strtotime('-5 days', strtotime($dataHoje)));
            $dataFim = date('d/m/Y', strtotime('+1 days', strtotime($dataInicio)));

            return view('reserva.index', ['idReserva' => $idReserva, 'reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->where('reserva.laboratorio_id', '=', $idReserva)->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->paginate(15)]);
        } elseif ($diaDaSemana == 6) {
            /**Sabado */
            return 'sabado';
            $dataInicio = date('d/m/Y', strtotime('-6 days', strtotime($dataHoje)));
            $dataFim = date('d/m/Y', strtotime('+0 days', strtotime($dataInicio)));

            return view('reserva.index', ['idReserva' => $idReserva, 'reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->where('reserva.laboratorio_id', '=', $idReserva)->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->paginate(15)]);
        }
    }

    public function buscaTodos($idReserva){

        $reserva = new Reserva;

        return view('reserva.index', ['idReserva'=> $idReserva,'reservas'=> $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->where('reserva.laboratorio_id', '=', $idReserva)->orderBy('data', 'desc')->paginate(15)]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idLaboratorio)
    {
        $solicitantes = Solicitante::all();
        $laboratorios = Laboratorio::all();

        return view('reserva.create', ['solicitantes'=> $solicitantes, 'laboratorios'=>$laboratorios, 'idLaboratorio' => $idLaboratorio]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Reserva $reserva)
    {

        $horaInicio =  $request->hora_inicio;
        $hora_fim = $request->hora_fim;
        $dadosReserva2 = DB::table('reserva')->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')
            ->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')
            ->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')
            ->join('users', 'users.id', '=', 'reserva.usuario_id')
            ->whereBetween('reserva.hora_fim',  [$request->hora_inicio, $request->hora_fim])
            ->where('data', '=', $request->data)
            ->where('reserva.laboratorio_id', '=', $request->laboratorio_id);


        $dadosReserva = DB::table('reserva')->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')
            ->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')
            ->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')
            ->join('users', 'users.id', '=', 'reserva.usuario_id')
            ->whereBetween('reserva.hora_inicio', [$request->hora_inicio, $request->hora_fim])
            ->where('data', '=', $request->data)
            ->where('reserva.laboratorio_id', '=', $request->laboratorio_id)
            ->union($dadosReserva2)
            ->orderBy('hora_inicio', 'asc')
            ->get();


        $idLaboratorio = $request->laboratorio_id;
        if($dadosReserva == '[]'){



            $reserva->create($request->all());

            return redirect()->route('reserva.laboratorio.index', $request->laboratorio_id)->withStatus(__('Reserva criada com sucesso.'));
        }else{

            $solicitantes = Solicitante::all();
            $laboratorios = Laboratorio::all();

        return view('reserva.create2', ['solicitantes'=> $solicitantes, 'laboratorios'=>$laboratorios, 'idLaboratorio' => $idLaboratorio, 'dadosReserva'=> $dadosReserva]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserva $reserva)
    {

            $solicitantes = Solicitante::all();
            $laboratorios = Laboratorio::all();

            return view('reserva.edit', ['solicitantes'=> $solicitantes, 'laboratorios'=>$laboratorios, 'idReserva' => $reserva->id, 'reserva'=> $reserva]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserva $reserva)
    {




        $horaInicio =  $request->hora_inicio;
        $hora_fim = $request->hora_fim;




        $dadosReserva = DB::table('reserva')->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')
            ->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')
            ->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')
            ->join('users', 'users.id', '=', 'reserva.usuario_id')
            ->whereBetween('reserva.hora_fim',  [$request->hora_inicio, $request->hora_fim])
            ->where('data', '=', $request->data)
            ->where('reserva.laboratorio_id', '=', $request->laboratorio_id)
            ->whereNotIn('reserva.id', [$request->reserva_id]);


        $dadosReserva = DB::table('reserva')->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')
            ->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')
            ->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')
            ->join('users', 'users.id', '=', 'reserva.usuario_id')
            ->whereBetween('reserva.hora_inicio', [$request->hora_inicio, $request->hora_fim])
            ->where('data', '=', $request->data)
            ->where('reserva.laboratorio_id', '=', $request->laboratorio_id)
            ->whereNotIn('reserva.id', [$request->reserva_id])
            ->union($dadosReserva)
            ->orderBy('hora_inicio', 'asc')
            ->get();




        $idReserva = $request->reserva_id;

        if($dadosReserva == '[]'){


            $reserva->update($request->all());


            return redirect()->route('reserva.laboratorio.index', $request->laboratorio_id)->withStatus(__('Reserva Atualizada com sucesso.'));
        }else{

            $solicitantes = Solicitante::all();
            $laboratorios = Laboratorio::all();

        return view('reserva.edit2', ['solicitantes'=> $solicitantes, 'laboratorios'=>$laboratorios, 'idReserva' => $idReserva, 'dadosReserva'=> $dadosReserva, 'reserva'=>$reserva]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserva $reserva)
    {
        $reserva->delete();

        return redirect()->route('reserva.laboratorio.index', $reserva->laboratorio_id)->withStatus(__('Reserva removida com sucesso.'));
    }
}
