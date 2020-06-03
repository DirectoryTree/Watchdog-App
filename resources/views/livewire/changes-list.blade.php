<div>
    <div class="table-responsive bg-white border rounded">
        <table class="table mb-0">
            <thead>
                <tr class="text-uppercase text-muted bg-secondary">
                    <th class="text-center">
                        <a href="#" class="d-flex align-items-center justify-content-center" wire:click.prevent="sortBy('id')">
                            # ID

                            <x-sort-icon field="id" :current="$sortBy" :direction="$sortByDirection"/>
                        </a>
                    </th>
                    <th>
                        <a href="#" class="d-flex align-items-center" wire:click.prevent="sortBy('name')">
                            <i data-feather="box" width="20"></i>

                            <span class="mx-1">Object</span>

                            <x-sort-icon field="name" :current="$sortBy" :direction="$sortByDirection"/>
                        </a>
                    </th>
                    <th>
                        <a href="#" class="d-flex align-items-center" wire:click.prevent="sortBy('attribute')">
                            Attribute

                            <x-sort-icon field="attribute" :current="$sortBy" :direction="$sortByDirection"/>
                        </a>
                    </th>
                    <th>
                        <a href="#" class="d-flex align-items-center" wire:click.prevent="sortBy('created_at')">
                            <i data-feather="clock" width="20"></i>

                            <span class="mx-1">Detected</span>

                            <x-sort-icon field="created_at" :current="$sortBy" :direction="$sortByDirection"/>
                        </a>
                    </th>
                    <th></th>
                </tr>
            </thead>

            @forelse($changes as $change)
                <tr>
                    <td class="align-middle text-center">{{ $change->id }}</td>
                    <td class="align-middle">
                        <a href="{{ route('watchers.objects.show',[$watcher, $change->object]) }}">
                            {{ $change->object->name }}
                        </a>
                    </td>
                    <td class="align-middle">{{ $change->attribute }}</td>
                    <td class="align-middle">
                        <x-date-time :date="$change->created_at"/>
                    </td>
                    <td class="align-middle text-center">
                        <a href="{{ route('watchers.changes.show', [$watcher, $change]) }}" class="btn btn-sm btn-light border">
                            View
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-muted font-weight-bold">
                        No changes have been recorded yet.
                    </td>
                </tr>
            @endforelse
        </table>
    </div>

    @if($changes->total() > $changes->perPage())
        <div class="row d-flex align-items-center mt-4">
            <div class="col-lg">
                {{ $changes->links() }}
            </div>

            <div class="col-lg text-right text-muted">
                Showing {{ $changes->lastItem() }} out of {{ $changes->total() }} results
            </div>
        </div>
    @endif
</div>
