@extends('layouts.base')

@push('scripts')
    <script src="{{ asset(mix('js/app.js')) }}"></script>
@endpush

@push('styles')
{{--    <livewire:styles></livewire:styles>--}}
    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
@endpush

@section('body')
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img alt="Watchdog Logo" width="175" src="{{ asset('img/logo.svg') }}"/>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#app-nav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="app-nav">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fa fa-sign-in-alt"></i>
                                {{ __('Login') }}
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa fa-user-circle"></i>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out-alt"></i> {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

{{--    <livewire:scripts></livewire:scripts>--}}

{{--    @foreach (session('flash_notification', collect())->toArray() as $message)--}}
{{--        <script>--}}
{{--            Swal.fire({--}}
{{--                type: "{{ $message['level'] }}",--}}
{{--                title: "{{ $message['message'] }}",--}}
{{--            });--}}
{{--        </script>--}}
{{--    @endforeach--}}

{{--    {{ session()->forget('flash_notification') }}--}}

{{--    <script>--}}
{{--        window.livewire.on('notification', (notification) => {--}}
{{--            Swal.fire({--}}
{{--                type: notification.type,--}}
{{--                title: notification.title,--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endsection
