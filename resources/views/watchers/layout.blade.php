@extends('layouts.app')

@inject('cache', 'App\Cache\CountCache)

@section('content')
    <h2>{{ $watcher->name }}</h2>

    <div class="list-group list-group-horizontal-md mb-2">
        <a href="{{ route('watchers.show', $watcher) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center rounded mb-2 mb-md-0 mr-2 shadow-sm border-0 {{ request()->routeIs('watchers.show') ? 'active' : '' }}">
            <h5 class="mb-0">
                <i class="fas fa-tachometer-alt mr-2"></i>
                Dashboard
            </h5>
        </a>

        <a href="{{ route('watchers.objects.index', $watcher) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center rounded mb-2 mb-md-0 mr-2 shadow-sm border-0 {{ request()->routeIs('watchers.objects.*') ? 'active' : '' }}">
            <h5 class="mb-0">
                <i class="fas fa-cube mr-2"></i>
                Objects
            </h5>

            <span class="badge badge-primary badge-pill">{{ $cache->objects($watcher) }}</span>
        </a>

        <a href="{{ route('watchers.changes.index', $watcher) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center rounded mb-2 mb-md-0 mr-2 shadow-sm border-0 {{ request()->routeIs('watchers.changes.*') ? 'active' : '' }}">
            <h5 class="mb-0">
                <i class="fas fa-sync mr-2"></i>
                Changes
            </h5>

            <span class="badge badge-primary badge-pill">{{ $cache->changes($watcher) }}</span>
        </a>

        <a href="{{ route('watchers.scans.index', $watcher) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center rounded mb-2 mb-md-0 shadow-sm border-0 {{ request()->routeIs('watchers.scans.*') ? 'active' : '' }}">
            <h5 class="mb-0">
                <i class="fas fa-search mr-2"></i>
                Scans
            </h5>

            <span class="badge badge-primary badge-pill">{{ $cache->scans($watcher) }}</span>
        </a>
    </div>

    <hr/>

    @yield('breadcrumbs')

    <div class="row">
        <div class="col-md-12">
            @yield('page')
        </div>
    </div>
@endsection
