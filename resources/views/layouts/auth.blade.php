@extends('layouts.base')

@push('scripts')
    <script src="{{ asset(mix('js/app.js')) }}" defer data-turbolinks-track="reload"></script>
@endpush

@push('styles')
    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet" data-turbolinks-track="reload">
@endpush

@section('body')
    <div class="h-100" style="background-image:url('{{ asset('img/background.jpg') }}')">
        <div class="container pt-4">
            <div style="width:175px;" class="my-4 mx-auto">
                <img alt="Watchdog logo" width="175" src="{{ asset('img/logo-large.svg') }}"/>
            </div>

            @yield('content')
        </div>
    </div>
@endsection
