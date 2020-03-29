@extends('layouts.app', ['activePage' => 'solicitante', 'titlePage' => __('Solicitante')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('equipamento.update', $equipamento) }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Editar Solicitante') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('equipamento.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar para Tela de Equipamento') }}</a>
                  </div>
                </div>

                <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Tipo Equipamento') }}</label>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <select class="form-control" data-style="btn btn-link" id="tipo_equipamento_id" name="tipo_equipamento_id">
                            @foreach ($tipoEquipamento as $tipo)
                                <option value="{{$tipo->id}}" {{ (old('tipo_equipamento_id') == $tipo->id ? 'selected'  : ($equipamento->tipo_equipamento_id  == $tipo->id ? 'selected' : '')) }}>{{$tipo->nome}}</option>
                            @endforeach
                        </select>
                        </div>

                    </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Tombo (N° Reg Equipamento)') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('tombo') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('tombo') ? ' is-invalid' : '' }}" name="tombo" id="input-tombo" type="text" placeholder="{{ __('tombo') }}" value="{{ $equipamento->tombo }}" required="true" aria-required="true"/>
                      @if ($errors->has('tombo'))
                        <span id="name-error" class="error text-danger" for="input-tombo">{{ $errors->first('tombo') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">Descrição</label>
                  <div class="col-sm-7">
                    <div class="form-group bmd-form-group">
                        <div class="form-group{{ $errors->has('descricao') ? ' has-danger' : '' }}">
                                <textarea cols="30" rows="10" class="form-control{{ $errors->has('descricao') ? ' is-invalid' : '' }}" name="descricao" id="input-descricao" type="text" placeholder="Descrição" required="true" aria-required="true">
                                <?php
                                    print_r($equipamento->descricao);
                                ?>
                                </textarea>
                                @if ($errors->has('descricao'))
                                    <span id="name-error" class="error text-danger" for="input-descricao">{{ $errors->first('descricao') }}</span>
                                @endif
                        </div>

                        </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">Imagem</label>
                  <div class="col-sm-7">
                    <div class="fileinput fileinput-new text-center"  data-provides="fileinput">
                        <div>
                            <span class="btn btn-success btn-round btn-file col-md-12">
                                <input type="file" name="imagem">
                            </span>

                        </div>
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
