<div class="list-group-item">
    <div class="d-flex justify-content-between align-items-center">
        <div class="flex-shrink-1 mr-2">
            @if(in_array($object->type, ['container', 'domain']))
                <button class="btn btn-sm btn-light" wire:click="loadChildren">
                    @if($expanded)
                        <i data-feather="minus"></i>
                    @else
                        <i data-feather="plus"></i>
                    @endif
                </button>
            @else
                <button class="btn btn-sm text-muted" disabled>
                    <i data-feather="minus"></i>
                </button>
            @endif
        </div>

        <div class="flex-grow-1">
            <div class="d-flex align-items-center">
                <span class="text-muted mr-2">
                    @include('watchers.objects.icon')
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
                <livewire:watcher-object :watcher="$watcher" :object="$child" :key="$child->id"></livewire:watcher-object>
            @endforeach
        </div>
    @endif
</div>
