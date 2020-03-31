<div {{ $scan->running ? 'wire:poll' : '' }} class="list-group-item border-0 shadow-sm d-flex justify-content-between align-items-center">
    <h5 class="mb-0 flex-shrink-1 mr-4 text-muted"># {{ $scan->id }}</h5>

    <div class="flex-grow-1">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <div>
                <strong>{{ $scan->synchronized }}</strong> objects scanned
            </div>

            @if($scan->running)
                <span class="badge badge-warning">Running</span>
            @elseif($scan->success)
                <span class="badge badge-success">Success</span>
            @else
                <span class="badge badge-danger">Error</span>
            @endif
        </div>

        <div class="text-muted d-flex justify-content-between align-items-center">
            <div>
                {{ $scan->started_at->format(config('watchdog.notifications.date_format')) }}
            </div>

            @if($scan->running)
                <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            @else
                <div>
                    <i class="fas fa-clock"></i> {{ $scan->duration }}
                </div>
            @endif
        </div>

        @unless($scan->success || $scan->running)
            <details class="bg-secondary rounded mt-2 p-2">
                <summary>Details</summary>

                <div class="mt-2">
                    {{ $scan->message }}
                </div>
            </details>
        @endunless
    </div>
</div>
