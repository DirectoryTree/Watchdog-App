<div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-light d-flex justify-content-between align-items-center border-bottom">
                    <a href="{{ current_route_filter(['start' => $previous]) }}" title="Previous month" data-turbolinks-scroll class="btn btn-light border mb-0">
                        <i class="fas fa-chevron-left"></i>
                    </a>

                    <a href="{{ current_route_filter(['start' => $next]) }}" title="Next month" data-turbolinks-scroll class="btn btn-light border mb-0 @if($end->isFuture()) disabled @endif">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>

                <div class="card-body">
                    <div class="row">
                        @foreach($period as $month)
                            @php
                                $events = $changes->filter(function ($change) use ($month) {
                                    return $month->isSameAs('Y-m', $change->date);
                                });
                            @endphp

                            <div class="col-sm-12 col-md-6 col-lg-4">
                                @php($date = $month->startOfMonth())

                                <table class="m-auto" style="border-spacing:10px;border-collapse: separate;">
                                    <thead>
                                        <tr>
                                            <th class="text-left" colspan="4">{{ $date->format('F Y') }}</th>
                                            <th class="text-right font-weight-normal text-muted" colspan="3">{{ $events->count() }}</th>
                                        </tr>
                                    </thead>
                                    <thead>
                                        <tr class="text-muted text-center">
                                            <th>M</th>
                                            <th>T</th>
                                            <th>W</th>
                                            <th>T</th>
                                            <th>F</th>
                                            <th>S</th>
                                            <th>S</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            {{-- Day of the week isn't monday, add empty preceding column(s) --}}
                                            @if($date->format('N') != 1)
                                                <td colspan="{{ $date->format('N') - 1 }}"></td>
                                            @endif

                                            {{-- Get the total number of days in the month. --}}
                                            @php($daysInMonth = $date->daysInMonth)

                                            {{-- Go through each day of the month. --}}
                                            @for($i = 1; $i <= $daysInMonth; $i++)
                                                {{-- If we've reached monday, we'll create a new row. --}}
                                                @if($date->format('N') == 1)
                                        </tr>
                                        <tr>
                                            @endif

                                            @php($dateFormatted = $date->format('Y-m-d'))

                                            {{-- Output the day. --}}
                                            @if(($eventsForDay = $events->where('date', '=', $dateFormatted)) && $eventsForDay->isNotEmpty())
                                                <td class="text-center text-secondary bg-success" rel="{{ $dateFormatted }}">
                                                    <div class="small font-weight-bold d-flex justify-content-center align-items-center" style="height:32px;width:32px">

                                                        <a
                                                            href="{{ current_route_filter(['day' => $dateFormatted]) }}"
                                                            data-toggle="tooltip"
                                                            data-placement="top"
                                                            data-turbolinks-scroll
                                                            title="{{ $eventsForDay->sum('count') }} changes"
                                                            data-turbolinks-scroll
                                                        >
                                                            {{ $date->day }}
                                                        </a>
                                                    </div>
                                                </td>
                                            @else
                                                <td class="text-center text-muted bg-secondary" rel="{{ $dateFormatted }}">
                                                    <div class="small d-flex justify-content-center align-items-center" style="height:32px;width:32px">
                                                        {{ $date->day }}
                                                    </div>
                                                </td>
                                            @endif

                                            {{-- Add another day and continue. --}}
                                            @php($date->addDay())
                                            @endfor

                                            {{-- Last date isn't sunday, append empty column(s). --}}
                                            @if($date->format('N') != 7)
                                                <td colspan="{{ (8 - $date->format('N')) }}"></td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($day)
        <hr/>

        <div class="row">
            <div class="col">
                <h6 class="text-muted text-uppercase text-center font-weight-bold">
                    {{ $day->format('F jS Y') }}
                </h6>

                @include('watchers.objects.changes-table', ['watcher' => $watcher, 'changes' => $changesForDay])
            </div>
        </div>
    @endif
</div>
