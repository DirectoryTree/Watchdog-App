@extends('watchers.objects.layout')

@section('tab')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted">Total Changes</h6>
                    <h2 class="mb-0">{{ $object->changes()->count() }}</h2>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted">Changes Today</h6>
                    <h2 class="mb-0">{{ $object->changes()->whereDate('created_at', today())->count() }}</h2>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted">Last Change Detected</h6>
                    @if($change = $object->changes()->latest()->first())
                        <h2 class="mb-0">{{ $change->created_at->diffForHumans() }}</h2>
                    @else
                        <h2 class="mb-0">Never</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($object->children()->count() > 0)
        <div class="mb-4">
            <h4>Nested Objects</h4>

            <div class="list-group">
                <livewire:watcher-object
                    :watcher="$watcher"
                    :object="$object"
                    :searching="!empty($search)"
                    :key="$object->id"
                    :expanded="true"
                />
            </div>
        </div>
    @endif

    <div class="row row-cols-1 row-cols-xl-2">
        <div class="col">
            <h4>General</h4>
        </div>

        <div class="col">
            @if($object->type == \DirectoryTree\Watchdog\Ldap\TypeResolver::TYPE_GROUP)
                <livewire:object-members :object="$object"></livewire:object-members>
            @endif
        </div>
    </div>
@endsection
