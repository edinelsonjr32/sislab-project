@extends('layouts.app', ['activePage' => 'reserva', 'titlePage' => __('Reserva Gerenciamento')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title text-danger">Erro!!! Há um conflito, já existe reserva para este intervalo de horário!</h4>
              </div>
              <div class="card-body">
                  @foreach ($dadosReserva as $item)
                        <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                        <span>
                            <b class="text-right"> Existe uma Reserva para este horário - </b> Horário: {{date('d/M/Y', strtotime($item->data))}} - {{$item->hora_inicio}}/{{$item->hora_fim}}, solicitante : {{$item->nomeUsuario}}.</span>
                        </div>
                    @endforeach
              </div>
            </div>
          </div>
        <div class="col-md-12">
          <form method="post" action="{{ route('reserva.update', $idReserva) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Editar Reserva') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('reserva.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar para Tela de Laboratório') }}</a>
                  </div>
                </div>


                <input type="hidden" name="reserva_id" value="{{$idReserva}}">
                <input type="hidden" name="laboratorio_id" value="{{$reserva->laboratorio_id}}">



                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Data') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('data') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('data') ? ' is-invalid' : '' }}" name="data" id="input-name" type="date" placeholder="{{ __('dd/mm/yyyy') }}" value="{{ $reserva->data }}" required="true" aria-required="true"/>
                      @if ($errors->has('data'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('data') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Hora Inicio') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('hora_inicio') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('hora_inicio') ? ' is-invalid' : '' }}" name="hora_inicio" id="input-name" type="time" placeholder="{{ __('dd/mm/yyyy') }}" value="{{ $reserva->hora_inicio }}" required="true" aria-required="true"/>
                      @if ($errors->has('hora_inicio'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('hora_inicio') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Hora Fim') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('hora_fim') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('hora_fim') ? ' is-invalid' : '' }}" name="hora_fim" id="input-name" type="time" placeholder="{{ __('dd/mm/yyyy') }}" value="{{ $reserva->hora_fim }}" required="true" aria-required="true"/>
                      @if ($errors->has('hora_fim'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('hora_fim') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Solicitante') }}</label>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <select class="form-control" data-style="btn btn-link" id="solicitante_id" name="solicitante_id">
                            @foreach ($solicitantes as $tipo)
                                <option value="{{$tipo->id}}" {{ (old('solicitante_id') == $tipo->id ? 'selected'  : ($reserva->solicitante_id  == $tipo->id ? 'selected' : '')) }}>{{$tipo->nome}}</option>
                            @endforeach
                        </select>
                        </div>

                    </div>
                </div>


              <div class="row">
                <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-primary">{{ __('Salvar') }}</button>
                  </div>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
