@extends('layouts.app', ['activePage' => 'laboratorio', 'titlePage' => __('User Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('laboratorio.update', $laboratorio) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Editar Laboratório') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('laboratorio.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar para Tela de Laboratório') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nome') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('nome') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" name="nome" id="input-name" type="text" placeholder="{{ __('Nome') }}" value="{{ old('name', $laboratorio->nome) }}" required="true" aria-required="true"/>
                      @if ($errors->has('nome'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('nome') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Tipo laboratório') }}</label>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <select class="form-control" data-style="btn btn-link" id="tipo_laboratorio_id" name="tipo_laboratorio_id">
                            @foreach ($tipoLab as $tipo)
                                <option value="{{$tipo->id}}" {{ (old('tipo_laboratorio_id') == $tipo->id ? 'selected'  : ($laboratorio->tipo_laboratorio_id  == $tipo->id ? 'selected' : '')) }}>{{$tipo->nome}}</option>
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
