@extends('layouts.app', ['activePage' => 'Páginal Inicial', 'titlePage' => __('Usuários Páginal Inicial')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">


            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Relatório de Reservas de Laboratórios do Periodo:
                            {{date('d/m/y', strtotime($dataInicio))}} - {{date('d/m/y', strtotime($dataFim))}}</h4>
                        <p class="card-category"> {{ __('Gerenciamento de Reservas') }}</p>
                    </div>


                    <div class="card-body">
                        @if (session('status'))
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="material-icons">close</i>
                                    </button>
                                    <span>{{ session('status') }}</span>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-12 text-right">
                                <button href"" onclick="window.print();"
                                    class="btn btn-sm btn-primary">{{ __('Imprimir') }}</button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary text-center">
                                    <th>
                                        {{ __('Laboratório') }}
                                    </th>
                                    <th>
                                        {{ __('Data') }}
                                    </th>
                                    <th>
                                        {{ __('Hora Inicio') }}
                                    </th>
                                    <th>
                                        {{ __('Hora Fim') }}
                                    </th>
                                    <th>
                                        {{ __('Solicitante') }}
                                    </th>
                                </thead>
                                <tbody>

                                    @foreach ($testando as $item)

                                    @if($item == '[]')
                                    @elseif($item !== '[]')
                                    @foreach ($item as $dado)
                                    <tr class="text-center">
                                        <td><b>{{$dado->nome}}</b></td>
                                        <td>{{date('d/m/y', strtotime($dado->data))}}</td>
                                        <td>{{$dado->hora_inicio}}</td>
                                        <td>{{$dado->hora_fim}}</td>
                                        <td>{{$dado->nomeSolicitante}}</td>
                                    </tr>
                                    @endforeach
                                    @endif

                                    @endforeach

                                </tbody>
                            </table>


                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title ">Relatório de Reservas de Equipamentos do Periodo:
                            {{date('d/m/y', strtotime($dataInicio))}} - {{date('d/m/y', strtotime($dataFim))}}</h4>
                        <p class="card-category"> {{ __('Gerenciamento de Reservas de Equipamentos') }}</p>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="material-icons">close</i>
                                    </button>
                                    <span>{{ session('status') }}</span>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary text-center">
                                        <th>
                                            {{ __('Equipamento') }}
                                        </th>
                                        <th>
                                            {{ __('Tombo') }}
                                        </th>
                                        <th>
                                            {{ __('Laboratório') }}
                                        </th>
                                        <th>
                                            {{ __('Data') }}
                                        </th>
                                        <th>
                                            {{ __('Hora Inicio') }}
                                        </th>
                                        <th>
                                            {{ __('Hora Fim') }}
                                        </th>
                                        <th>
                                            {{ __('Solicitante') }}
                                        </th>
                                    </thead>
                                    <tbody>

                                        @foreach ($reservasEquipamentos as $itens)

                                        @if($itens == '[]')
                                        @elseif($itens !== '[]')

                                        @endif

                                        @foreach ($itens as $item)
                                        <tr class="text-center">
                                            <td><b>{{$item->nomeTipo}}</b></td>
                                            <td>{{$item->tomboEquipamento}}</td>
                                            <td>{{$item->nomeLabin}}</td>
                                            <td>{{date('d/m/y', strtotime($item->data))}}</td>
                                            <td>{{$item->hora_inicio}}</td>
                                            <td>{{$item->hora_fim}}</td>
                                            <td>{{$dado->nomeSolicitante}}</td>
                                        </tr>
                                        @endforeach


                                        @endforeach

                                    </tbody>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
