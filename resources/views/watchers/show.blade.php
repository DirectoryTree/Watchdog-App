@extends('watchers.layout')

@section('page')
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3">
        @forelse($watchdogs as $entry)
            <div class="col mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">{{ $entry['watchdog']->getName() }}</h6>

                        <h1 class="mb-0 d-inline">
                            {{ $entry['today']->count() }}
                        </h1>

                        <h4 class="mb-0 d-inline text-muted">today</h4>
                    </div>

                    <div class="card-footer border-0">
                        <a href="{{ route('watchers.dogs.show', [$watcher, $entry['watchdog']->getKey()]) }}">View all</a>
                    </div>
                </div>
            </div>
        @empty

        @endforelse
    </div>
@endsection
