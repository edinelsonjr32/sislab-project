<?php

namespace App\Http\Controllers;



use App\Equipamento;
use App\Laboratorio;
use App\Reserva;
use App\ReservaEquipamento;
use App\Solicitante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{

    public function index(Reserva $reserva)
    {

    }
    public function laboratorioIndex($idReserva){

        $reserva = new Reserva;

        $dataHoje = date('Y-m-d');




        return view('reserva.index', ['idReserva'=> $idReserva,'reservas'=> $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->where('reserva.laboratorio_id', '=', $idReserva)->whereDate('data', $dataHoje)->orderBy('data', 'desc')->orderBy('status', 'desc')->paginate(15)]);
    }

    public function buscaData(Request $request, $idReserva){


        $reserva = new Reserva;

        $dataHoje = $request->data;

        return view('reserva.index', ['idReserva'=> $idReserva,'reservas'=> $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->where('reserva.laboratorio_id', '=', $idReserva)->whereDate('data', $dataHoje)->orderBy('data', 'desc')->paginate(15)]);
    }

    public function buscaMes($idReserva){

        $mesAtual = date('m');
        /**/

        $reserva = new Reserva;

        return view('reserva.index', ['idReserva'=> $idReserva,'reservas'=> $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->where('reserva.laboratorio_id', '=', $idReserva)->whereMonth('data', $mesAtual)->orderBy('data', 'desc')->paginate(15)]);
    }

    public function buscaSemana(Reserva $reserva, $idReserva){

        $dataHoje =  date('Y-m-d');



        $diaDaSemana = date('w', strtotime($dataHoje));




        if($diaDaSemana == 0){
            /**Domingo */
            $dataInicio = date('Y-m-d');
            $dataFim = date('Y/m/d', strtotime('+6 days', strtotime($dataInicio)));

            return view('reserva.index', ['idReserva' => $idReserva, 'reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->where('reserva.laboratorio_id', '=', $idReserva)->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->paginate(15)]);

        } elseif ($diaDaSemana == 1) {
            /**Segunda */

            $dataInicio = date('Y/m/d', strtotime('-1 days', strtotime($dataHoje)));
            $dataFim = date('Y/m/d', strtotime('+5 days', strtotime($dataHoje)));



            $dado = DB::table('reserva')->select('reserva.*', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLabin')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->whereBetween('reserva.data', [$dataInicio, $dataFim])->get();

            return view('reserva.index', ['idReserva' => $idReserva, 'reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->where('reserva.laboratorio_id', '=', $idReserva)->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->paginate(15)]);
        } elseif ($diaDaSemana == 2) {
            /**Terça */
            $dataInicio = date('Y/m/d', strtotime('-2 days', strtotime($dataHoje)));
            $dataFim = date('Y/m/d', strtotime('+4 days', strtotime($dataHoje)));
            return view('reserva.index', ['idReserva' => $idReserva, 'reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->where('reserva.laboratorio_id', '=', $idReserva)->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->paginate(15)]);
        } elseif ($diaDaSemana == 3) {
            /**Quarta */
            $dataInicio = date('Y/m/d', strtotime('-3 days', strtotime($dataHoje)));
            $dataFim = date('Y/m/d', strtotime('+3 days', strtotime($dataHoje)));

            return view('reserva.index', ['idReserva' => $idReserva, 'reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->where('reserva.laboratorio_id', '=', $idReserva)->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->paginate(15)]);
        } elseif ($diaDaSemana == 4) {
            /**Quinta */

            $dataInicio = date('y-m-d', strtotime('-4 days', strtotime($dataHoje)));
            $dataFim = date('y-m-d', strtotime('+2 days', strtotime($dataHoje)));

            return view('reserva.index', ['idReserva' => $idReserva, 'reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->where('reserva.laboratorio_id', '=', $idReserva)->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->paginate(15)]);
        } elseif ($diaDaSemana == 5) {
            /**Sexta */
            $dataInicio = date('Y/m/d', strtotime('-5 days', strtotime($dataHoje)));
            $dataFim = date('Y/m/d', strtotime('+1 days', strtotime($dataInicio)));

            return view('reserva.index', ['idReserva' => $idReserva, 'reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->where('reserva.laboratorio_id', '=', $idReserva)->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->paginate(15)]);
        } elseif ($diaDaSemana == 6) {
            /**Sabado */
            $dataInicio = date('Y/m/d', strtotime('-6 days', strtotime($dataHoje)));
            $dataFim = date('Y/m/d', strtotime('+0 days', strtotime($dataInicio)));

            return view('reserva.index', ['idReserva' => $idReserva, 'reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->where('reserva.laboratorio_id', '=', $idReserva)->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->paginate(15)]);
        }
    }

    public function buscaTodos($idReserva){

        $reserva = new Reserva;

        return view('reserva.index', ['idReserva'=> $idReserva,'reservas'=> $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->where('reserva.laboratorio_id', '=', $idReserva)->orderBy('data', 'desc')->paginate(15)]);
    }

    public function create($idLaboratorio)
    {
        $solicitantes = Solicitante::all();
        $laboratorios = Laboratorio::all();

        return view('reserva.create', ['solicitantes'=> $solicitantes, 'laboratorios'=>$laboratorios, 'idLaboratorio' => $idLaboratorio]);
    }


    public function store(Request $request, Reserva $reserva)
    {
        if ($request->opcaoReserva == 1) {
            $horaInicio =  $request->hora_inicio;
         
            $hora_fim = $request->hora_fim;
            $dadosReserva3 = DB::table('reserva')->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')
            ->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')
            ->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')
            ->join('users', 'users.id', '=', 'reserva.usuario_id')
            ->where('reserva.hora_fim', '>', $request->hora_fim)
            ->where('reserva.hora_inicio', '<', $request->hora_inicio)
            ->where('data', '=', $request->data)
            ->where('reserva.laboratorio_id', '=', $request->laboratorio_id);

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
            ->union($dadosReserva3)
            ->orderBy('hora_inicio', 'asc')
            ->get();
            $idLaboratorio = $request->laboratorio_id;

            if ($dadosReserva == '[]') {
                $reserva = new Reserva();
                $reserva->laboratorio_id = $request->laboratorio_id;
                $reserva->usuario_id = $request->usuario_id;
                $reserva->data = $request->data;
                $reserva->hora_inicio = $request->hora_inicio;
                $reserva->hora_fim = $request->hora_fim;
                $reserva->solicitante_id = $request->solicitante_id;
                $reserva->observacao = $request->observacao;
                $reserva->save();

                $idReserva = $reserva->id;


                return redirect()->route('reserva.laboratorio.detalhe', $idReserva)->withStatus(__('Reserva criada com sucesso.'));
            } else {
                $solicitantes = Solicitante::all();
                $laboratorios = Laboratorio::all();

                return view('reserva.create2', ['solicitantes' => $solicitantes, 'laboratorios' => $laboratorios, 'idLaboratorio' => $idLaboratorio, 'dadosReserva' => $dadosReserva]);
            }
        }elseif($request->opcaoReserva == 2){
            $dataInicio = $request->data;
            $dataFim =  $request->dataFim;
            $diferencaData = (strtotime($dataFim) - strtotime($dataInicio)) / 86400;
            $diferencaData = $diferencaData + 1;
            $semanas = $diferencaData / 7;
            $reservasCadastradas = array();
            $dadosErro = array();
            $contador = 0;

            for ($i=0; $i < $semanas; $i++) {
                $horaInicio =  $request->hora_inicio;
                $hora_fim = $request->hora_fim;
                $dataReserva = date('Y-m-d', strtotime('+' . $i . 'weeks', strtotime($dataInicio)));
                $dadosReserva3 = DB::table('reserva')->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')
                    ->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')
                    ->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')
                    ->join('users', 'users.id', '=', 'reserva.usuario_id')
                    ->where('reserva.hora_fim', '>', $request->hora_fim)
                    ->where('reserva.hora_inicio', '<', $request->hora_inicio)
                    ->where('data', '=', $dataReserva)
                    ->where('reserva.laboratorio_id', '=', $request->laboratorio_id);
                $dadosReserva2 = DB::table('reserva')->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')
                ->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')
                ->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')
                ->join('users', 'users.id', '=', 'reserva.usuario_id')
                ->whereBetween('reserva.hora_fim',  [$request->hora_inicio, $request->hora_fim])
                ->where('data', '=', $dataReserva)
                ->where('reserva.laboratorio_id', '=', $request->laboratorio_id);
                $dadosReserva = DB::table('reserva')->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')
                ->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')
                ->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')
                ->join('users', 'users.id', '=', 'reserva.usuario_id')
                ->whereBetween('reserva.hora_inicio', [$request->hora_inicio, $request->hora_fim])
                ->where('data', '=', $dataReserva)
                ->where('reserva.laboratorio_id', '=', $request->laboratorio_id)
                ->union($dadosReserva2)
                ->union($dadosReserva3)
                ->orderBy('hora_inicio', 'asc')
                ->get();
                $idLaboratorio = $request->laboratorio_id;
                if ($dadosReserva == '[]') {
                    $reserva = new Reserva();
                    $reserva->laboratorio_id = $request->laboratorio_id;
                    $reserva->usuario_id = $request->usuario_id;
                    $reserva->data = $dataReserva;
                    $reserva->hora_inicio = $request->hora_inicio;
                    $reserva->hora_fim = $request->hora_fim;
                    $reserva->solicitante_id = $request->solicitante_id;
                    $reserva->observacao = $request->observacao;
                    $reserva->save();
                    $reservasCadastradas[] = $reserva;
                } else {
                    $dadosErro[] = $dadosReserva;
                }
                $contador = $contador + 1;
            }


            return view('reserva.confirmacao_reserva_semana', ['dadosErro' => $dadosErro, 'reservasCadastradas' => $reservasCadastradas, 'idLaboratorio' => $request->laboratorio_id]);
        } elseif ($request->opcaoReserva == 3) {
            //diariamente
            
            $dataInicio = $request->data;
            $dataFim =  $request->dataFim;


            $diferencaData = (strtotime($dataFim) - strtotime($dataInicio)) / 86400;
            
            $diferencaData = $diferencaData + 1;

            $reservasCadastradas = array();
            $dadosErro = array();
            for ($i = 0; $i < $diferencaData; $i++) {
                $dataReserva = date('Y-m-d', strtotime('+' . $i . 'days', strtotime($dataInicio)));
                $dadosReserva3 = DB::table('reserva')->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')
                    ->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')
                    ->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')
                    ->join('users', 'users.id', '=', 'reserva.usuario_id')
                    ->where('reserva.hora_fim', '>', $request->hora_fim)
                    ->where('reserva.hora_inicio', '<', $request->hora_inicio)
                    ->where('data', '=', $dataReserva)
                    ->where('reserva.laboratorio_id', '=', $request->laboratorio_id);
                $dadosReserva2 = DB::table('reserva')->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')
                    ->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')
                    ->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')
                    ->join('users', 'users.id', '=', 'reserva.usuario_id')
                    ->whereBetween('reserva.hora_fim',  [$request->hora_inicio, $request->hora_fim])
                    ->where('data', '=', $dataReserva)
                    ->where('reserva.laboratorio_id', '=', $request->laboratorio_id);
                $dadosReserva = DB::table('reserva')->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')
                    ->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')
                    ->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')
                    ->join('users', 'users.id', '=', 'reserva.usuario_id')
                    ->whereBetween('reserva.hora_inicio', [$request->hora_inicio, $request->hora_fim])
                    ->where('data', '=', $dataReserva)
                    ->where('reserva.laboratorio_id', '=', $request->laboratorio_id)
                    ->union($dadosReserva2)
                    ->union($dadosReserva3)
                    ->orderBy('hora_inicio', 'asc')
                    ->get();
                $idLaboratorio = $request->laboratorio_id;
                if ($dadosReserva == '[]') {
                    $reserva = new Reserva();
                    $reserva->laboratorio_id = $request->laboratorio_id;
                    $reserva->usuario_id = $request->usuario_id;
                    $reserva->data = $dataReserva;
                    $reserva->hora_inicio = $request->hora_inicio;
                    $reserva->hora_fim = $request->hora_fim;
                    $reserva->solicitante_id = $request->solicitante_id;
                    $reserva->observacao = $request->observacao;
                    $reserva->save();
                    $reservasCadastradas[] = $reserva;
                } else {
                    $dadosErro[] = $dadosReserva;
                }
            }

            return view('reserva.confirmacao_reserva_semana', ['dadosErro' => $dadosErro, 'reservasCadastradas' => $reservasCadastradas, 'idLaboratorio' => $request->laboratorio_id]);


        } elseif ($request->opcaoReserva == 5) {
            //personalizado
            $dataInicio = $request->data;
            $dataFim =  $request->dataFim;

            $dataHoje = date('Y-m-d');

            $reservasCadastradas = array();
            $dadosErro = array();




            if($request->segunda == 1){

                $teste = $this->diasIntervaloData($dataInicio, $dataFim, 1);

                $dataInicioReserva = $teste[0];
                $dataFimReserva = $teste[1];

                $diferencaData = (strtotime($dataFimReserva) - strtotime($dataInicioReserva)) / 86400;

                $semanas = intdiv($diferencaData, 7) + 1;

                $diferencaData = $diferencaData + 1;


                $teste2 = $this->salvarReservaPersonalizada($request, $semanas, $dataInicioReserva);
                $dadosErro[] =  $teste2[1];
                $reservasCadastradas[] =  $teste2[0];

            }if ($request->terca == 1) {


                $teste = $this->diasIntervaloData($dataInicio, $dataFim, 2);


                $dataInicioReserva = $teste[0];
                $dataFimReserva = $teste[1];

                $diferencaData = (strtotime($dataFimReserva) - strtotime($dataInicioReserva)) / 86400;
                $semanas = intdiv($diferencaData, 7);


                $diferencaData = $diferencaData + 1;

                $teste2 = $this->salvarReservaPersonalizada($request, $semanas , $dataInicioReserva);
                $dadosErro[] =  $teste2[1];
                $reservasCadastradas[] =  $teste2[0];

            }
            if ($request->quarta == 1) {


                $teste = $this->diasIntervaloData($dataInicio, $dataFim, 3);




                $dataInicioReserva = $teste[0];
                $dataFimReserva = $teste[1];

                $diferencaData = (strtotime($dataFimReserva) - strtotime($dataInicioReserva)) / 86400;
                $semanas = intdiv($diferencaData, 7) + 1;


                $diferencaData = $diferencaData + 1;

                $teste2 = $this->salvarReservaPersonalizada($request, $semanas, $dataInicioReserva);
                $dadosErro[] =  $teste2[1];
                $reservasCadastradas[] =  $teste2[0];

            }
            if ($request->quinta == 1) {


                $teste = $this->diasIntervaloData($dataInicio, $dataFim, 4);


                $dataInicioReserva = $teste[0];
                $dataFimReserva = $teste[1];

                $diferencaData = (strtotime($dataFimReserva) - strtotime($dataInicioReserva)) / 86400;
                $semanas = intdiv($diferencaData, 7) + 1;


                $diferencaData = $diferencaData + 1;

                $teste2 = $this->salvarReservaPersonalizada($request, $semanas, $dataInicioReserva);
                $dadosErro[] =  $teste2[1];
                $reservasCadastradas[] =  $teste2[0];

            }
            if ($request->sexta == 1) {


                $teste = $this->diasIntervaloData($dataInicio, $dataFim, 5);



                $dataInicioReserva = $teste[0];
                $dataFimReserva = $teste[1];

                $diferencaData = (strtotime($dataFimReserva) - strtotime($dataInicioReserva)) / 86400;
                $semanas = intdiv($diferencaData, 7) + 1;


                $diferencaData = $diferencaData + 1;

                $teste2 = $this->salvarReservaPersonalizada($request, $semanas, $dataInicioReserva);
                $dadosErro[] =  $teste2[1];
                $reservasCadastradas[] =  $teste2[0];

            }
            if ($request->sabado == 1) {


                $teste = $this->diasIntervaloData($dataInicio, $dataFim, 6);



                $dataInicioReserva = $teste[0];
                $dataFimReserva = $teste[1];

                $diferencaData = (strtotime($dataFimReserva) - strtotime($dataInicioReserva)) / 86400;
                $semanas = intdiv($diferencaData, 7) + 1;


                $diferencaData = $diferencaData + 1;

                $teste2 = $this->salvarReservaPersonalizada($request, $semanas, $dataInicioReserva);
                $dadosErro[] =  $teste2[1];
                $reservasCadastradas[] =  $teste2[0];
            }
            if ($request->domingo == 1) {

                $teste = $this->diasIntervaloData($dataInicio, $dataFim, 0);



                $dataInicioReserva = $teste[0];
                $dataFimReserva = $teste[1];

                $diferencaData = (strtotime($dataFimReserva) - strtotime($dataInicioReserva)) / 86400;
                $semanas = intdiv($diferencaData, 7) + 1;


                $diferencaData = $diferencaData + 1;

                $teste2 = $this->salvarReservaPersonalizada($request, $semanas, $dataInicioReserva);
                $dadosErro[] =  $teste2[1];
                $reservasCadastradas[] =  $teste2[0];
            }




            return view('reserva.erro_cadastro', ['dadosErro' => $dadosErro, 'reservasCadastradas' => $reservasCadastradas, 'idLaboratorio' => $request->laboratorio_id]);



        }



    }

    public function salvarReservaPersonalizada($request, $semanas, $dataInicioReserva){


        $reservasCadastradas = array();
        $dadosErro = array();



        for ($i = 0; $i < $semanas; $i++) {

            $horaInicio =  $request->hora_inicio;
            $hora_fim = $request->hora_fim;
            $dataReserva = date('Y-m-d', strtotime('+' . $i . 'weeks', strtotime($dataInicioReserva)));
            $dadosReserva3 = DB::table('reserva')->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')
                    ->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')
                    ->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')
                    ->join('users', 'users.id', '=', 'reserva.usuario_id')
                    ->where('reserva.hora_fim', '>', $request->hora_fim)
                    ->where('reserva.hora_inicio', '<', $request->hora_inicio)
                    ->where('data', '=', $dataReserva)
                    ->where('reserva.laboratorio_id', '=', $request->laboratorio_id);
            $dadosReserva2 = DB::table('reserva')->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')
            ->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')
            ->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')
            ->join('users', 'users.id', '=', 'reserva.usuario_id')
            ->whereBetween('reserva.hora_fim',  [$request->hora_inicio, $request->hora_fim])
                ->where('data', '=', $dataReserva)
                ->where('reserva.laboratorio_id', '=', $request->laboratorio_id);
            $dadosReserva = DB::table('reserva')->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')
            ->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')
            ->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')
            ->join('users', 'users.id', '=', 'reserva.usuario_id')
            ->whereBetween('reserva.hora_inicio', [$request->hora_inicio, $request->hora_fim])
                ->where('data', '=', $dataReserva)
                ->where('reserva.laboratorio_id', '=', $request->laboratorio_id)
                ->union($dadosReserva2)
                ->union($dadosReserva3)
                ->orderBy('hora_inicio', 'asc')
                ->get();




            if ($dadosReserva !== '[]') {

                $dadosErro[] = $dadosReserva;
            }
            if($dadosReserva == '[]') {

                $reserva = new Reserva();
                $reserva->laboratorio_id = $request->laboratorio_id;
                $reserva->usuario_id = $request->usuario_id;
                $reserva->data = $dataReserva;
                $reserva->hora_inicio = $request->hora_inicio;
                $reserva->hora_fim = $request->hora_fim;
                $reserva->solicitante_id = $request->solicitante_id;
                $reserva->observacao = $request->observacao;
                $reserva->save();

                $reservasCadastradas[] = $reserva;

            }
        }
        $dadosCadastro = array();
        $dadosCadastro[] = $reservasCadastradas;
        $dadosCadastro[] = $dadosErro;

        return $dadosCadastro;
    }

    public function diasIntervaloData($dataInicio, $dataFim, $diaSemanaDataMarcada){



        $dataFimReserva = $dataFim;


        $diaSemanaInicio = date('w', strtotime($dataInicio));


        $diaSemanaFim = date('w', strtotime($dataFim));


        $dataInicioFim = array();


        if ($diaSemanaDataMarcada < $diaSemanaInicio) {

            $diferenca = $diaSemanaInicio - $diaSemanaDataMarcada;

            if($diferenca = 1){
                $dataInicioFim[] = $diaInicioReserva = date('Y-m-d', strtotime('+ 6 days', strtotime($dataInicio)));
            } elseif ($diferenca = 2) {
                $dataInicioFim[] = $diaInicioReserva = date('Y-m-d', strtotime('+ 5 days', strtotime($dataInicio)));
            } elseif ($diferenca = 3) {
                $dataInicioFim[] = $diaInicioReserva = date('Y-m-d', strtotime('+ 4 days', strtotime($dataInicio)));

            } elseif ($diferenca = 4) {
                $dataInicioFim[] = $diaInicioReserva = date('Y-m-d', strtotime('+ 3 days', strtotime($dataInicio)));
            } elseif ($diferenca = 5) {
                $dataInicioFim[] = $diaInicioReserva = date('Y-m-d', strtotime('+ 2 days', strtotime($dataInicio)));
            } elseif ($diferenca = 6) {
                $dataInicioFim[] = $diaInicioReserva = date('Y-m-d', strtotime('+ 1 days', strtotime($dataInicio)));
            }
        }
        if ($diaSemanaDataMarcada == $diaSemanaInicio) {

            $dataInicioFim[] = $diaInicioReserva = date('Y-m-d', strtotime($dataInicio));
        }
        if($diaSemanaDataMarcada > $diaSemanaInicio){

            $diferenca =   $diaSemanaDataMarcada - $diaSemanaInicio;


            $dataInicioFim[] = $diaInicioReserva = date('Y-m-d', strtotime( $diferenca . ' days', strtotime($dataInicio)));


        }
        if ($diaSemanaDataMarcada < $dataFimReserva) {

            $daodssdasda = $diaSemanaDataMarcada - $diaSemanaFim;
            $dataInicioFim[] =  date('Y-m-d', strtotime($daodssdasda .' days', strtotime($dataFimReserva)));
        }
        if ($diaSemanaDataMarcada == $dataFimReserva) {

            $dataInicioFim[] =  date('Y-m-d', strtotime($dataFimReserva));
        }
        if ($diaSemanaDataMarcada > $dataFimReserva) {
            $diferenca   = $diaSemanaDataMarcada - $diaSemanaFim;

            if ($diferenca = 1) {
                $dataInicioFim[] = date('Y-m-d', strtotime('- 6 days', strtotime($dataFimReserva)));
            } elseif ($diferenca = 2) {
                $dataInicioFim[] = date('Y-m-d', strtotime('- 5 days', strtotime($dataFimReserva)));
            } elseif ($diferenca = 3) {
                $dataInicioFim[] = date('Y-m-d', strtotime('- 4 days', strtotime($dataFimReserva)));
            } elseif ($diferenca = 4) {
                $dataInicioFim[] = date('Y-m-d', strtotime('- 3 days', strtotime($dataFimReserva)));
            } elseif ($diferenca = 5) {
                $dataInicioFim[] = date('Y-m-d', strtotime('- 2 days', strtotime($dataFimReserva)));
            } elseif ($diferenca = 6) {
                $dataInicioFim[] = date('Y-m-d', strtotime('- 1 days', strtotime($dataFimReserva)));
            }
        }


        return $dataInicioFim;
    }

    public function show(Reserva $reserva, $idReserva)
    {


        $reservaEquipamento = new ReservaEquipamento();



        return view('reserva.detail' ,[
            'reserva'=> $reservaEquipamento->select('reserva_equipamento.id as idEquipamento', 'tipo_equipamento.nome as nomeTipoEquipamento', 'equipamento.*')
            ->join('equipamento', 'equipamento.id', '=', 'reserva_equipamento.equipamento_id')
            ->join('tipo_equipamento', 'tipo_equipamento.id', '=', 'equipamento.tipo_equipamento_id')
            ->where('reserva_equipamento.reserva_id', '=', $idReserva)->get(),
            'dadosReserva'=> $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')
            ->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')
            ->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')
            ->join('users', 'users.id', '=', 'reserva.usuario_id')
            ->where('reserva.id', '=', $idReserva)->get()]);
    }

    public function alterarStatus(Reserva $reserva, $idReserva){
        

        $reservas = DB::table('reserva')->select('reserva.*')->where('reserva.id', '=', $idReserva)->get();
        $laboratorio_id = DB::table('reserva')->select('reserva.laboratorio_id')->where('reserva.id', '=', $idReserva)->value('laboratorio_id');
        $status_reserva = DB::table('reserva')->select('reserva.status')->where('reserva.id', '=', $idReserva)->value('status');

        
        if ($reservas == null) {
            return redirect()->route('reserva.laboratorio.index', $laboratorio_id)->withStatus(__('Ocorreu um erro interno no sistema, tente mais tarde.'));

        } elseif ($reservas !== null) {
            if ($status_reserva == 1) {
                DB::table('reserva')
                    ->where('id', $idReserva)
                    ->update(['status' => 0]);
                    return redirect()->route('reserva.laboratorio.index', $laboratorio_id)->with('erro', 'Você finalizou a reserva.');
            } elseif ($status_reserva == 0) {
                
                DB::table('reserva')
                    ->where('id', $idReserva)
                    ->update(['status' => 1]);
                    return redirect()->route('reserva.laboratorio.index', $laboratorio_id)->with('status', 'Você alterou o status da reserva para "Em USO".');
 
            }
        }


       
    }

    public function edit(Reserva $reserva)
    {

            $solicitantes = Solicitante::all();
            $laboratorios = Laboratorio::all();


            return view('reserva.edit', ['solicitantes'=> $solicitantes, 'laboratorios'=>$laboratorios, 'idReserva' => $reserva->id, 'reserva'=> $reserva]);

    }

    public function relatorio(Request $request, Reserva $reserva){


        $laboratorios = DB::table('laboratorio')->select('laboratorio.id')->get();


        $equipamentos = DB::table('equipamento')->select('equipamento.id')->get();

        $dataInicio = $request->dataInicio;

        $dataFim = $request->dataFim;

        $reserva = new Reserva;



        $dadosReservaLabin = array();

        $dadosReservaEquipamento = array();

        foreach($laboratorios as $laboratorio){
            $dadosReservaLabin[] =
            $reserva->select('reserva.*', 'solicitantes.nome as nomeSolicitante', 'users.name as nomeUsuario', 'laboratorio.nome')
            ->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')
            ->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')
            ->join('users', 'users.id', '=', 'reserva.usuario_id')
            ->whereBetween('reserva.data', [$dataInicio, $dataFim])
            ->where('reserva.laboratorio_id', '=', $laboratorio->id)
            ->orderBy('reserva.data', 'ASC')
            ->get();
        }
        $reservaEquipamento = new ReservaEquipamento;
        foreach($equipamentos as $dado){
            $dadosReservaEquipamento[] =
            $reservaEquipamento
                ->select('reserva_equipamento.*', 'reserva.*', 'solicitantes.nome as nomeSolicitanteReserva', 'equipamento.tombo as tomboEquipamento', 'tipo_equipamento.nome as nomeTipo', 'laboratorio.nome as nomeLabin')
                ->join('reserva', 'reserva.id', '=',  'reserva_equipamento.reserva_id')
                ->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')
                ->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')
                ->join('equipamento', 'equipamento.id', '=', 'reserva_equipamento.equipamento_id')
                ->join('tipo_equipamento', 'tipo_equipamento.id', '=', 'equipamento.tipo_equipamento_id')
                ->whereBetween('reserva.data', [$dataInicio, $dataFim])
                ->where('reserva_equipamento.equipamento_id', '=', $dado->id)
                ->orderBy('reserva.hora_inicio', 'asc')
                ->get();
        }









        return view('relatorio', ['testando'=> $dadosReservaLabin, 'dataInicio'=>$dataInicio, 'dataFim'=>$dataFim, 'reservasEquipamentos'=> $dadosReservaEquipamento]);



    }
    public function adicionarEquipamento($idReserva){

            $equipamentos = new Equipamento();

            return view('reserva.adicionar_equipamento', ['equipamentos'=> $equipamentos->select('equipamento.id as id', 'equipamento.tombo as tombo', 'tipo_equipamento.nome as nome')->join('tipo_equipamento', 'tipo_equipamento.id', '=', 'equipamento.tipo_equipamento_id')->get(), 'idReserva'=> $idReserva]);
    }

    public function salvarEquipamentoReserva(Request $request, ReservaEquipamento $reserva){
        $dataReserva = new Reserva();

        $data = $dataReserva->select('reserva.data')->where('reserva.id', '=', $request->reserva_id)->value('data');

        $horaIninio = $dataReserva->select('reserva.hora_inicio')->where('reserva.id', '=', $request->reserva_id)->value('hora_inicio');

        $horaFim = $dataReserva->select('reserva.hora_fim')->where('reserva.id', '=', $request->reserva_id)->value('hora_fim');


        $dadosReserva = new ReservaEquipamento();

        $reservasEquipamentos = $dadosReserva->select('reserva_equipamento.*')
        ->join('reserva', 'reserva.id', '=', 'reserva_equipamento.reserva_id')
        ->where('reserva.data', '=', $data)
        ->where('reserva_equipamento.equipamento_id', '=', $request->equipamento_id)
        ->whereBetween('reserva.hora_fim',  [$horaIninio, $horaFim]);

        $reservasEquipamentos2 = $dadosReserva->select('reserva_equipamento.*')
            ->join('reserva', 'reserva.id', '=', 'reserva_equipamento.reserva_id')
            ->where('reserva.data', '=', $data)
            ->where('reserva_equipamento.equipamento_id', '=', $request->equipamento_id)
            ->whereBetween('reserva.hora_fim',  [$horaIninio, $horaFim])
            ->union($reservasEquipamentos)
            ->get();

        if($reservasEquipamentos2 == '[]'){
            $reserva->create($request->all());
            return redirect()->route('reserva.laboratorio.detalhe', $request->reserva_id)->with('status', 'Equipamento cadastrado com sucesso');
        }else{
            return redirect()->route('reserva.laboratorio.detalhe', $request->reserva_id)->with('erro', 'Erro Este equipamento já está reservado em outra reserva, neste horário');
        }
    }

    public function update(Request $request, Reserva $reserva)
    {






        $horaInicio =  $request->hora_inicio;
        $hora_fim = $request->hora_fim;



        $dadosReserva3 = DB::table('reserva')->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')
                    ->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')
                    ->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')
                    ->join('users', 'users.id', '=', 'reserva.usuario_id')
                    ->where('reserva.hora_fim', '>', $request->hora_fim)
                    ->where('reserva.hora_inicio', '<', $request->hora_inicio)
                    ->where('data', '=', $request->data)
                    ->where('reserva.laboratorio_id', '=', $request->laboratorio_id);
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
            ->union($dadosReserva3)
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

    public function destroy(Reserva $reserva)
    {



        $idReserva = $reserva->id;


        $reservas = DB::table('reserva')->select('reserva.*')->where('reserva.id', '=', $idReserva)->get();

        $todasReservasEquipamento = DB::table('reserva_equipamento')->select('reserva.*', 'reserva_equipamento.*')->join('reserva', 'reserva.id', 'reserva_equipamento.reserva_id')->where('reserva.id', '=', $idReserva)->get();
        if ($reservas == null) {
            return redirect()->route('reserva.laboratorio.index', $reserva->laboratorio_id)->withStatus(__('Erro na Remoção de Equipamento, registro não existe.'));

        } elseif ($reservas !== null) {
            if ($todasReservasEquipamento == null) {
                $reserva->delete();
            } elseif ($todasReservasEquipamento !== null) {
                $todasReservasEquiopamento = DB::table('reserva_equipamento')->join('reserva', 'reserva.id', 'reserva_equipamento.reserva_id')->where('reserva.id', '=', $idReserva)->delete();
                $reserva->delete();
            }
        }


        return redirect()->route('reserva.laboratorio.index', $reserva->laboratorio_id)->withStatus(__('Reserva removida com sucesso.'));
    }

    public function destroyReservaEquipamento(Request $request,  $reserva){



        $reservaEquipamento = ReservaEquipamento::find($reserva);

        $idReserva = $reservaEquipamento->reserva_id;


        if ($reservaEquipamento == '[]') {
            return 'vazio';
        }else{
            if(ReservaEquipamento::destroy($reserva)){
                return redirect()->route('reserva.laboratorio.detalhe', $idReserva)->with('status', 'Remoção de equipamento realizado com sucesso');
            }else{
                return redirect()->route('reserva.laboratorio.detalhe', $idReserva)->with('erro', 'Erro  ao remover equipamento');
            }
        }
    }
}
