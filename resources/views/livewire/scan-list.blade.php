<div class="row" wire:poll.3s>
    <div class="col-md-2">
        <div class="list-group border-0 mb-4">
            <a href="{{ route('watchers.scans.index', $watcher) }}" class="list-group-item list-group-item-action shadow-sm {{ empty(request('type')) ? 'active' : '' }}">
                <i class="fas fa-list-ul"></i> All
            </a>

            <a href="{{ route('watchers.scans.index', ['watcher' => $watcher, 'type' => 'error']) }}" class="list-group-item list-group-item-action shadow-sm {{ request('type') == 'error' ? 'active' : '' }}">
                <i class="fas fa-times-circle"></i> Errors
            </a>

            <a href="{{ route('watchers.scans.index', ['watcher' => $watcher, 'type' => 'successful']) }}" class="list-group-item list-group-item-action shadow-sm {{ request('type') == 'successful' ? 'active' : '' }}">
                <i class="fas fa-check-circle"></i> Successful
            </a>
        </div>

        <form method="post" action="{{ route('watchers.scans.start', $watcher) }}">
            @csrf

            <button type="submit" class="btn btn-block btn-primary shadow-sm">
                <i class="fas fa-search"></i> Scan Now
            </button>
        </form>
    </div>

    <div class="col-md-10">
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
</div>

