<div>
    <div class="mb-2">
        <input type="search" class="form-control shadow-sm" placeholder="Search..." wire:model="search">
    </div>

    <div class="list-group">
        @forelse($objects as $object)
            <livewire:watcher-object :watcher="$watcher" :object="$object" :searching="!empty($search)" :key="$object->id"></livewire:watcher-object>
        @empty
            <div class="list-group-item shadow-sm text-muted font-weight-bold">
                @if($search)
                    No search results.
                @else
                    No objects have been discovered yet.
                @endif
            </div>
        @endforelse
    </div>
</div>
