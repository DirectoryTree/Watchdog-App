<nav class="navbar navbar-expand-lg navbar-light bg-light rounded border">
    <a class="navbar-brand" href="#">
        @include('layouts.nav.logo')
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile-nav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mobile-nav">
        @foreach ($watchers as $watcher)
        <span class="navbar-text text-uppercase">Domain - {{ $watcher->name }}</span>

        <ul class="navbar-nav mr-auto">
            @include('layouts.nav.primary')
        </ul>
        @endforeach

        <span class="navbar-text text-uppercase">Admin</span>

        <ul class="navbar-nav mr-auto">
            @include('layouts.nav.admin')
        </ul>

        <span class="navbar-text text-uppercase">Profile - {{ Auth::user()->name }}</span>

        <ul class="navbar-nav mr-auto">
            @include('layouts.nav.auth')
        </ul>
    </div>
</nav>
