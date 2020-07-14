    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: #015D46">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon img-fluid">
          <img src="{{ asset('backend/img/Logo-fis.png') }}" alt="logo" class="img-fluid" width="50">
        </div>
        <div class="sidebar-brand-text mx-3">PS - FIS</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <li class="nav-item {{ Request::is('admin/grupos*') ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('grupos.index') }}">
          <i class="fas fa-users"></i>
          <span>Grupos</span></a>
      </li>
      <li class="nav-item {{ Request::is('admin/periodos*') ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('periodos.index') }}">
          <i class="fas fa-calendar-alt"></i>
          <span>Periódos Académicos</span></a>
      </li>
      


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>