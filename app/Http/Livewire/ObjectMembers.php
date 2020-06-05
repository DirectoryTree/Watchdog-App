<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use DirectoryTree\Watchdog\LdapObject;

class ObjectMembers extends Component
{
    use WithPagination, Sortable;

    /**
     * The LDAP object.
     *
     * @var LdapObject
     */
    public $object;

    /**
     * The current search.
     *
     * @var string
     */
    public $search;

    /**
     * Mount the component.
     *
     * @param LdapObject $object
     */
    public function mount(LdapObject $object)
    {
        $this->object = $object;
        $this->sortBy = 'name';
        $this->sortByDirection = 'asc';
    }

    /**
     * The sortable fields.
     *
     * @return array
     */
    protected function sortable()
    {
        return ['name'];
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        $query = LdapObject::whereIn('dn', $this->object->values['member'] ?? []);

        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%");
        }

        $query->orderBy($this->sortBy, $this->sortByDirection);

        return view('livewire.object-members', [
            'members' => $query->paginate(10),
        ]);
    }

    /**
     * The pagination view.
     *
     * @return string
     */
    public function paginationView()
    {
        return 'pagination::bootstrap-4';
    }
}
