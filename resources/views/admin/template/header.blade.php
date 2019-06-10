<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin - TicketBooking</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    {{ Html::style(asset('vendor/bootstrap/dist/css/bootstrap.min.css')) }}
    <!-- Font Awesome -->
    {{ Html::style(asset('vendor/font-awesome/css/font-awesome.min.css')) }}
    {{ Html::style(asset('vendor/datetimepicker/build/css/bootstrap-datetimepicker.min.css')) }}
    {{ Html::style(asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')) }}
    {{ Html::style(asset('vendor/select2/dist/css/select2.min.css')) }}
    {{ Html::style(asset('vendor/icheck/skins/all.css')) }}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.0/css/ionicons.css" />
    {{ Html::style(asset('admin/css/AdminLTE.css')) }}
    {{ Html::style(asset('admin/css/skins/_all-skins.min.css')) }}
    {{ Html::style(asset('admin/css/style.css')) }}
    {{ Html::style(asset('vendor/file-upload-with-preview/dist/file-upload-with-preview.min.css')) }}
    {{ Html::script(asset('vendor/file-upload-with-preview/dist/file-upload-with-preview.min.js')) }}
    @stack('style')
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="{{ route('admin') }}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>T</b>B</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Ticket</b>Admin</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown notifications-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning number-notify">{{ Auth::user()->unreadNotifications->count() }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                        <ul class="menu">
                                            @foreach (Auth::user()->notifications as $notification)
                                                @php
                                                    $data = $notification->data;
                                                @endphp
                                                <li class="{{ $notification->read_at ? '' : 'unread' }}">
                                                    <a href="{{ route('ticket.show', [$data['ticket_id'], 'notification' => $notification->id]) }}">
                                                        <i class="fa fa-ticket text-aqua"></i> <strong class="notification-title">{{ $data['title'] }}</strong>
                                                        {{ $data['content'] }}<br>
                                                        <small>{{ $data['created_at'] }}</small>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @if (Auth::user()->notifications->count())
                                        <li class="footer"><a href="#">Xem tất cả</a></li>
                                    @else
                                        <li class="footer"><a href="#">Không có thông báo nào</a></li>
                                    @endif
                                </ul>
                            </li>
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="{{ asset(Auth::user()->avatar) }}" class="user-image" alt="User Image">
                                    <span class="hidden-xs">{{ Auth::user()->full_name }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="{{ asset(Auth::user()->avatar) }}" class="img-circle" alt="User Image">
                                        <p>
                                            {{ Auth::user()->full_name }}
                                            <small>{{ Auth::user()->email }}</small>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="{{ route('admin.profile') }}" class="btn btn-default btn-flat">@lang('main.profile')</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="{{ route('logout') }}" class="btn btn-default btn-flat">@lang('main.logout')</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            {{-- <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li> --}}
                        </ul>
                    </div>
                </nav>
            </header>
            <style>
                .dropdown-menu .menu .unread {
                    background: #e0e0e0;
                }
            </style>
