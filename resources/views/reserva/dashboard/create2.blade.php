@extends('layouts.app', ['activePage' => 'laboratorio', 'titlePage' => __('Gerenciamento de Laboratórios')])

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
          <form method="post" action="{{ route('dashboard.reserva.salvar') }}" autocomplete="off" class="form-horizontal">
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



                <input type="hidden" name="usuario_id" value="{{auth()->id()}}">

                <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Laboratório') }}</label>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <select class="form-control" data-style="btn btn-link" id="laboratorio_id" name="laboratorio_id">
                            @foreach ($laboratorios as $tipo)
                                <option value="{{$tipo->id}}">{{$tipo->nome}}</option>
                            @endforeach
                        </select>
                        </div>

                    </div>
                </div>
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
                    <label class="col-sm-2 col-form-label">Repetir Reserva</label>
                    <div class="col-sm-7">
                        <div class="form-group bmd-form-group">
                            <div class="form-check">
                                <input type="radio" name="opcaoReserva" value="1" id="diariamente2" checked>
                                <label class="form-check-label" for="gridRadios1">
                                    Uma Vez
                                </label>
                            </div>


                            <div class="form-check">
                                <input type="radio" name="opcaoReserva" value="2" id="semanalmente">
                                <label class="form-check-label" for="gridRadios1">
                                    Semanalmente
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="opcaoReserva" value="3" id="diariamente">
                                <label class="form-check-label" for="gridRadios1">
                                    Diariamente
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="opcaoReserva" value="5" id="personalizado">
                                <label class="form-check-label" for="gridRadios1">
                                    Personalizado
                                </label>
                            </div>

                        </div>
                    </div>
                </div>


                <div id="personalizadoId">
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Dias da Semana</label>
                        <div class="col-sm-7">
                            <div class="form-group bmd-form-group">
                                <div class="form-check">
                                    <input type="checkbox" name="segunda" value="1">
                                    <label class="form-check-label" for="gridRadios1">
                                        Segunda
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" name="terca" value="1">
                                    <label class="form-check-label" for="gridRadios1">
                                        Terça
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="quarta" value="1">
                                    <label class="form-check-label" for="gridRadios1">
                                        Quarta
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="quinta" value="1">
                                    <label class="form-check-label" for="gridRadios1">
                                        Quinta
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="sexta" value="1">
                                    <label class="form-check-label" for="gridRadios1">
                                        Sexta
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="sabado" value="1">
                                    <label class="form-check-label" for="gridRadios1">
                                        Sábado
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="domingo" value="1">
                                    <label class="form-check-label" for="gridRadios1">
                                        Domingo
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div id="dataFimId">
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Data Fim') }}</label>
                        <div class="col-sm-7">
                            <div class="form-group{{ $errors->has('dataFim') ? ' has-danger' : '' }}">
                                <input class="form-control{{ $errors->has('dataFim') ? ' is-invalid' : '' }}" name="dataFim"
                                    id="input-name" type="date" placeholder="{{ __('dd/mm/yyyy') }}" value="{{ old('dataFim') }}" />
                                @if ($errors->has('dataFim'))
                                <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('dataFim') }}</span>
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
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $( document ).ready(function() {
        document.getElementById("personalizadoId").style.display = "none";
        document.getElementById("dataFimId").style.display = "none";


        $("#personalizado").click(function(){
            if ($(this).prop('checked')){
                document.getElementById("personalizadoId").style.display = "block";
                document.getElementById("dataFimId").style.display = "block";
                //$('input.dinheiro').val("");
            } else {
                document.getElementById("personalizadoId").style.display = "none";
                document.getElementById("dataFimId").style.display = "none";
                //$("input.dinheiro").val("");
            }
        });
        $("#segundasexta").click(function(){
            if ($(this).prop('checked')){
                document.getElementById("personalizadoId").style.display = "none";
                document.getElementById("dataFimId").style.display = "block";
                //$('input.dinheiro').val("");
            } else {
                document.getElementById("personalizadoId").style.display = "none";
                document.getElementById("dataFimId").style.display = "none";
                //$("input.dinheiro").val("");
            }
        });
        $("#diariamente").click(function(){
            if ($(this).prop('checked')){
                document.getElementById("personalizadoId").style.display = "none";
                document.getElementById("dataFimId").style.display = "block";
                //$('input.dinheiro').val("");
            } else {
                document.getElementById("personalizadoId").style.display = "none";
                document.getElementById("dataFimId").style.display = "none";
                //$("input.dinheiro").val("");
            }
        });
        $("#semanalmente").click(function(){
            if ($(this).prop('checked')){
                document.getElementById("personalizadoId").style.display = "none";
                document.getElementById("dataFimId").style.display = "block";
                //$('input.dinheiro').val("");
            } else {
                document.getElementById("personalizadoId").style.display = "none";
                document.getElementById("dataFimId").style.display = "none";
                //$("input.dinheiro").val("");
            }
        });
        $("#diariamente2").click(function(){
            if ($(this).prop('checked')){
                document.getElementById("personalizadoId").style.display = "none";
                document.getElementById("dataFimId").style.display = "none";
                //$('input.dinheiro').val("");
            } else {
                document.getElementById("personalizadoId").style.display = "none";
                document.getElementById("dataFimId").style.display = "none";
                //$("input.dinheiro").val("");
            }
        });


    });
</script>
@endsection
