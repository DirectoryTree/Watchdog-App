<?php

namespace App\Http\Livewire;

use DatePeriod;
use DateInterval;
use Carbon\Carbon;
use Livewire\Component;

class Calendar extends Component
{
    /**
     * The objects changes.
     *
     * @var \Illuminate\Database\Eloquent\Collection
     */
    public $changes;

    /**
     * Mount the component.
     *
     * @param \Illuminate\Database\Eloquent\Collection $changes
     */
    public function mount($changes)
    {
        $this->changes = $changes;
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.calendar');
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
