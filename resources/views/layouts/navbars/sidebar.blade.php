<div class="sidebar" data-color="orange" data-background-color="black" data-image="{{ asset('material') }}/img/sidebar-6.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="/home" class="simple-text logo-normal">
      {{ __('SISLAB') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Inicio') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user.index') }}">
          <i class="material-icons">supervised_user_circle</i>
            <p>{{ __('Usuários') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'gerenciamento_equipamento' ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#pagesExamples" >
          <i class="material-icons">insert_invitation</i>
          <p> Ger. Equipamento
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="pagesExamples" style="">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="{{route('equipamento.index')}}">
                    <span class="sidebar-mini">

                    </span>

                <span class="sidebar-normal">
                        <i class="material-icons"></i>
                        Equipamento
                    </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('tipo_equipamento.index')}}">
                    <span class="sidebar-mini">

                    </span>

                <span class="sidebar-normal">
                        <i class="material-icons"></i>
                        Tipo Equipamento
                    </span>
              </a>
            </li>


          </ul>
        </div>
      </li>
      <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('profile.edit') }}">
          <i class="material-icons">perm_identity</i>
            <p>{{ __('Meu Perfil') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'tipo-laboratorio' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('tipo_laboratorio.index') }}">
          <i class="material-icons">domain</i>
            <p>{{ __('Tipo Laboratório') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'laboratorio' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('laboratorio.index') }}">
          <i class="material-icons">domain</i>
            <p>{{ __('Laboratório') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'tipo_solicitante' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('tipo_solicitante.index') }}">
          <i class="material-icons">assignment_ind</i>
          <p>{{ __('Tipo Solicitante') }}</p>
        </a>
      </li>

      <li class="nav-item{{ $activePage == 'solicitante' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('solicitante.index') }}">
          <i class="material-icons">perm_identity</i>
          <p>{{ __('Solicitante') }}</p>
        </a>
      </li>






      <li class="nav-item{{ $activePage == 'reserva' ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#pagesExamples" aria-expanded="true">
          <i class="material-icons">insert_invitation</i>
          <p> Reserva
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="pagesExamples" style="">
          <ul class="nav">
              <?php
                $laboratorios = DB::table('laboratorio')->select('laboratorio.*')->get();

              ?>
              @foreach ($laboratorios as $item)

                <li class="nav-item">
                    <a class="nav-link" href="{{route('reserva.laboratorio.index', $item->id)}}">
                    <span class="sidebar-mini">

                    </span>

                    <span class="sidebar-normal">
                        <i class="material-icons">star</i>
                        {{$item->nome}}
                    </span>
                    </a>
                </li>
              @endforeach


          </ul>
        </div>
      </li>



    </ul>
  </div>
</div>


