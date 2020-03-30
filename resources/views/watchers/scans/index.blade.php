@extends('watchers.layout')

@section('page')
    <div class="list-group">
        @forelse($scans as $scan)
            <div class="list-group-item border-0 shadow-sm d-flex justify-content-between align-items-center">
                <h5 class="mb-0 flex-shrink-1 mr-4 text-muted"># {{ $scan->id }}</h5>

                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <strong>{{ $scan->synchronized }}</strong> objects scanned
                        </div>

                        @if($scan->success)
                            <span class="badge badge-success">Successful</span>
                        @else
                            <span class="badge badge-danger">Error</span>
                        @endif
                    </div>

                    <div class="text-muted d-flex justify-content-between align-items-center">
                        <div>
                            {{ $scan->started_at->format(config('watchdog.notifications.date_format')) }}
                        </div>

                        <div>
                            <i class="fas fa-clock"></i> {{ $scan->completed_at->diffInSeconds($scan->started_at) }} seconds
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="list-group-item border-0 shadow-sm text-muted font-weight-bold">
                No scans have been performed yet.
            </div>
        @endforelse
    </div>

    @if($scans->total() > $scans->perPage())
        <div class="d-flex justify-content-center mt-2">
            {{ $scans->links() }}
        </div>
    @endif
@endsection
