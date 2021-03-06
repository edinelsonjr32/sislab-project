@extends('layouts.app', ['activePage' => 'tipo-laboratorio', 'titlePage' => __('User Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('tipo_laboratorio.update', $tipoLaboratorio) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Editar Tipo Laboratório') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('tipo_laboratorio.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar para Tela de Tipo de Laboratório') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nome') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('nome') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('nome') ? ' is-invalid' : '' }}" name="nome" id="input-name" type="text" placeholder="{{ __('Nome') }}" value="{{ old('name', $tipoLaboratorio->nome) }}" required="true" aria-required="true"/>
                      @if ($errors->has('nome'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('nome') }}</span>
                      @endif
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
