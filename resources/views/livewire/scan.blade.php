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

                @if($scan->completed_at)
                    {{ $scan->duration }} | Completed <x-date-time :date="$scan->completed_at"/>
                @elseif($scan->failed)
                    <em>N/A</em>
                @else
                    {{ $scan->duration ?? 'Waiting...' }}
                @endif
             </div>
         </div>
     </div>

     @unless($scan->completed_at)
         <div class="card-footer bg-light">
             <div class="progress">
                 @php
                     $totalStates = count($this->states);

                     $currentStates = $scan->progress->count();

                     $percent = round(intval(($currentStates / $totalStates) * 100), -1);

                     $value = $percent > 100 ? 100 : $percent;
                 @endphp

                 <div class="progress-bar" role="progressbar" style="width: {{ $value }}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                    {{ $value }}% - {{ $this->states[$scan->progress->last()->state] ?? '' }}
                </div>
            </div>
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
