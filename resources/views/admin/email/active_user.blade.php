<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Active</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">Active account</div> <a href="{{ route('home')}}">TicketBooking</a>
                <div class="panel-body">
                    <p class="font-italic">
                        <span>Tên đăng nhập: </span>
                        <span>{{ $user->email }}</span>
                    </p>
                    <p class="font-italic">
                        <span>Mật khẩu: </span>
                        <span>{{ $password }}</span>
                    </p>
                    @if ($user->role != config('setting.user.role.user'))
                        <p class="font-italic">
                            <a href="{{ route('admin.profile') }}">Truy cập link sau để đổi mật khẩu</a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
