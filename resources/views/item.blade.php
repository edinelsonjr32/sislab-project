@extends('layouts.app', ['activePage' => 'tipo_solicitante', 'titlePage' => __('Tipo Solicitante')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            @foreach ($itens as $item)
            <form method="post" action="" autocomplete="off" class="form-horizontal">

            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Editar Tipo Solicitante') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('tipo_solicitante.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar para Tela de Tipo de Solicitante') }}</a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-5 col-md-6 col-sm-3">
                    <div class="dropdown bootstrap-select show-tick dropup"><select class="selectpicker" data-style="select-with-transition" multiple="" title="Choose City" data-size="7" tabindex="-98">
                      <option disabled=""> Multiple Options</option>
                      <option value="2">Paris </option>
                      <option value="3">Bucharest</option>
                      <option value="4">Rome</option>
                      <option value="5">New York</option>
                      <option value="6">Miami </option>
                      <option value="7">Piatra Neamt</option>
                      <option value="8">Paris </option>
                      <option value="9">Bucharest</option>
                      <option value="10">Rome</option>
                      <option value="11">New York</option>
                      <option value="12">Miami </option>
                      <option value="13">Piatra Neamt</option>
                      <option value="14">Paris </option>
                      <option value="15">Bucharest</option>
                      <option value="16">Rome</option>
                      <option value="17">New York</option>
                      <option value="18">Miami </option>
                      <option value="19">Piatra Neamt</option>
                    </select><button type="button" class="btn dropdown-toggle bs-placeholder select-with-transition" data-toggle="dropdown" role="button" title="Choose City" aria-expanded="false"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">Choose City</div></div> </div><div class="ripple-container"></div></button><div class="dropdown-menu" role="combobox" style="max-height: 276px; overflow: hidden; min-width: 220px; position: absolute; top: -273px; left: 1px; will-change: top, left;" x-placement="top-start"><div class="inner show" role="listbox" aria-expanded="false" tabindex="-1" style="max-height: 266px; overflow-y: auto;"><ul class="dropdown-menu inner show"><li class="disabled"><a role="option" class="dropdown-item disabled" aria-disabled="true" tabindex="-1" aria-selected="false"><span class=" bs-ok-default check-mark"></span><span class="text"> Multiple Options</span></a></li><li><a role="option" class="dropdown-item" aria-disabled="false" tabindex="0" aria-selected="false"><span class=" bs-ok-default check-mark"></span><span class="text">Paris </span></a></li><li><a role="option" class="dropdown-item" aria-disabled="false" tabindex="0" aria-selected="false"><span class=" bs-ok-default check-mark"></span><span class="text">Bucharest</span></a></li><li><a role="option" class="dropdown-item" aria-disabled="false" tabindex="0" aria-selected="false"><span class=" bs-ok-default check-mark"></span><span class="text">Rome</span></a></li><li><a role="option" class="dropdown-item" aria-disabled="false" tabindex="0" aria-selected="false"><span class=" bs-ok-default check-mark"></span><span class="text">New York</span></a></li><li><a role="option" class="dropdown-item" aria-disabled="false" tabindex="0" aria-selected="false"><span class=" bs-ok-default check-mark"></span><span class="text">Miami </span></a></li><li><a role="option" class="dropdown-item" aria-disabled="false" tabindex="0" aria-selected="false"><span class=" bs-ok-default check-mark"></span><span class="text">Piatra Neamt</span></a></li><li><a role="option" class="dropdown-item" aria-disabled="false" tabindex="0" aria-selected="false"><span class=" bs-ok-default check-mark"></span><span class="text">Paris </span></a></li><li><a role="option" class="dropdown-item" aria-disabled="false" tabindex="0" aria-selected="false"><span class=" bs-ok-default check-mark"></span><span class="text">Bucharest</span></a></li><li><a role="option" class="dropdown-item" aria-disabled="false" tabindex="0" aria-selected="false"><span class=" bs-ok-default check-mark"></span><span class="text">Rome</span></a></li><li><a role="option" class="dropdown-item" aria-disabled="false" tabindex="0" aria-selected="false"><span class=" bs-ok-default check-mark"></span><span class="text">New York</span></a></li><li><a role="option" class="dropdown-item" aria-disabled="false" tabindex="0" aria-selected="false"><span class=" bs-ok-default check-mark"></span><span class="text">Miami </span></a></li><li><a role="option" class="dropdown-item" aria-disabled="false" tabindex="0" aria-selected="false"><span class=" bs-ok-default check-mark"></span><span class="text">Piatra Neamt</span></a></li><li><a role="option" class="dropdown-item" aria-disabled="false" tabindex="0" aria-selected="false"><span class=" bs-ok-default check-mark"></span><span class="text">Paris </span></a></li><li><a role="option" class="dropdown-item" aria-disabled="false" tabindex="0" aria-selected="false"><span class=" bs-ok-default check-mark"></span><span class="text">Bucharest</span></a></li><li><a role="option" class="dropdown-item" aria-disabled="false" tabindex="0" aria-selected="false"><span class=" bs-ok-default check-mark"></span><span class="text">Rome</span></a></li><li><a role="option" class="dropdown-item" aria-disabled="false" tabindex="0" aria-selected="false"><span class=" bs-ok-default check-mark"></span><span class="text">New York</span></a></li><li><a role="option" class="dropdown-item" aria-disabled="false" tabindex="0" aria-selected="false"><span class=" bs-ok-default check-mark"></span><span class="text">Miami </span></a></li><li><a role="option" class="dropdown-item" aria-disabled="false" tabindex="0" aria-selected="false"><span class=" bs-ok-default check-mark"></span><span class="text">Piatra Neamt</span></a></li></ul></div></div></div>
                  </div>
                </div>

              <div class="row">
                <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-primary">{{ __('Salvar') }}</button>
                  </div>
              </div>

              @endforeach
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
