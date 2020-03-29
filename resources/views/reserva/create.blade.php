@extends('layouts.app', ['activePage' => 'laboratorio', 'titlePage' => __('Gerenciamento de Laboratórios')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('reserva.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Adicionar Reserva') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('reserva.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar para Listagem de Tipo') }}</a>
                  </div>
                </div>
                <input type="hidden" name="laboratorio_id" value="{{$idLaboratorio}}">


                <input type="hidden" name="usuario_id" value="{{auth()->id()}}">

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Data') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('data') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('data') ? ' is-invalid' : '' }}" name="data" id="input-name" type="date" placeholder="{{ __('dd/mm/yyyy') }}" value="{{ old('data') }}" required="true" aria-required="true"/>
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
                      <input class="form-control{{ $errors->has('hora_inicio') ? ' is-invalid' : '' }}" name="hora_inicio" id="input-name" type="time" placeholder="{{ __('dd/mm/yyyy') }}" value="{{ old('hora_inicio') }}" required="true" aria-required="true"/>
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
                      <input class="form-control{{ $errors->has('hora_fim') ? ' is-invalid' : '' }}" name="hora_fim" id="input-name" type="time" placeholder="{{ __('dd/mm/yyyy') }}" value="{{ old('hora_fim') }}" required="true" aria-required="true"/>
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
                                <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                            @endforeach
                        </select>
                        </div>

                    </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">Observação</label>
                  <div class="col-sm-7">
                    <div class="form-group bmd-form-group">
                        <div class="form-group{{ $errors->has('observacao') ? ' has-danger' : '' }}">
                                <textarea cols="30" rows="10" class="form-control{{ $errors->has('observacao') ? ' is-invalid' : '' }}" name="observacao" id="input-description" type="text" placeholder="Observação" required="true" aria-required="true"></textarea>
                                @if ($errors->has('observacao'))
                                    <span id="name-error" class="error text-danger" for="input-observacao">{{ $errors->first('observacao') }}</span>
                                @endif
                        </div>

                        </div>
                  </div>
                </div>
                <div class="row">
                    <div class="card-footer ml-auto mr-auto">
                        <button type="submit" class="btn btn-primary">{{ __('Adicionar') }}</button>
                    </div>
                </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
