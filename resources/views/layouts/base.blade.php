<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Watchdog') }}</title>

        <!-- Scripts -->
        <script src="{{ asset(mix('js/app.js')) }}" defer data-turbolinks-track="reload"></script>
        <livewire:scripts/>
        @stack('scripts')

        <!-- Styles -->
        <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet" data-turbolinks-track="reload">
        <livewire:styles/>
        @stack('styles')
    </head>
    <body class="h-100">
        @yield('body')
    </body>
</html>
