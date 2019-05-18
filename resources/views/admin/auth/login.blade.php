<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin - TicketBooking</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        {{ Html::style(asset('vendor/bootstrap/dist/css/bootstrap.min.css')) }}
        {{ Html::style(asset('vendor/font-awesome/css/font-awesome.min.css')) }}
        {{ Html::style(asset('admin/css/AdminLTE.min.css')) }}
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page" style="height: auto">
        <div class="login-box">
            <div class="login-logo">
                <a href="/"><b>Ticket</b>BOOKING</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>
                @if(Session::has('message'))
                    <div class="alert alert-danger"> {{ Session::get('message') }}</div>
                @endif
                {{ Form::open(['method' => 'post',  'routes' => 'login']) }}
                    <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                        @if ($errors->has('email'))
                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{ $errors->get('email')[0] }}</label>
                        @endif
                        <input type="email" class="form-control" value="{{ old('email') }}" name="email" placeholder="Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                        @if ($errors->has('password'))
                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{ $errors->get('password')[0] }}</label>
                        @endif
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                {{ Form::close() }}
            </div>
            <!-- /.login-box-body -->
        </div>
        {{ Html::script(asset('vendor/jquery/dist/jquery.min.js')) }}
        {{ Html::script(asset('vendor/bootstrap/dist/js/bootstrap.min.js')) }}
    </body>
</html>
