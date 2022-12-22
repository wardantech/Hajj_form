<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="{{route('dashboard')}}">
            <div class="logo-img">
               {{-- <img height="30" src="{{ asset('img/logo_white.png')}}" class="header-brand-img" title="RADMIN"> --}}
               <h6>UNION TOURISM SERVICE</h6>
            </div>
        </a>
        <div class="sidebar-action"><i class="ik ik-arrow-left-circle"></i></div>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    @php
        $route = request()->segment(1);
        $segment2 = request()->segment(2);
        $route  = Route::current()->getName();
    @endphp

    {{-- <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item {{ ($route == 'dashboard') ? 'active' : '' }}">
                    <a href="{{route('dashboard')}}"><i class="ik ik-bar-chart-2"></i><span>{{ __('Dashboard')}}</span></a>
                </div>
                <div class="nav-item {{ ($route == 'users' || $route == 'roles'||$route == 'permission' ||$route == 'user') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-user"></i><span>{{ __('Adminstrator')}}</span></a>
                    <div class="submenu-content">
                        <!-- only those have manage_user permission will get access -->
                        @can('manage_user')
                        <a href="{{url('users')}}" class="menu-item {{ ($route == 'users') ? 'active' : '' }}">{{ __('Users')}}</a>
                        <a href="{{url('user/create')}}" class="menu-item {{ ($route == 'user' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Add User')}}</a>
                         @endcan
                         <!-- only those have manage_role permission will get access -->
                        @can('manage_roles')
                        <a href="{{url('roles')}}" class="menu-item {{ ($route == 'roles') ? 'active' : '' }}">{{ __('Roles')}}</a>
                        @endcan
                        <!-- only those have manage_permission permission will get access -->
                        @can('manage_permission')
                        <a href="{{url('permission')}}" class="menu-item {{ ($route == 'permission') ? 'active' : '' }}">{{ __('Permission')}}</a>
                        @endcan
                    </div>
                </div>
                <div class="nav-item {{ ($route == 'table-datatable-edit') ? 'active' : '' }}">
                    <a href="{{url('table-datatable-edit')}}"><i class="ik ik-layout"></i><span>{{ __('Editable Datatable')}}</span>  </a>

                </div>
        </div>
    </div> --}}
    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item {{ ($route == 'dashboard') ? 'active' : '' }}">
                    {{-- <a href="{{route('dashboard')}}"><i class="ik ik-bar-chart-2"></i><span>{{ __('Dashboard')}}</span></a> --}}
                </div>
                <div class="nav-item {{ ($route == 'package-index') ? 'active' : '' }}">
                    <a href="{{route('package.index')}}"><i class="ik ik-layout"></i><span>{{ __('Package')}}</span>  </a>
                </div>
                <div class="nav-item {{ ($route == 'client.index' ||$route == 'client.create') ? 'active open' : '' }} has-sub">
                    <a href="#"><i class="ik ik-user"></i><span>{{ __('User Info')}}</span></a>
                    <div class="submenu-content">
                        <a href="{{route('client.index')}}" class="menu-item {{ ($route == 'client.index') ? 'active' : '' }}">{{ __('Users List')}}</a>
                        <a href="{{route('client.create')}}" class="menu-item {{ ($route == 'client.create') ? 'active' : '' }}">{{ __('Add User')}}</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
