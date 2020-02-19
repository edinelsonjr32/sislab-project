<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="https://creative-tim.com/" class="simple-text logo-normal">
      {{ __('SISLAB-UFOPA') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user.index') }}">
          <i class="material-icons">supervised_user_circle</i>
            <p>{{ __('Usuários') }}</p>
        </a>
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
        <a class="nav-link" href="{{ route('tipo_solicitante.index') }}">
          <i class="material-icons">perm_identity</i>
          <p>{{ __('Solicitante') }}</p>
        </a>
      </li>



      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('table') }}">
          <i class="material-icons">perm_identity</i>
            <p>{{ __('Table List') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'typography' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('typography') }}">
          <i class="material-icons">library_books</i>
            <p>{{ __('Typography') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'icons' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('icons') }}">
          <i class="material-icons">bubble_chart</i>
          <p>{{ __('Icons') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'map' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('map') }}">
          <i class="material-icons">location_ons</i>
            <p>{{ __('Maps') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('notifications') }}">
          <i class="material-icons">notifications</i>
          <p>{{ __('Notifications') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'language' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('language') }}">
          <i class="material-icons">language</i>
          <p>{{ __('RTL Support') }}</p>
        </a>
      </li>
      <li class="nav-item active-pro{{ $activePage == 'upgrade' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('upgrade') }}">
          <i class="material-icons">unarchive</i>
          <p>{{ __('Upgrade to PRO') }}</p>
        </a>
      </li>
    </ul>
  </div>
</div>
