<?php

namespace App\Http\Livewire;

trait Sortable
{
    /**
     * The sort by field.
     *
     * @var string
     */
    public $sortBy = 'id';

    /**
     * The sort by direction.
     *
     * @var string
     */
    public $sortByDirection = 'desc';

    /**
     * The sortable fields.
     *
     * @return array
     */
    abstract protected function sortable();

    /**
     * Sort by the given field.
     *
     * @param string $field
     */
    public function sortBy($field)
    {
        $this->sortBy = in_array($field, $this->sortable()) ? $field : 'created_at';
        $this->sortByDirection = $this->sortByDirection == 'asc' ? 'desc' : 'asc';

        $this->render();
    }
}
