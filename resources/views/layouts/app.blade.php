@extends('layouts.base')

@inject('cache', 'App\Cache\CountCache')

@section('body')
    <div up-id="notifications" up-hungry>
        @if (flash()->message)
            <div
                up-flash
                up-data="{{ json_encode(['message' => flash()->message, 'level' => flash()->level]) }}">
            </div>
        @endif
    </div>

    {{ session()->forget('laravel_flash_message') }}

    <div class="container-fluid">
        <div class="row">
            @php($watchers = app(\DirectoryTree\Watchdog\WatcherRepository::class)->all())

            @include('layouts.nav.sidebar')

            <main role="main" class="col-md-8 col-lg-9 col-xl-10 ml-sm-auto py-2 py-md-4 px-md-4">
                <div class="d-block d-md-none mb-2">
                    @include('layouts.nav.mobile')
                </div>

                <div id="content">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
@endsection
