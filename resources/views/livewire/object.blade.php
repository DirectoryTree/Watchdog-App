<div class="list-group-item">
    <div class="d-flex justify-content-between align-items-center">
        <div class="flex-shrink-1 mr-2">
            @if(in_array($object->type, ['container', 'domain']))
                @if($expanded)
                    <button class="btn btn-sm btn-light" wire:click="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                @else
                    <button class="btn btn-sm btn-light" wire:click="expand">
                        <i class="fas fa-plus"></i>
                    </button>
                @endif
            @else
                <button class="btn btn-sm text-muted" disabled>
                    <i class="fas fa-minus"></i>
                </button>
            @endif
        </div>

        <div class="flex-grow-1">
            <div class="d-flex align-items-center">
                <span class="text-muted mr-2">
                    <x-object-icon :object="$object" width="20" width="20"/>
                </span>

                <a href="{{ route('watchers.objects.show', [$watcher, $object]) }}">
                    {{ $object->name }}
                </a>
            </div>

            <div class="overflow-auto">
                @if($searching && $object->parent)
                    <small class="text-muted">
                        ({{ $object->parent->dn }})
                    </small>
                @endif
            </div>
        </div>
    </div>

    @if(count($children) > 0)
        <div class="list-group mt-2">
            @foreach($children as $child)
                <livewire:watcher-object
                    :watcher="$watcher"
                    :object="$child"
                    :key="$child->id"
                />
            @endforeach
        </div>
    @endif
</div>
