<?php

namespace App\View\Components;

use Carbon\Carbon;
use Illuminate\View\Component;

class DateTime extends Component
{
    /**
     * The date.
     *
     * @var Carbon
     */
    public $date;

    /**
     * Create a new component instance.
     *
     * @param Carbon $date
     *
     * @return void
     */
    public function __construct(Carbon $date)
    {
        $this->date = $date->setTimezone($this->timezone());
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return $this->date->format($this->format());
    }

    /**
     * Get the watchdog date format.
     *
     * @return string
     */
    protected function format()
    {
        return config('watchdog.date.format', 'F jS, Y @ g:i A');
    }

    /**
     * Get the watchdog timezone.
     *
     * @return string
     */
    protected function timezone()
    {
        return config('watchdog.date.timezone', 'UTC');
    }
}
