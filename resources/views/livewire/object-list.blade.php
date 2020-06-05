<div>
    <div class="mb-2">
        <input type="search" wire:model="search" placeholder="Search..." class="form-control">
    </div>

    <div class="list-group">
        @forelse($objects as $object)
            <livewire:watcher-object
                :watcher="$watcher"
                :object="$object"
                :searching="!empty($search)"
                :key="$object->id"
            />
        @empty
            <div class="list-group-item text-muted">
                @if($search)
                    No search results.
                @else
                    No objects have been discovered yet.
                @endif
            </div>
        @endforelse
    </div>
</div>
