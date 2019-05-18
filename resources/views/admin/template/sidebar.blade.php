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
            <li class="treeview {{ getSizeBarActive([
                'company.index',
                'company.show',
            ]) }}">
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    <span>@lang('main.manage_company')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active">
                        <a href="{{ route('company.index') }}">
                            <i class="fa fa-circle-o"></i> @lang('main.companies')
                        </a>
                    </li>
                    {{-- <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li> --}}
                </ul>
            </li>
            <li class="treeview {{ getSizeBarActive([
                'user.index',
                'user.show',
            ]) }}">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>@lang('main.manage_user')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('user.index') }}">
                            <i class="fa fa-circle-o"></i> @lang('main.users')
                        </a>
                    </li>
                    {{-- <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li> --}}
                </ul>
            </li>
            <li class="treeview {{ getSizeBarActive([
                'station.index',
                'station.show',
            ]) }}">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>@lang('main.manage_station')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('station.index') }}">
                            <i class="fa fa-circle-o"></i> @lang('main.stations')
                        </a>
                    </li>
                    {{-- <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li> --}}
                </ul>
            </li>
            <li class="treeview {{ getSizeBarActive([
                'provincial.index',
                'provincial.show',
            ]) }}">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>@lang('main.manage_provincials')</span>
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
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
