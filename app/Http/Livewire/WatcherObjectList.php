<?php

namespace App\Http\Livewire;

use DirectoryTree\Watchdog\LdapWatcher;
use Livewire\Component;

class WatcherObjectList extends Component
{
    public $watcher;

    public $objects;

    public $search;

    public function mount(LdapWatcher $watcher)
    {
        $this->watcher = $watcher;
    }

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
