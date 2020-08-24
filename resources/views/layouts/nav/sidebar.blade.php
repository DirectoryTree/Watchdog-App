<nav class="col-md-4 col-lg-3 col-xl-2 d-md-block bg-light sidebar border-right collapse">
    <div class="d-flex justify-content-center py-4">
        <a href="{{ url('/') }}">
            @include('layouts.nav.logo')
        </a>
    </div>

    <div class="sidebar-sticky">
        @foreach ($watchers as $watcher)
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            Domain - {{ $watcher->name }}
        </h6>

        <ul class="nav flex-column">
            @include('layouts.nav.primary')
        </ul>
        @endforeach

        <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted">
            <span>Admin</span>
        </h6>

        <ul class="nav flex-column mb-2">
            @include('layouts.nav.admin')
        </ul>

        <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted">
            <span>Profile - {{ Auth::user()->name }}</span>
        </h6>

        <ul class="nav flex-column mb-2">
            @include('layouts.nav.auth')
        </ul>
    </div>
</nav>
