<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Ticket Booking</title>
        <meta name="description" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png.htm">
        <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
        <script>
            window.Laravel = {!! json_encode([
                'appName' => config('app.name'),
                'csrfToken' => csrf_token(),
                'locale' => config('app.locale'),
                'url' => url('/'),
                'fallbackLocale' => config('app.fallback_locale'),
                'setting' => config('setting'),
            ]) !!};
            localStorage.setItem('locale', window.Laravel.locale);
        </script>
        {{ Html::style(asset('vendor/jquery-ui-dist/jquery-ui.min.css')) }}
        {{ Html::style(asset('vendor/bootstrap/dist/css/bootstrap.min.css')) }}
        {{ Html::style(asset('vendor/datetimepicker/build/css/bootstrap-datetimepicker.min.css')) }}
        {{ Html::style(asset('vendor/css/normalize.css')) }}
        {{ Html::style(asset('vendor/css/font-awesome.min.css')) }}
        {{ Html::style(asset('vendor/bootstrap-rating/bootstrap-rating.css')) }}
        {{ Html::style(asset('vendor/css/icomoon.css')) }}
        {{ Html::style(asset('vendor/css/owl.carousel.css')) }}
        {{ Html::style(asset('vendor/css/bootstrap-select.css')) }}
        {{ Html::style(asset('vendor/css/scrollbar.css')) }}
        {{ Html::style(asset('vendor/css/jquery.mmenu.all.css')) }}
        {{ Html::style(asset('vendor/css/prettyPhoto.css')) }}
        {{ Html::style(asset('vendor/css/transitions.css')) }}
        {{ Html::style(asset('vendor/css/main.css')) }}
        {{ Html::style(asset('vendor/css/color.css')) }}
        {{ Html::style(asset('vendor/css/responsive.css')) }}
        {{ Html::script(asset('vendor/js/modernizr-2.8.3-respond-1.4.2.min.js')) }}
        <link href="https://unpkg.com/nprogress@0.2.0/nprogress.css" rel="stylesheet" />
    </head>
    <body class="tg-home tg-homevone">
        <div id="app">
            <master-component></master-component>
        </div>
        {{ Html::script(asset('vendor/jquery/dist/jquery.min.js')) }}
        {{ Html::script(asset('vendor/jquery-ui-dist/jquery-ui.min.js')) }}
        {{ Html::script(asset('vendor/bootstrap/dist/js/bootstrap.min.js')) }}
        <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
        {{ Html::script(asset('vendor/js/bootstrap-select.min.js')) }}
        {{ Html::script(asset('vendor/bootstrap-rating/bootstrap-rating.min.js')) }}
        {{ Html::script(asset('vendor/moment/min/moment.min.js')) }}
        {{ Html::script(asset('vendor/datetimepicker/build/js/bootstrap-datetimepicker.min.js')) }}
        {{ Html::script(asset('vendor/scrolltofixed/jquery-scrolltofixed.js')) }}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js"></script>
        {{ Html::script(asset('vendor/js/jquery.mmenu.all.js')) }}
        {{ Html::script(asset('vendor/js/jquery.vide.min.js')) }}
        {{ Html::script(asset('vendor/packery/dist/packery.pkgd.min.js')) }}
        {{ Html::script(asset('vendor/js/scrollbar.min.js')) }}
        {{ Html::script(asset('vendor/js/prettyPhoto.js')) }}
        {{ Html::script(asset('vendor/countdown/countdown.js')) }}
        {{ Html::script(asset('vendor/js/parallax.js')) }}
        {{ Html::script(asset('vendor/js/main.js')) }}
        {{ Html::script(asset('js/app.js')) }}
    </body>
</html>
