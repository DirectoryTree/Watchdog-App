<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Navbar extends Component
{
    /**
     * The ID of the navbar.
     *
     * @var string
     */
    public $id;

    /**
     * The title of the navbar.
     *
     * @var string
     */
    public $title;

    /**
     * Create a new component instance.
     *
     * @param $id
     * @param $title
     *
     * @return void
     */
    public function __construct($id, $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.navbar');
    }
}
