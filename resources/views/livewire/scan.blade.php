<div {{ $scan->completed_at || $scan->failed ? '' : 'wire:poll' }} class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-light d-flex justify-content-between">
        <h5 class="mb-0 flex-shrink-1 mr-4 text-muted"># {{ $scan->id }}</h5>

        <div class="d-flex align-items-center">
            @if($scan->completed_at)
                <span class="badge badge-success">Completed</span>
            @elseif($scan->failed)
                <span class="badge badge-danger">Error</span>
            @elseif($scan->started_at)
                <span class="badge badge-warning">Running</span>

                <div class="spinner-border spinner-border-sm ml-2" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            @else
                <span class="badge badge-info">Queued...</span>
            @endif
        </div>
    </div>

    <div class="card-body py-2">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <strong>{{ $scan->imported }}</strong> object(s) scanned.
            </div>

            <div class="text-muted">
                <i class="fas fa-clock"></i>

                @if($scan->failed)
                    <em>N/A</em>
                @else
                    {{ $scan->duration ?? 'Waiting...' }}
                @endif

                @if($scan->completed_at)
                    | Completed on <x-date-time :date="$scan->completed_at"></x-date-time>
                @endif
            </div>
        </div>
    </div>
    @unless($scan->completed_at)
        <div class="card-footer bg-light">
            <ul class="list-group shadow-sm rounded d-flex list-group-horizontal-xl text-center">
                @foreach($this->states as $state => $name)
                    @if($scan->progress->where('state', $state)->isNotEmpty())
                        <li class="list-group-item {{ $scan->failed ? 'bg-danger' : 'bg-success' }} flex-grow-1 p-2">
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

    @if($scan->failed)
        <div class="card-footer bg-light">
            <details>
                <summary>Details</summary>

                <div class="bg-secondary rounded mt-2 p-2">
                    {{ $scan->message }}
                </div>
            </details>
        </div>
    @endif
</div>
