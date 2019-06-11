<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset(Auth::user()->avatar) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->full_name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> {{ Auth::user()->email }}</a>
            </div>
        </div>
        <!-- search form -->
        {{-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
                </span>
            </div>
        </form> --}}
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            @can('viewList', App\Models\User::class)
                <li class="{{ getSizeBarActive([
                    'admin',
                ]) }}">
                    <a href="{{ route('admin') }}">
                        <i class="fa fa-dashboard"></i>
                        <span>@lang('main.dashboard')</span>
                    </a>
                </li>
            @endcan
            <li class="treeview {{ getSizeBarActive([
                'company.index',
                'company.show',
                'company.create'
            ]) }}">
                <a href="#">
                    <i class="fa fa-building-o"></i>
                    <span>@lang('main.manage_company')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ getSizeBarActive([
                        'company.index',
                        'company.show',
                    ]) }}">
                        <a href="{{ route('company.index') }}">
                            <i class="fa fa-circle-o"></i> @lang('main.companies')
                        </a>
                    </li>
                    @can('viewList', App\Models\Company::class)
                        <li class="{{ getSizeBarActive([
                            'company.create',
                        ]) }}">
                            <a href="{{ route('company.create') }}">
                                <i class="fa fa-circle-o"></i> @lang('main.create')
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
            @can('viewList', App\Models\User::class)
                <li class="treeview {{ getSizeBarActive([
                    'user.index',
                    'user.show',
                    'user.create',
                ]) }}">
                    <a href="#">
                        <i class="fa fa-user-circle-o"></i> <span>@lang('main.manage_user')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ getSizeBarActive([
                            'user.index',
                            'user.show',
                        ]) }}">
                            <a href="{{ route('user.index') }}">
                                <i class="fa fa-circle-o"></i> @lang('main.users')
                            </a>
                        </li>
                        <li class="{{ getSizeBarActive([
                            'user.create',
                        ]) }}">
                            <a href="{{ route('user.create') }}">
                                <i class="fa fa-circle-o"></i> @lang('main.create')
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('viewList', App\Models\Route::class)
                <li class="treeview {{ getSizeBarActive([
                    'route.index',
                    'route.show',
                    'route.create',
                ]) }}">
                    <a href="#">
                        <i class="fa fa-road"></i> <span>@lang('main.manage_route')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ getSizeBarActive([
                                'route.index',
                                'route.show',
                            ]) }}">
                            <a href="{{ route('route.index') }}">
                                <i class="fa fa-circle-o"></i> @lang('main.route')
                            </a>
                        </li>
                        <li class="{{ getSizeBarActive([
                            'route.create',
                        ]) }}">
                            <a href="{{ route('route.create') }}">
                                <i class="fa fa-circle-o"></i> @lang('main.create')
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('viewList', App\Models\Bus::class)
                <li class="treeview {{ getSizeBarActive([
                    'bus.index',
                    'bus.show',
                    'bus.create',
                ]) }}">
                    <a href="#">
                        <i class="fa fa-bus"></i> <span>@lang('main.manage_bus')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ getSizeBarActive([
                            'bus.index',
                            'bus.show',
                        ]) }}">
                            <a href="{{ route('bus.index') }}">
                                <i class="fa fa-circle-o"></i> @lang('main.bus')
                            </a>
                        </li>
                        <li class="{{ getSizeBarActive([
                            'bus.create',
                        ]) }}">
                            <a href="{{ route('bus.create') }}">
                                <i class="fa fa-circle-o"></i> @lang('main.create')
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('viewList', App\Models\Station::class)
                <li class="treeview {{ getSizeBarActive([
                    'station.index',
                    'station.show',
                    'station.create',
                ]) }}">
                    <a href="#">
                        <i class="fa fa-university"></i> <span>@lang('main.manage_station')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ getSizeBarActive([
                            'station.index',
                            'station.show',
                        ]) }}">
                            <a href="{{ route('station.index') }}">
                                <i class="fa fa-circle-o"></i> @lang('main.stations')
                            </a>
                        </li>
                        <li class="{{ getSizeBarActive([
                            'station.create',
                        ]) }}">
                            <a href="{{ route('station.create') }}">
                                <i class="fa fa-circle-o"></i> @lang('main.create')
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('viewList', App\Models\Provincial::class)
                <li class="treeview {{ getSizeBarActive([
                    'provincial.index',
                    'provincial.show',
                    'provincial.create',
                ]) }}">
                    <a href="#">
                        <i class="fa fa-map-marker"></i> <span>@lang('main.manage_provincial')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('provincial.index') }}">
                                <i class="fa fa-circle-o"></i> @lang('main.provincials')
                            </a>
                        </li>
                        {{-- <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li> --}}
                    </ul>
                </li>
            @endcan
            {{-- <li class="treeview {{ getSizeBarActive([
                'ticket.index',
                'ticket.show',
            ]) }}">
                <a href="#">
                    <i class="fa fa-ticket "></i> <span>@lang('main.ticket')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('ticket.index') }}">
                            <i class="fa fa-circle-o"></i> @lang('main.ticket')
                        </a>
                    </li>
                </ul>
            </li> --}}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
