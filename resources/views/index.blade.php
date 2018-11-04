<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ env('APP_NAME') }}@yield('tab_title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        @yield('style')

        <!-- JS -->
        @yield('script')
    </head>
    <body>
        <a href="{{  URL::to('auth/google') }}">Login google</a>
        <a href="{{  URL::to('auth/facebook') }}">Login facebook</a>
    </body>
</html>
