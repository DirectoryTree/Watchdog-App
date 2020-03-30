<?php

namespace App\Http\Livewire;

use DirectoryTree\Watchdog\LdapObject;
use DirectoryTree\Watchdog\LdapWatcher;
use Livewire\Component;

class WatcherObject extends Component
{
    public $watcher;

    public $object;

    public $expanded = false;

    public $children;

    public function mount(LdapWatcher $watcher, LdapObject $object)
    {
        $this->watcher = $watcher;
        $this->object = $object;
        $this->children = [];
    }

    public function loadChildren()
    {
        $this->expanded = !$this->expanded;
        $this->children = $this->expanded ? $this->object->children()->get() : [];
    }

    public function render()
    {
        return view('livewire.object');
    }
}
