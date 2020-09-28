<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservaRequest;
use App\Laboratorio;
use Illuminate\Http\Request;
use App\Reserva;
use App\Solicitante;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(Reserva $reserva)
    {

        $reserva = new Reserva;

        $dataHoje = date('Y-m-d');



        return view('dashboard', [ 'reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->whereDate('data', $dataHoje)->orderBy('data', 'desc')->get()]);

    }
    public function buscaData(Request  $request)
    {


        $reserva = new Reserva;

        $dataHoje = $request->data;

        return view('dashboard', ['reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->whereDate('data', $dataHoje)->orderBy('data', 'desc')->get()]);
    }

    public function buscaSemana(Reserva $reserva)
    {


        $dataHoje =  date('y-m-d');

        $diaDaSemana = date('w', strtotime($dataHoje));



        if ($diaDaSemana == 0) {
            /**Domingo */
            $dataInicio = date('h-m-d');
            $dataFim = date('Y/m/d', strtotime('+6 days', strtotime($dataInicio)));

            return view('dashboard', ['reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->get()]);
        } elseif ($diaDaSemana == 1) {
            /**Segunda */
            $dataInicio = date('Y/m/d', strtotime('-1 days', strtotime($dataHoje)));
            $dataFim = date('Y/m/d', strtotime('+5 days', strtotime($dataHoje)));

            return view('dashboard', ['reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->get()]);
        } elseif ($diaDaSemana == 2) {

            $dataInicio = date('Y/m/d', strtotime('-2 days', strtotime($dataHoje)));
            $dataFim = date('Y/m/d', strtotime('+4 days', strtotime($dataHoje)));

            return view('dashboard', ['reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->get()]);
        } elseif ($diaDaSemana == 3) {
            /**Quarta */
            $dataInicio = date('Y/m/d', strtotime('-3 days', strtotime($dataHoje)));
            $dataFim = date('Y/m/d', strtotime('+3 days', strtotime($dataHoje)));

            return view('dashboard', ['reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->get()]);
        } elseif ($diaDaSemana == 4) {
            /**Quinta */

            $dataInicio = date('y-m-d', strtotime('-4 days', strtotime($dataHoje)));
            $dataFim = date('y-m-d', strtotime('+2 days', strtotime($dataHoje)));

            return view('dashboard', ['reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->get()]);
        } elseif ($diaDaSemana == 5) {
            /**Sexta */

            $dataInicio = date('Y/m/d', strtotime('-5 days', strtotime($dataHoje)));
            $dataFim = date('Y/m/d', strtotime('+1 days', strtotime($dataInicio)));

            return view('dashboard', ['reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->get()]);
        } elseif ($diaDaSemana == 6) {
            /**Sabado */

            $dataInicio = date('Y/m/d', strtotime('-6 days', strtotime($dataHoje)));
            $dataFim = date('Y/m/d', strtotime('+0 days', strtotime($dataInicio)));

            return view('dashboard', ['reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->get()]);
        }
    }
    public function buscaTodos()
    {

        $reserva = new Reserva;

        return view('dashboard', ['reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->orderBy('data', 'desc')->get()]);
    }

    public function buscaMes(){
        $mesAtual = date('m');

        $reserva = new Reserva;

        return view('dashboard', ['reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->whereMonth('data', $mesAtual)->orderBy('data', 'desc')->get()]);
    }
    public function create(){
        $solicitantes = Solicitante::all();
        $laboratorios = Laboratorio::all();

        return view('reserva.dashboard.create', ['solicitantes' => $solicitantes, 'laboratorios' => $laboratorios]);
    }

    public function store(Request $request, Reserva $reserva)
    {



        if ($request->opcaoReserva == 1) {
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
        } elseif ($request->opcaoReserva == 2) {
            $dataInicio = $request->data;
            $dataFim =  $request->dataFim;


            $diferencaData = (strtotime($dataFim) - strtotime($dataInicio)) / 86400;

            $diferencaData = $diferencaData + 1;
            $semanas = $diferencaData / 7;

            $reservasCadastradas = array();
            $dadosErro = array();
            for ($i = 0; $i < $semanas; $i++) {
                $horaInicio =  $request->hora_inicio;
                $hora_fim = $request->hora_fim;
                $dataReserva = date('Y-m-d', strtotime('+' . $i . 'weeks', strtotime($dataInicio)));
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

            return view('reserva.erro_cadastro', ['dadosErro' => $dadosErro, 'reservasCadastradas' => $reservasCadastradas, 'idLaboratorio' => $request->laboratorio_id]);
        } elseif ($request->opcaoReserva == 5) {
            //diariamente
            $dataInicio = $request->data;
            $dataFim =  $request->dataFim;

            $dataHoje = date('Y-m-d');



            $reservasCadastradas = array();
            $dadosErro = array();




            if ($request->segunda == 1) {

                $teste = $this->diasIntervaloData($dataInicio, $dataFim, 1);

                $dataInicioReserva = $teste[0];
                $dataFimReserva = $teste[1];

                $diferencaData = (strtotime($dataFimReserva) - strtotime($dataInicioReserva)) / 86400;

                $semanas = intdiv($diferencaData, 7) + 1;

                $diferencaData = $diferencaData + 1;


                $teste2 = $this->salvarReservaPersonalizada($request, $semanas, $dataInicioReserva);
                $dadosErro[] =  $teste2[1];
                $reservasCadastradas[] =  $teste2[0];
            }
            if ($request->terca == 1) {


                $teste = $this->diasIntervaloData($dataInicio, $dataFim, 2);


                $dataInicioReserva = $teste[0];
                $dataFimReserva = $teste[1];

                $diferencaData = (strtotime($dataFimReserva) - strtotime($dataInicioReserva)) / 86400;
                $semanas = intdiv($diferencaData, 7);


                $diferencaData = $diferencaData + 1;

                $teste2 = $this->salvarReservaPersonalizada($request, $semanas, $dataInicioReserva);
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
    public function salvarReservaPersonalizada($request, $semanas, $dataInicioReserva)
    {


        $reservasCadastradas = array();
        $dadosErro = array();



        for ($i = 0; $i < $semanas; $i++) {

            $horaInicio =  $request->hora_inicio;
            $hora_fim = $request->hora_fim;
            $dataReserva = date('Y-m-d', strtotime('+' . $i . 'weeks', strtotime($dataInicioReserva)));
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
                ->orderBy('hora_inicio', 'asc')
                ->get();




            if ($dadosReserva !== '[]') {

                $dadosErro[] = $dadosReserva;
            }
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
            }
        }
        $dadosCadastro = array();
        $dadosCadastro[] = $reservasCadastradas;
        $dadosCadastro[] = $dadosErro;

        return $dadosCadastro;
    }

    public function diasIntervaloData($dataInicio, $dataFim, $diaSemanaDataMarcada)
    {




        $dataFimReserva = $dataFim;


        $diaSemanaInicio = date('w', strtotime($dataInicio));


        $diaSemanaFim = date('w', strtotime($dataFim));

        $dataInicioFim = array();

        if ($diaSemanaDataMarcada < $diaSemanaInicio) {

            $diferenca = $dataInicio - $diaSemanaDataMarcada;

            if ($diferenca = 1) {
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
        if ($diaSemanaDataMarcada > $diaSemanaInicio) {


            $diferenca =   $diaSemanaDataMarcada - $diaSemanaInicio;


            $dataInicioFim[] = $diaInicioReserva = date('Y-m-d', strtotime($diferenca . ' days', strtotime($dataInicio)));
        }
        if ($diaSemanaDataMarcada < $dataFimReserva) {

            $daodssdasda = $diaSemanaDataMarcada - $diaSemanaFim;
            $dataInicioFim[] =  date('Y-m-d', strtotime($daodssdasda . ' days', strtotime($dataFimReserva)));
        }
        if ($diaSemanaDataMarcada == $dataFimReserva) {

            $dataInicioFim[] =  date('Y-m-d', strtotime($dataFimReserva));
        }
        if ($diaSemanaDataMarcada > $dataFimReserva) {
            $diferenca   = $diaSemanaDataMarcada - $dataFimReserva;

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
    /**
     * Display the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
}
