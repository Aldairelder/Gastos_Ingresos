    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="" class="brand-link">
            <img src="{{ asset('dist/img/BSNTS.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                        alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ auth()->user()->usuario }}</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
        with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link @yield('dashboard')">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                                <span class="right badge badge-danger">New</span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('clases') }}" class="nav-link @yield('clase')">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                CLASES
                            </p>
                        </a>
                    </li>
                    <li class="nav-item @yield('entidades')">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                ENTIDADES
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">2</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('empresas') }}" class="nav-link @yield('empresa')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Empresas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('personas') }}" class="nav-link @yield('persona')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Personas</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header">MOVIMIENTOS</li>
                    <li class="nav-item">
                        <a href="{{ route('gastos') }}" class="nav-link @yield('gasto')">
                            <i class="nav-icon fas fa-file-invoice-dollar text-danger"></i>
                            <p>Gastos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ingresos') }}" class="nav-link @yield('ingreso')">
                            <i class="nav-icon fas fa-dollar-sign text-success"></i>
                            <p>Ingresos</p>
                        </a>
                    </li>
                    <li class="nav-header">PERSONAL</li>
                    <li class="nav-item">
                        <a href="{{ route('trabajadores') }}" class="nav-link @yield('trabajador')">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Trabajadores</p>
                        </a>
                    </li>
                    <li class="nav-header">ACCESOS</li>
                    <li class="nav-item">
                        <a href="{{ route('usuarios') }}" class="nav-link @yield('usuario')">
                            <i class="nav-icon far fa-circle text-danger"></i>
                            <p>Usuarios</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('roles') }}" class="nav-link @yield('roles')">
                            <i class="nav-icon far fa-circle text-danger"></i>
                            <p>Roles</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
