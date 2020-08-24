<div id="object-{{ $object->id }}" class="list-group-item">
    <div class="d-flex justify-content-between align-items-center">
        <div class="flex-shrink-1 mr-2">
            @if(in_array($object->type, ['container', 'domain']))
                @if($opened)
                    <button class="btn btn-sm btn-light" up-target="#object-{{ $object->id }}" up-history="false" up-href="{{ route('components.watchers.objects.tree', [$watcher, $object, 'opened' => false]) }}">
                        <i class="fas fa-minus"></i>
                    </button>
                @else
                    <button class="btn btn-sm btn-light" up-target="#object-{{ $object->id }}" up-history="false" up-href="{{ route('components.watchers.objects.tree', [$watcher, $object, 'opened' => true]) }}">
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
                    <x-object-icon :object="$object"/>
                </span>

                <a href="{{ route('watchers.objects.show', [$watcher, $object]) }}">
                    {{ $object->name }}
                </a>
            </div>

            <div class="overflow-auto">
                @if(request('search') && $object->parent)
                    <small class="text-muted">
                        ({{ $object->parent->dn }})
                    </small>
                @endif
            </div>
        </div>
    </div>

    @if(isset($children) && count($children) > 0)
        <div class="list-group mt-2">
            @foreach($children as $child)
                <x-watcher-object :watcher="$watcher" :object="$child"/>
            @endforeach
        </div>
    @endif
</div>
