<?php

namespace App\Http\Livewire;

use Livewire\Component;
use DirectoryTree\Watchdog\LdapObject;
use DirectoryTree\Watchdog\LdapWatcher;

class WatcherObject extends Component
{
    /**
     * The LDAP watcher.
     *
     * @var LdapWatcher
     */
    public $watcher;

    /**
     * The parent LDAP object.
     *
     * @var LdapObject
     */
    public $object;

    /**
     * Whether a search is being performed.
     *
     * @var bool
     */
    public $searching = false;

    /**
     * Whether the children list is expanded.
     *
     * @var bool
     */
    public $expanded = false;

    /**
     * A collection of direct child objects.
     *
     * @var \Illuminate\Database\Eloquent\Collection|null
     */
    public $children;

    /**
     * Mount the component.
     *
     * @param LdapWatcher $watcher
     * @param LdapObject  $object
     * @param bool        $searching
     *
     * @return void
     */
    public function mount(LdapWatcher $watcher, LdapObject $object, $searching = false)
    {
        $this->watcher = $watcher;
        $this->object = $object;
        $this->children = [];
        $this->searching = $searching;

        if ($this->object->isRoot()) {
            $this->loadChildren();
        }
    }

    /**
     * Load the children of the object.
     *
     * @return void
     */
    public function loadChildren()
    {
        $this->expanded = $this->object->isRoot() ? true : !$this->expanded;
        $this->children = $this->expanded ? $this->object->children()->get() : [];
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.object');
    }
}
