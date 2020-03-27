<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Watchdog') }}</title>

        <!-- Scripts -->
        @stack('scripts')

        <!-- Styles -->
        @stack('styles')
    </head>
    <body class="h-100">
        @yield('body')
    </body>
</html>
