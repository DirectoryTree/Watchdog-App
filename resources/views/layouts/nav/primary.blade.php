<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('watchers.show') || request()->routeIs('watchers.dogs.*') ? 'active' : '' }} d-flex align-items-center"
       href="{{ route('watchers.show', $watcher) }}">
        <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('watchers.objects.*') ? 'active' : '' }} d-flex align-items-center"
       href="{{ route('watchers.objects.index', $watcher) }}">
        <span><i class="fas fa-boxes mr-1"></i> Objects</span>

        <span class="badge badge-light border text-muted badge-pill ml-2">
            <x-large-count :value="$cache->objects($watcher)"/>
        </span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('watchers.changes.*') ? 'active' : '' }} d-flex align-items-center"
       href="{{ route('watchers.changes.index', $watcher) }}">
        <span><i class="fas fa-sync mr-1"></i> Changes</span>

        <span class="badge badge-light border text-muted badge-pill ml-2">
            <x-large-count :value="$cache->changes($watcher)"/>
        </span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('watchers.scans.*') ? 'active' : '' }} d-flex align-items-center"
       href="{{ route('watchers.scans.index', $watcher) }}">
        <span><i class="fas fa-heartbeat mr-1"></i> Scans</span>

        <span class="badge badge-light border text-muted badge-pill ml-2">
            <x-large-count :value="$cache->scans($watcher)"/>
        </span>
    </a>
</li>
