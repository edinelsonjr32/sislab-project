@extends('layouts.app', ['activePage' => 'solicitante', 'titlePage' => __('Solicitante Páginal Inicial')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Solicitante') }}</h4>
                <p class="card-category"> {{ __('Gerenciamento de Solicitante') }}</p>
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
                    <a href="{{ route('solicitante.create') }}" class="btn btn-sm btn-primary">{{ __('Adicionar Solicitante') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                          {{ __('Nome') }}
                      </th>
                      <th>
                        {{ __('Tipo') }}
                      </th>

                      <th class="text-right">
                        {{ __('Ação') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($solicitantes as $item)
                        <tr>
                          <td>
                            {{ $item->nome }}
                          </td>
                          <td>
                            {{ $item->nomeTipo }}
                          </td>
                          <td class="td-actions text-right">
                            @if ($item->id)
                              <form action="{{ route('solicitante.destroy', $item) }}" method="post">
                                  @csrf
                                  @method('delete')

                                  <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('solicitante.edit', $item) }}" data-original-title="" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                  </a>
                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Você tem certeza que deseja excluir?") }}') ? this.parentElement.submit() : ''">
                                      <i class="material-icons">close</i>
                                      <div class="ripple-container"></div>
                                  </button>
                              </form>
                            @else
                              <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('profile.edit') }}" data-original-title="" title="">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container"></div>
                              </a>
                            @endif
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{ $solicitantes->links() }}
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
