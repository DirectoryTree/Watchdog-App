@extends('layouts.base')

@section('body')
<div class="h-100">
    <div class="container pt-4">
        <div class="d-flex justify-content-center my-4">
            <img alt="Watchdog logo" width="175" src="{{ asset('img/logo-large.svg') }}"/>
        </div>

        @yield('content')
    </div>
</div>
@endsection
