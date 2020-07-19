@extends('layouts.app', ['activePage' => 'laboratorio', 'titlePage' => __('Gerenciamento de Laboratórios')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-right">
                <a href="{{ route('reserva.busca.todos', $idLaboratorio) }}"
                    class="btn btn-sm btn-primary">{{ __('Voltar para Listagem de Tipo') }}</a>
            </div>
            @if ($dadosErro !== [])
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-danger">
                        <h4 class="card-title">
                            {{ __('Erro!!! Há um conflito, já existe reserva para este intervalo de horário!') }}</h4>
                        <p class="card-category"></p>
                    </div>

                    <div class="card-body">
                        @foreach ($dadosErro as $key => $values )
                            @foreach ($values as $item)

                                <div class="alert alert-primary">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="material-icons">close</i>
                                    </button>
                                    <span>
                                        <b class="text-right"> Dados Reserva - </b> Horário:
                                        {{date('d/M/Y', strtotime($item->data))}} - {{$item->hora_inicio}}/{{$item->hora_fim}},
                                        solicitante : {{$item->nomeSolicitante}}.
                                    </span>
                                </div>

                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
            @else

            @endif



            @if ($reservasCadastradas !== [])
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title">{{ __('Reservas Cadastradas com Sucesso!') }}</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body">
                        @foreach ($reservasCadastradas as $key => $item )

                            <div class="alert alert-primary">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                                <span>
                                    <b class="text-right"> Reserva Cadastrada - </b> Horário:
                                    {{date('d/M/Y', strtotime($item->data))}} - {{$item->hora_inicio}}/{{$item->hora_fim}}.
                                </span>
                            </div>

                        @endforeach

                    </div>
                </div>
            </div>

            @else

            @endif


        </div>
    </div>
</div>
@endsection
