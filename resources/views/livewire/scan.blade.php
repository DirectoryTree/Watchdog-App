<div {{ $scan->completed_at ? '' : 'wire:poll' }} class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-light d-flex justify-content-between">
        <h5 class="mb-0 flex-shrink-1 mr-4 text-muted"># {{ $scan->id }}</h5>

        <div class="d-flex align-items-center">
            @if($scan->completed_at)
                <span class="badge badge-success">Completed</span>
            @elseif($scan->started_at)
                <span class="badge badge-warning">Running</span>

                <div class="spinner-border spinner-border-sm ml-2" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            @elseif($scan->started_at && !$scan->completed_at)
                <span class="badge badge-danger">Error</span>
            @else
                <span class="badge badge-info">Queued...</span>
            @endif
        </div>
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <strong>{{ $scan->imported }}</strong> object(s) scanned.
            </div>

            <div class="text-muted">
                <i class="fas fa-clock"></i> {{ $scan->duration }}

                @if($scan->started_at)
                    on {{ $scan->started_at->format(config('watchdog.notifications.date_format')) }}
                @endif
            </div>
        </div>

        @if($scan->failed)
            <details class="bg-secondary rounded mt-2 p-2">
                <summary>Details</summary>

                <div class="mt-2">
                    {{ $scan->message }}
                </div>
            </details>
        @endif
    </div>
    @unless($scan->completed_at)
        <div class="card-footer bg-light">
            <ul class="list-group shadow-sm rounded d-flex list-group-horizontal-xl text-center">
                @foreach($this->states as $state => $name)
                    @if($scan->progress->where('state', $state)->isNotEmpty())
                        <li class="list-group-item bg-success flex-grow-1 p-2">
                            <i class="fas fa-check-circle"></i> {{ $name }}
                        </li>
                    @else
                        <li class="list-group-item bg-secondary flex-grow-1 p-2">
                            <i class="fas fa-times-circle"></i> {{ $name }}
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endunless
</div>
