<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LargeCount extends Component
{
    /**
     * The value to convert to a count.
     * 
     * @var int|float
     */
    protected $value;

    /**
     * The value precision.
     * 
     * @var int
     */
    protected $precision;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($value = 0, $precision = 1)
    {
        $this->value = $value;
        $this->precision = $precision;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $value = $this->value;

        $suffix = '';

        if ($value < 900) {
            // 0 - 900
            $number = number_format($value, $this->precision);
        } else if ($value < 900000) {
            // 0.9k-850k
            $suffix = 'K';
            $number = number_format($value / 1000, $this->precision);
        } else if ($value < 900000000) {
            // 0.9m-850m
            $suffix = 'M';
            $number = number_format($value / 1000000, $this->precision);
        } else if ($value < 900000000000) {
            // 0.9b-850b
            $suffix = 'B';
            $number = number_format($value / 1000000000, $this->precision);
        } else {
            // 0.9t+
            $suffix = 'T';
            $number = number_format($value / 1000000000000, $this->precision);
        }
        
        // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
        // Intentionally does not affect partials, eg "1.50" -> "1.50"
        if ($this->precision > 0) {
            $dotzero = '.' . str_repeat('0', $this->precision);
            $number = str_replace($dotzero, '', $number);
        }

        return "$number $suffix";
    }
}
