@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-2 col-md-12 col-sm-12">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">supervised_user_circle</i>
              </div>
              <p class="card-category">Usuários</p>
              <h3 class="card-title">
                <?php
                    $dados=DB::table('users')->count();
                ?>
                <small>{{$dados}}</small>
              </h3>
            </div>
            <div class="card-footer">
              <div class=" ml-auto mr-auto ">
                    <a class="btn btn-success btn-lg " href="{{route('user.index')}}">Acessar</a>
                </div>
            </div>
          </div>
        </div>

        <div class="col-lg-2 col-md-12 col-sm-12">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">domain</i>
              </div>
              <p class="card-category">Tipo Laboratório</p>
              <h3 class="card-title">
                <?php
                    $dados=DB::table('tipo_laboratorio')->count();
                ?>
                <small>{{$dados}}</small>
              </h3>
            </div>
            <div class="card-footer">
              <div class=" ml-auto mr-auto ">
                    <a class="btn btn-success btn-lg " href="{{route('tipo_laboratorio.index')}}">Acessar</a>
                </div>
            </div>
          </div>
        </div>

        <div class="col-lg-2 col-md-12 col-sm-12">
          <div class="card card-stats">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">domain</i>
              </div>
              <p class="card-category">Laboratório</p>
              <h3 class="card-title">
                <?php
                    $dados=DB::table('laboratorio')->count();
                ?>
                <small>{{$dados}}</small>
              </h3>
            </div>
            <div class="card-footer">
              <div class=" ml-auto mr-auto ">
                    <a class="btn btn-success btn-lg " href="{{route('laboratorio.index')}}">Acessar</a>
                </div>
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-12 col-sm-12">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">assignment_ind</i>
              </div>
              <p class="card-category">Tipo Solicitante</p>
              <h3 class="card-title">
                <?php
                    $dados=DB::table('tipo_solicitante')->count();
                ?>
                <small>{{$dados}}</small>
              </h3>
            </div>
            <div class="card-footer">
              <div class=" ml-auto mr-auto ">
                    <a class="btn btn-success btn-lg " href="{{route('tipo_solicitante.index')}}">Acessar</a>
                </div>
            </div>
          </div>
        </div>


        <div class="col-lg-2 col-md-12 col-sm-12">
          <div class="card card-stats">
            <div class="card-header card-header-default card-header-icon">
              <div class="card-icon">
                <i class="material-icons">perm_identity</i>
              </div>
              <p class="card-category">Solicitante</p>
              <h3 class="card-title">
                <?php
                    $dados=DB::table('solicitantes')->count();
                ?>
                <small>{{$dados}}</small>
              </h3>
            </div>
            <div class="card-footer">
              <div class=" ml-auto mr-auto ">
                    <a class="btn btn-success btn-lg " href="{{route('solicitante.index')}}">Acessar</a>
                </div>
            </div>
          </div>
        </div>

        <div class="col-lg-2 col-md-12 col-sm-12">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">perm_identity</i>
              </div>
              <p class="card-category">Meu Perfil</p>
              <h3 class="card-title">


              </h3>
            </div>
            <div class="card-footer">
                <div class=" ml-auto mr-auto ">

                    <a class="btn btn-success btn-lg " href="{{route('profile.edit')}}">Acessar</a>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
            <div class="col-12 text-right">
                <a href="{{route('dashboard.reserva.create')}}" class="btn btn-lg btn-rose"><i class="material-icons">add_circle</i> Reserva<div class="ripple-container"></div></a>
              </div>

            <div class="col-lg-8 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">insert_invitation</i>
                  </div>
                  <p class="card-category">Reservas</p>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table">
                          <thead class=" text-primary">
                            <th>
                                {{ __('Laboratório') }}
                            </th>
                            <th>
                              {{ __('Solicitante') }}
                            </th>
                            <th>
                              {{ __('Cadastrado Por') }}
                            </th>
                            <th>
                              {{ __('Data') }}
                            </th>
                            <th>
                              {{ __('Hora Inicio/Fim') }}
                            </th>

                            <th class="text-right" width="20%">
                              {{ __('Ação') }}
                            </th>
                          </thead>
                          <tbody>
                            @foreach($reservas as $item)
                              <tr>
                                <td>
                                  {{ $item->nomeLaboratorio }}
                                </td>
                                <td>
                                  {{ $item->nomeSolicitante }}
                                </td>
                                <td>
                                  {{ $item->nomeUsuario }}
                                </td>
                                <td>
                                    @php
                                       echo date('d/M/Y', strtotime($item->data));
                                    @endphp

                                </td>
                                <td>
                                  {{ $item->hora_inicio }}-{{$item->hora_fim}}
                                </td>
                                <td class="td-actions text-right">
                                  @if ($item->id)
                                    <form action="{{ route('reserva.destroy', $item) }}" method="post">
                                        @csrf
                                        @method('delete')


                                        <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('reserva.edit', $item) }}" data-original-title="" title="">
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
                      </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">equalizer</i>
                  </div>
                  <h3 class="card-title">Busca  Avançada</h3>
                </div>
                <div class="card-body">
                    <div class="card-body ">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-rose card-header-text">
                                        <div class="card-icon">
                                            <i class="material-icons">library_books</i>
                                        </div>
                                        <h4 class="card-title">Data</h4>
                                </div>
                                <div class="card-body ">
                                    <form method="post" action="{{ route('dashboard.reserva.busca.data') }}" autocomplete="off" class="form-horizontal">
                                        @csrf
                                        @method('post')
                                        <div class="form-group bmd-form-group is-filled">
                                            <input type="date" class="form-control datepicker" name="data" >
                                            <button type="submit" class="btn btn-primary btn-lg btn-block">Buscar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body ">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-rose card-header-text">
                                        <div class="card-icon">
                                            <i class="material-icons">date_range</i>
                                        </div>
                                        <h4 class="card-title">Periodo</h4>
                                </div>
                                <div class="card-body ">
                                    <a type="button" class="btn btn-block btn-lg btn-block" href="{{route('home')}}">Hoje</a>
                                    <a type="button" class="btn btn-info btn-lg btn-block" href="{{route('dashboard.reserva.busca.semana')}}">Semana</a>
                                    <a type="button" class="btn btn-success btn-lg btn-block" href="{{route('dashboard.reserva.busca.mes')}}">Mês</a>
                                    <a type="button" class="btn btn-danger btn-lg btn-block" href="{{route('dashboard.reserva.busca.todos')}}">Todos</a>
                                  </div>
                            </div>
                        </div>
                    </div>

                </div>
              </div>
            </div>
            <div class="col-md-4 ml-auto">
              <div class="card card-stats">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">equalizer</i>
                  </div>
                  <h3 class="card-title">Relatório</h3>
                </div>
                <div class="card-body">
                    <div class="card-body ">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-rose card-header-text">
                                        <div class="card-icon">
                                            <i class="material-icons">library_books</i>
                                        </div>
                                        <h4 class="card-title">Data</h4>
                                </div>
                                <div class="card-body ">
                                    <form method="post" action="{{ route('reserva.laboratorio.relatorio') }}" autocomplete="off" class="form-horizontal">
                                        @csrf
                                        @method('post')

                                        <div class="row">
                                            <label class="col-sm-2 col-form-label">{{ __('Data Inicio') }}</label>
                                            <div class="col-sm-10">
                                                <div class="form-group">
                                                    <input type="date" class="form-control datepicker" name="dataInicio" >
                                                </select>
                                                </div>

                                            </div>


                                        </div>
                                        <div class="row">
                                            <label class="col-sm-2 col-form-label">{{ __('Data Fim') }}</label>
                                            <div class="col-sm-10">
                                                <div class="form-group">
                                                    <input type="date" class="form-control datepicker" name="dataFim" >
                                                </select>
                                                </div>

                                            </div>
                                        </div>
                                         <button type="submit" class="btn btn-primary btn-lg btn-block">Buscar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
              </div>
            </div>
          </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush
