<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SortIcon extends Component
{
    /**
     * The current sorting field.
     *
     * @var string
     */
    public $current;

    /**
     * The sort by field.
     *
     * @var string
     */
    public $field;

    /**
     * The current sort by direction.
     *
     * @var string
     */
    public $direction;

    /**
     * Create a new component instance.
     *
     * @param string $current
     * @param string $field
     * @param string $direction
     *
     * @return void
     */
    public function __construct($current, $field, $direction)
    {
        $this->current = $current;
        $this->field = $field;
        $this->direction = $direction;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.sort-icon');
    }
}
