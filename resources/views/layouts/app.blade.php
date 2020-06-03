@extends('layouts.base')

@inject('cache', 'App\Cache\CountCache)

@push('styles')
    <livewire:styles></livewire:styles>
@endpush

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
                                <i data-feather="home"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('watchers.objects.*') ? 'active' : '' }} d-flex align-items-center" href="{{ route('watchers.objects.index', $watcher) }}">
                                <span class="mr-2">
                                    <i data-feather="package"></i> Objects
                                </span>

                                <span class="badge badge-light border text-muted badge-pill">
                                    <x-large-count :value="$cache->objects($watcher)"/>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('watchers.changes.*') ? 'active' : '' }} d-flex align-items-center" href="{{ route('watchers.changes.index', $watcher) }}">
                                <span class="mr-2">
                                    <i data-feather="refresh-cw"></i> Changes
                                </span>

                                <span class="badge badge-light border text-muted badge-pill">
                                    <x-large-count :value="$cache->changes($watcher)"/>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('watchers.scans.*') ? 'active' : '' }} d-flex align-items-center" href="{{ route('watchers.scans.index', $watcher) }}">
                                <span class="mr-2">
                                    <i data-feather="activity"></i> Scans
                                </span>

                                <span class="badge badge-light border text-muted badge-pill">
                                    <x-large-count :value="$cache->scans($watcher)"/>
                                </span>
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Reports</span>
                        <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                        </a>
                    </h6>

                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                Current month
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                Last quarter
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                Social engagement
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                Year-end sale
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted">
                        <span>Admin</span>
                    </h6>

                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                <i data-feather="users"></i> Users
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted">
                        <span>Profile - {{ Auth::user()->name }}</span>
                    </h6>

                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i data-feather="log-out"></i> Sign Out
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

    <livewire:scripts></livewire:scripts>

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
