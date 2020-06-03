<?php

namespace App\Http\Livewire;

use Livewire\Component;
use DirectoryTree\Watchdog\LdapWatcher;

class WatcherObjectList extends Component
{
    /**
     * @var LdapWatcher
     */
    public $watcher;

    /**
     * The LDAP watcher objects.
     *
     * @var \Illuminate\Database\Eloquent\Collection
     */
    public $objects;

    /**
     * The search string.
     *
     * @var string
     */
    public $search;

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
     * Render the component.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        if (empty($this->search)) {
            $this->objects = $this->watcher->objects()->roots()->get();
        } else {
            $this->objects = $this->watcher->objects()
                ->with('parent')
                ->where('name', 'like', "%{$this->search}%")
                ->get();
        }

        return view('livewire.object-list');
    }
}
