@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Watchers</h2>

                <form method="post" action="{{ route('watchers.scan') }}">
                    @csrf

                    <button type="submit" class="btn btn-primary shadow-sm">
                        Scan for new watchers
                    </button>
                </form>
            </div>

            @forelse($watchers as $watcher)
                <div class="card shadow-sm mb-4">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">{{ \Illuminate\Support\Str::studly($watcher->name) }}</h4>

                                <a href="{{ route('watchers.show', $watcher) }}" class="btn btn-light shadow-sm stretched-link">
                                    View
                                </a>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <h5 class="text-muted">{{ $watcher->changes()->count() }} total changes.</h5>
                        </div>

                        <div class="list-group-item">
                            <h5 class="text-muted">{{ $watcher->scans()->count() }} total scans.</h5>
                        </div>

                        <div class="list-group-item">
                            <h5 class="text-muted">{{ $watcher->objects()->count() }} total objects.</h5>
                        </div>
                    </div>
                </div>
            @empty
                <div class="list-group-item rounded shadow-sm text-muted font-weight-bold">
                    No watchers have been added yet.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
