@extends('watchers.layout')

@section('breadcrumbs', Breadcrumbs::render('watchers.objects.show', $watcher, $object))

@section('page')
    <div class="list-group list-group-horizontal-md mb-2">
        <a href="{{ route('watchers.objects.show', [$watcher, $object]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center rounded mb-2 mb-md-0 mr-2 shadow-sm border-0 {{ request()->routeIs('watchers.objects.show') ? 'active' : '' }}">
            <h6 class="mb-0">
                <i class="fas fa-info-circle mr-2"></i>
                General
            </h6>
        </a>

        <a href="{{ route('watchers.objects.changes', [$watcher, $object]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center rounded mb-2 mb-md-0 mr-2 shadow-sm border-0 {{ request()->routeIs('watchers.objects.changes') ? 'active' : '' }}">
            <h6 class="mb-0">
                <i class="fas fa-sync mr-2"></i>
                Changes
            </h6>

            <span class="badge badge-primary badge-pill">{{ $object->changes()->count() }}</span>
        </a>

        <a href="{{ route('watchers.objects.timeline', [$watcher, $object]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center rounded mb-2 mb-md-0 mr-2 shadow-sm border-0 {{ request()->routeIs('watchers.objects.timeline') ? 'active' : '' }}">
            <h6 class="mb-0">
                <i class="fas fa-history mr-2"></i>
                Timeline
            </h6>
        </a>

        <a href="{{ route('watchers.objects.notifications', [$watcher, $object]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center rounded mb-2 mb-md-0 mr-2 shadow-sm border-0 {{ request()->routeIs('watchers.objects.notifications') ? 'active' : '' }}">
            <h6 class="mb-0">
                <i class="fas fa-exclamation-circle mr-2"></i>
                Notifications
            </h6>

            <span class="badge badge-primary badge-pill">{{ $object->notifications()->count() }}</span>
        </a>

        <a href="{{ route('watchers.objects.properties', [$watcher, $object]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center rounded mb-2 mb-md-0 shadow-sm border-0 {{ request()->routeIs('watchers.objects.properties') ? 'active' : '' }}">
            <h6 class="mb-0">
                <i class="fas fa-list-ul mr-2"></i>
                Properties
            </h6>

            <span class="badge badge-primary badge-pill">{{ count($object->values) }}</span>
        </a>
    </div>

    <hr/>

    @yield('tab')
@endsection
