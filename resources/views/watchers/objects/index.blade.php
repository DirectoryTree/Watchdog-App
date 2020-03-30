@extends('watchers.layout')

@section('page')
    <div class="list-group">
        @forelse($objects as $object)
            <livewire:watcher-object :watcher="$watcher" :object="$object" :key="$object->id"></livewire:watcher-object>
        @empty
            <div class="list-group-item shadow-sm text-muted font-weight-bold">
                No objects have been discovered yet.
            </div>
        @endforelse
    </div>
@endsection
