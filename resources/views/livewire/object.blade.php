<div class="list-group-item shadow-sm">
    <div class="d-flex justify-content-between align-items-center">
        <div class="flex-shrink-1 mr-2">
            @if($object->type == 'container')
                <button class="btn btn-sm btn-light shadow-sm" wire:click="loadChildren">
                    <i class="fas fa-{{ $expanded ? 'minus' : 'plus' }}"></i>
                </button>
            @else
                <button class="btn btn-sm btn-light shadow-sm text-muted" disabled>
                    <i class="fas fa-minus"></i>
                </button>
            @endif
        </div>

        <div class="flex-grow-1">
            @include('watchers.objects.icon')

            <a href="{{ route('watchers.objects.show', [$watcher, $object]) }}">
                {{ $object->name }}
            </a>

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
        <hr/>

        <div class="list-group mt-2">
            @foreach($children as $child)
                <livewire:watcher-object :watcher="$watcher" :object="$child" :key="$child->id"></livewire:watcher-object>
            @endforeach
        </div>
    @endif
</div>
