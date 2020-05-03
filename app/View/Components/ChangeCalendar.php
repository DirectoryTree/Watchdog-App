<?php

namespace App\View\Components;

use DatePeriod;
use DateInterval;
use Carbon\Carbon;
use DirectoryTree\Watchdog\LdapWatcher;
use Illuminate\View\Component;

class ChangeCalendar extends Component
{
    /**
     * @var LdapWatcher
     */
    public $watcher;

    /**
     * @var \Carbon\CarbonInterface
     */
    public $start;

    /**
     * @var \Carbon\CarbonInterface
     */
    public $end;

    /**
     * The Y-M-D of the month previous to the start date.
     *
     * @var string
     */
    public $previous;

    /**
     * The Y-M-D of the month after the start date.
     *
     * @var string
     */
    public $next;

    /**
     * @var DatePeriod
     */
    public $period;

    /**
     * @var Carbon|null
     */
    public $day;

    /**
     * @var \Illuminate\Support\Collection
     */
    public $changes;

    /**
     * @var \Illuminate\Support\Collection
     */
    public $changesForDay;

    /**
     * Create a new component instance.
     *
     * @param LdapWatcher                    $watcher
     * @param \Illuminate\Support\Collection $changes
     * @param \Illuminate\Support\Collection $changesForDay
     *
     * @throws \Exception
     */
    public function __construct(LdapWatcher $watcher, $changes, $changesForDay)
    {
        $this->watcher = $watcher;
        $this->changes = $changes;
        $this->changesForDay = $changesForDay;
        $this->start = $this->getStartDate();
        $this->end = $this->getEndDate();
        $this->previous = $this->start->clone()->subMonth()->toDateString();
        $this->next = $this->start->clone()->addMonth()->toDateString();
        $this->period = $this->getMonthlyPeriod($this->start, $this->end);
        $this->day = $this->getSelectedDay();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.change-calendar');
    }

    /**
     * Get the start date.
     *
     * @return \Carbon\CarbonInterface
     *
     * @throws \Exception
     */
    public function getStartDate()
    {
        // We must use the start of the month to ensure all changes
        // for the entire calendar range are queried for.
        $date = request('start', now()->subMonths(2)->startOfMonth());

        return $date instanceof Carbon ? $date : new Carbon($date);
    }

    /**
     * Get the end date.
     *
     * @return \Carbon\CarbonInterface
     *
     * @throws \Exception
     */
    public function getEndDate()
    {
        return $this->getStartDate()->addMonths(3);
    }

    /**
     * Get the selected day.
     *
     * @return Carbon|null
     *
     * @throws \Exception
     */
    public function getSelectedDay()
    {
        if ($this->hasSelectedDay()) {
            return new Carbon(request('day'));
        }
    }

    /**
     * Determine if a day has been selected.
     *
     * @return bool
     */
    public function hasSelectedDay()
    {
        return request()->has('day');
    }

    /**
     * Get the monthly period for the given range.
     *
     * @param \Carbon\CarbonInterface $start
     * @param \Carbon\CarbonInterface $end
     *
     * @return DatePeriod
     *
     * @throws \Exception
     */
    public function getMonthlyPeriod($start, $end)
    {
        return new DatePeriod($start, new DateInterval('P1M'), $end);
    }
}
