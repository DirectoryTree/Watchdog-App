@extends('layouts.base')

@inject('cache', 'App\Cache\CountCache)

@section('body')
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar border-right collapse">
                <div class="d-flex justify-content-center py-4">
                    <a href="{{ url('/') }}">
                        <img alt="Watchdog Logo" width="175" src="{{ asset('img/logo.svg') }}"/>
                    </a>
                </div>

                <div class="sidebar-sticky">
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        Domain - {{ $watcher->name }}
                    </h6>

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('watchers.show') || request()->routeIs('watchers.dogs.*') ? 'active' : '' }} d-flex align-items-center" href="{{ route('watchers.show', $watcher) }}">
                                <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('watchers.objects.*') ? 'active' : '' }} d-flex align-items-center" href="{{ route('watchers.objects.index', $watcher) }}">
                                <span><i class="fas fa-boxes mr-1"></i> Objects</span>

                                <span class="badge badge-light border text-muted badge-pill ml-2">
                                    <x-large-count :value="$cache->objects($watcher)"/>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('watchers.changes.*') ? 'active' : '' }} d-flex align-items-center" href="{{ route('watchers.changes.index', $watcher) }}">
                                <span><i class="fas fa-sync mr-1"></i> Changes</span>

                                <span class="badge badge-light border text-muted badge-pill ml-2">
                                    <x-large-count :value="$cache->changes($watcher)"/>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('watchers.scans.*') ? 'active' : '' }} d-flex align-items-center" href="{{ route('watchers.scans.index', $watcher) }}">
                                <span><i class="fas fa-heartbeat mr-1"></i> Scans</span>

                                <span class="badge badge-light border text-muted badge-pill ml-2">
                                    <x-large-count :value="$cache->scans($watcher)"/>
                                </span>
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted">
                        <span>Admin</span>
                    </h6>

                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                <i class="fas fa-users"></i> Users
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted">
                        <span>Profile - {{ Auth::user()->name }}</span>
                    </h6>

                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Sign Out
                            </a>
                        </li>
                    </ul>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 py-4 px-md-4">
                @yield('content')
            </main>
        </div>
    </div>

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
