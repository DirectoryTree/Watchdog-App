@extends('layouts.app')

@section('content')
    @yield('header')

    @yield('breadcrumbs')

    <div class="row">
        <div class="col-md-12">
            @yield('page')
        </div>
    </div>
@endsection
