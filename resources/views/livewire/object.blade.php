<div class="list-group-item shadow-sm">
    <div class="d-flex justify-content-between align-items-center">
        <div class="flex-shrink-1 mr-2">
            @if($object->type == 'container')
                <a href="#" class="btn btn-sm btn-light shadow-sm" wire:click="loadChildren">
                    <i class="fas fa-{{ $expanded ? 'minus' : 'plus' }}"></i>
                </a>
            @else
                <button class="btn btn-sm btn-light shadow-sm text-muted" disabled>
                    <i class="fas fa-minus"></i>
                </button>
            @endif
        </div>

        <div class="flex-grow-1 d-flex justify-content-between">
            {{ $object->name }}

{{--            <div class="spinner-grow text-primary" role="status">--}}
{{--                <span class="sr-only">Loading...</span>--}}
{{--            </div>--}}
        </div>
    </div>

    @if(count($children) > 0)
        <hr/>

        <h6 class="text-muted">{{ $object->dn }}</h6>

        <div class="list-group mt-2">
            @foreach($children as $child)
                <livewire:watcher-object :watcher="$watcher" :object="$child" :key="$child->id"></livewire:watcher-object>
            @endforeach
        </div>
    @endif
</div>
