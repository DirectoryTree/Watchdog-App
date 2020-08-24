@extends('watchers.layout')

@section('header')
    <h2>Objects</h2>
@endsection

@section('page')
    <div>
        <div class="mb-2">
            <form method="get" action="{{ route('watchers.objects.index', $watcher) }}" up-target="#objects" up-restore-scroll>
                <input type="search" name="search" value="{{ request('search') }}" placeholder="Search..." autofocus class="form-control" up-autosubmit up-delay="500">
            </form>
        </div>

        <div class="list-group" id="objects">
            @forelse($objects as $object)
                <x-watcher-object :watcher="$watcher" :object="$object" :opened="$opened"/>
            @empty
                <div class="list-group-item text-muted">
                    @if(request('search'))
                        No search results.
                    @else
                        No objects have been discovered yet.
                    @endif
                </div>
            @endforelse
        </div>
    </div>
@endsection
