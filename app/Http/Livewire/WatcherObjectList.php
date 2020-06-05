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
        $query = $this->watcher->objects();

        if ($this->search) {
            $query->with('parent')->where('name', 'like', "%{$this->search}%");
        } else {
            $query->roots();
        }

        return view('livewire.object-list', [
            'objects' => $query->get(),
        ]);
    }
}
