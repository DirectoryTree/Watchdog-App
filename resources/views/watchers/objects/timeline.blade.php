@extends('watchers.objects.layout')

@section('tab')
    <div class="card mb-4">
        <div class="card-body">
            <svg class="w-100" preserveAspectRatio="none" height="34" viewBox="0 0 448 34">
                @foreach($days as $index => $day)
                    @php($changesForTheDay = $changes->where('date', '=', $day))

                    <a href="{{ current_route_filter(['day' => $day]) }}" title="{{ $day }}" data-turbolinks-scroll>
                        <rect
                            height="34"
                            width="3"
                            x="{{ $index * 5 }}"
                            y="0"
                            fill="{{ $changesForTheDay->isNotEmpty() ? '#28a745' : '#C3C4C5' }}"
                            class="day-{{ $index }}"
                            data-toggle="popover"
                            data-content="{{ $changesForTheDay->sum('count') }} changes"
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

    <x-change-calendar
        :watcher="$watcher"
        :changes="$changes"
        :changes-for-day="$changesForDay"
    />
@endsection
