<div wire:poll.3s>
    <div class="d-flex justify-content-between mb-4">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link {{ empty(request('type')) ? 'border rounded disabled' : '' }}" href="{{ route('watchers.scans.index', $watcher) }}">All</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request('type') == 'successful' ? 'border rounded disabled' : '' }}" href="{{ route('watchers.scans.index', ['watcher' => $watcher, 'type' => 'successful']) }}">Successful</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request('type') == 'error' ? 'border rounded disabled' : '' }}" href="{{ route('watchers.scans.index', ['watcher' => $watcher, 'type' => 'error']) }}">Errors</a>
            </li>
        </ul>

        <form method="post" action="{{ route('watchers.scans.start', $watcher) }}">
            @csrf

            <button type="submit" class="btn btn-primary shadow-sm">
                <i class="fas fa-search"></i> Scan Now
            </button>
        </form>
    </div>

    @forelse($scans as $scan)
        <livewire:scan :scan="$scan" :key="$scan->id"></livewire:scan>
    @empty
        <div class="list-group">
            <div class="list-group-item border-0 shadow-sm text-muted font-weight-bold">
                No scans have been performed yet.
            </div>
        </div>
    @endforelse

    @if($scans->total() > $scans->perPage())
        <div class="d-flex justify-content-center mt-2">
            {{ $scans->links() }}
        </div>
    @endif
</div>

