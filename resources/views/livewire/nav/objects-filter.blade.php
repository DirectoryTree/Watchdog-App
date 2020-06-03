<div>
    <input wire:model="search" type="search" class="form-control" placeholder="Search..." autofocus>

    <hr/>

    <div class="list-group">
        @forelse($objects as $object)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <span class="d-block">
                    @include('watchers.objects.icon') {{ $object->name }}
                </span>

                @if($addedObjects->where('guid', $object->guid)->isNotEmpty())
                    <button wire:click.prevent="removeObject('{{ $object->guid }}')" class="btn btn-light shadow-sm">
                        Remove
                    </button>
                @else
                    <button wire:click.prevent="addObject('{{ $object->guid }}')" class="btn btn-light shadow-sm">
                        Add
                    </button>
                @endif
            </div>
        @empty
            <div class="list-group-item">
                @if($search) No results. @else No objects. @endif
            </div>
        @endforelse
    </div>
</div>
