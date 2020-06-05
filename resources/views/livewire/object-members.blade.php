<div>
    <div class="row align-items-center mb-2">
        <div class="col">
            <h4 class="mb-0">Members</h4>
        </div>

        <div class="col-auto">
            <div class="form-inline">
                <div class="form-group mb-0 mr-2">
                    <input type="search" wire:model="search" placeholder="Filter..." class="form-control">
                </div>

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="fas fa-sort"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item {{ $sortByDirection == 'asc' ? 'active' : null }}" href="#" wire:click.prevent="sortBy('name', 'asc')">
                            <i class="fas fa-sort-alpha-down"></i> Sort A to Z
                        </a>
                        <a class="dropdown-item {{ $sortByDirection == 'desc' ? 'active' : null }}" href="#" wire:click.prevent="sortBy('name', 'desc')">
                            <i class="fas fa-sort-alpha-up"></i> Sort Z to A
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="list-group">
        @forelse($members as $member)
            <a class="list-group-item list-group-item-action" href="{{ route('watchers.objects.show', [$member->watcher, $member]) }}">
                <x-object-icon :object="$member" class="d-inline text-muted"/> {{ $member->name }}
            </a>
        @empty
            <div class="list-group-item text-muted text-center">
                There are no members of this group.
            </div>
        @endforelse
    </div>

    @if($members->total() > $members->perPage())
        <div class="row d-flex align-items-center mt-4">
            <div class="col-lg">
                {{ $members->links() }}
            </div>

            <div class="col-lg text-right text-muted">
                Showing {{ $members->lastItem() }} out of {{ $members->total() }} results
            </div>
        </div>
    @endif
</div>
