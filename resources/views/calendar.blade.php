@php($date = isset($date) ? $date->startOfMonth() : now()->startOfMonth())

<table class="calendar m-auto" style="border-spacing:10px;border-collapse: separate;">
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
                            href="#"
                            data-toggle="tooltip"
                            data-placement="top"
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
