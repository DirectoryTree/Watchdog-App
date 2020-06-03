<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use DirectoryTree\Watchdog\LdapWatcher;

class ChangesList extends Component
{
    use WithPagination, Sortable;

    /**
     * The LDAP watcher.
     *
     * @var LdapWatcher
     */
    public $watcher;

    /**
     * Mount the component.
     *
     * @param LdapWatcher $watcher
     */
    public function mount(LdapWatcher $watcher)
    {
        $this->watcher = $watcher;
    }

    /**
     * The sortable fields.
     *
     * @return string[]
     */
    protected function sortable()
    {
        return ['id', 'name', 'attribute', 'created_at'];
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        $query = $this->watcher->changes()->with('object');

        $query->orderBy($this->sortBy, $this->sortByDirection);

        return view('livewire.changes-list', [
            'changes' => $query->paginate(10),
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
