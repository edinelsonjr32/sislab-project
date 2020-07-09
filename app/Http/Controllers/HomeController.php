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

        

        return view('dashboard', [ 'reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->whereDate('data', $dataHoje)->orderBy('data', 'desc')->paginate(15)]);

    }
    public function buscaData(Request  $request)
    {


        $reserva = new Reserva;

        $dataHoje = $request->data;

        return view('dashboard', ['reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->whereDate('data', $dataHoje)->orderBy('data', 'desc')->paginate(15)]);
    }

    public function buscaSemana(Reserva $reserva)
    {


        $dataHoje =  date('y-m-d');

        $diaDaSemana = date('w', strtotime($dataHoje));



        if ($diaDaSemana == 0) {
            /**Domingo */
            $dataInicio = date('h-m-d');
            $dataFim = date('Y/m/d', strtotime('+6 days', strtotime($dataInicio)));

            return view('dashboard', ['reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->paginate(15)]);
        } elseif ($diaDaSemana == 1) {
            /**Segunda */
            $dataInicio = date('Y/m/d', strtotime('-1 days', strtotime($dataHoje)));
            $dataFim = date('Y/m/d', strtotime('+5 days', strtotime($dataHoje)));

            return view('dashboard', ['reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->paginate(15)]);
        } elseif ($diaDaSemana == 2) {

            $dataInicio = date('Y/m/d', strtotime('-2 days', strtotime($dataHoje)));
            $dataFim = date('Y/m/d', strtotime('+4 days', strtotime($dataHoje)));

            return view('dashboard', ['reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->paginate(15)]);
        } elseif ($diaDaSemana == 3) {
            /**Quarta */
            $dataInicio = date('Y/m/d', strtotime('-3 days', strtotime($dataHoje)));
            $dataFim = date('Y/m/d', strtotime('+3 days', strtotime($dataHoje)));

            return view('dashboard', ['reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->paginate(15)]);
        } elseif ($diaDaSemana == 4) {
            /**Quinta */

            $dataInicio = date('y-m-d', strtotime('-4 days', strtotime($dataHoje)));
            $dataFim = date('y-m-d', strtotime('+2 days', strtotime($dataHoje)));

            return view('dashboard', ['reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->paginate(15)]);
        } elseif ($diaDaSemana == 5) {
            /**Sexta */

            $dataInicio = date('Y/m/d', strtotime('-5 days', strtotime($dataHoje)));
            $dataFim = date('Y/m/d', strtotime('+1 days', strtotime($dataInicio)));

            return view('dashboard', ['reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->paginate(15)]);
        } elseif ($diaDaSemana == 6) {
            /**Sabado */

            $dataInicio = date('Y/m/d', strtotime('-6 days', strtotime($dataHoje)));
            $dataFim = date('Y/m/d', strtotime('+0 days', strtotime($dataInicio)));

            return view('dashboard', ['reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->whereBetween('reserva.data', [$dataInicio, $dataFim])->orderBy('data', 'desc')->paginate(15)]);
        }
    }
    public function buscaTodos()
    {

        $reserva = new Reserva;

        return view('dashboard', ['reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->orderBy('data', 'desc')->paginate(15)]);
    }

    public function buscaMes(){
        $mesAtual = date('m');

        $reserva = new Reserva;

        return view('dashboard', ['reservas' => $reserva->select('reserva.*', 'users.name as nomeUsuario', 'solicitantes.nome as nomeSolicitante', 'laboratorio.nome as nomeLaboratorio')->join('laboratorio', 'laboratorio.id', '=', 'reserva.laboratorio_id')->join('solicitantes', 'solicitantes.id', '=', 'reserva.solicitante_id')->join('users', 'users.id', '=', 'reserva.usuario_id')->whereMonth('data', $mesAtual)->orderBy('data', 'desc')->paginate(15)]);
    }
    public function create(){
        $solicitantes = Solicitante::all();
        $laboratorios = Laboratorio::all();

        return view('reserva.dashboard.create', ['solicitantes' => $solicitantes, 'laboratorios' => $laboratorios]);
    }

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

            return view('reserva.dashboard.create2', ['solicitantes' => $solicitantes, 'laboratorios' => $laboratorios, 'idLaboratorio' => $idLaboratorio, 'dadosReserva' => $dadosReserva]);
        }
    }
}
