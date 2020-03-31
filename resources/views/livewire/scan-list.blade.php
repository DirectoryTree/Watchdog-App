<div wire:poll.3s>
    <div class="list-group">
        @forelse($scans as $scan)
            <livewire:scan :scan="$scan" :key="$scan->id"></livewire:scan>
        @empty
            <div class="list-group-item border-0 shadow-sm text-muted font-weight-bold">
                No scans have been performed yet.
            </div>
        @endforelse
    </div>

    @if($scans->total() > $scans->perPage())
        <div class="d-flex justify-content-center mt-2">
            {{ $scans->links() }}
        </div>
    @endif
</div>
