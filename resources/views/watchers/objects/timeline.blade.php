@extends('watchers.objects.layout')

@section('tab')
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <svg class="w-100" preserveAspectRatio="none" height="34" viewBox="0 0 448 34">
                @foreach($days as $index => $day)
                    @php($changesForTheDay = $changes->where('date', '=', $day))

                    <a href="{{ route('watchers.objects.timeline', [$watcher, $object, 'day' => $day]) }}">
                        <rect
                            height="34"
                            width="3"
                            x="{{ $index * 5 }}"
                            y="0"
                            fill="{{ $changesForTheDay->isNotEmpty() ? '#28a745' : '#C3C4C5' }}"
                            class="day-{{ $index }}"
                            title="{{ $day }}"
                            data-toggle="popover"
                            data-content="Changes: {{ $changesForTheDay->sum('count') }}"
                            data-trigger="hover"
                            data-placement="bottom"
                        ></rect>
                    </a>
                @endforeach
            </svg>

            <div class="d-flex justify-content-between text-muted mt-2">
                <span class="d-block">90 days ago</span>

                <span class="d-block">Today</span>
            </div>
        </div>
    </div>

    <livewire:calendar :changes="$changes"></livewire>
@endsection
