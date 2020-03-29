@extends('layouts.app', ['activePage' => 'gerenciamento_equipamento', 'titlePage' => __('Gerenciamento de Equipamento')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('reserva.laboratorio.salva.reserva.equipamento') }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
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
                      <a href="{{ route('reserva.laboratorio.detalhe', $idReserva) }}" class="btn btn-sm btn-primary">{{ __('Voltar para Listagem de Equipamento') }}</a>
                  </div>
                </div>

                <input type="hidden" name="reserva_id" value="{{$idReserva}}">

                <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Tipo Equipamento') }}</label>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <select class="form-control" data-style="btn btn-link" id="tipo_equipamento_id" name="equipamento_id">
                            @foreach ($equipamentos as $tipo)
                                <option value="{{$tipo->id}}">{{$tipo->nome}} - Tombo: {{$tipo->tombo}}</option>
                            @endforeach
                        </select>
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
