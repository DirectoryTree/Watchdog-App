<div>
    @php
        $start = $this->getStartDate();
        $end = $this->getEndDate();
        $previous = $start->clone()->subMonth()->toDateString();
        $next = $start->clone()->addMonth()->toDateString();
    @endphp

    <div class="row">
        <div class="col">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light d-flex justify-content-between align-items-center border-bottom">
                    <a href="#" class="btn btn-light shadow-sm mb-0">
                        <i class="fas fa-chevron-left"></i>
                    </a>

                    <a href="#" class="btn btn-light shadow-sm mb-0 @if($end->isFuture()) disabled @endif">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>

                <div class="card-body">
                    <div class="row">
                        @php
                            $period = $this->getMonthlyPeriod($start, $end);
                        @endphp

                        @foreach($period as $month)
                            @php
                                $events = $changes->filter(function ($change) use ($month) {
                                    return $month->isSameAs('Y-m', $change->date);
                                });
                            @endphp

                            <div class="col-sm-12 col-md-6 col-lg-4">
                                @include('calendar', ['date' => $month, 'events' => $events])
                            </div>
                        @endforeach
                    </div>

                    @if($day = $this->getSelectedDay())
                        <hr/>

                        <div class="row">
                            <div class="col">
                                <h6 class="text-muted text-uppercase text-center font-weight-bold">
                                    {{ $day->format('F jS Y') }}
                                </h6>

                                <div class="list-group list-group-flush">
                                    <div class="list-group-item">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
