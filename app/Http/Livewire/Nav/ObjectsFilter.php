<?php

namespace App\Http\Livewire\Nav;

use Livewire\Component;
use DirectoryTree\Watchdog\LdapWatcher;

class ObjectsFilter extends Component
{
    /**
     * @var LdapWatcher
     */
    public $watcher;

    /**
     * @var string
     */
    public $search;

    public $added = [];

    public function mount(LdapWatcher $watcher)
    {
        $this->watcher = $watcher;
    }

    public function addObject($guid)
    {
        $this->added[] = $guid;
    }

    public function removeObject($guid)
    {
        $key = array_search($guid, $this->added);

        if ($key !== false) {
            unset($this->added[$key]);
        }
    }

    public function render()
    {
        $query = $this->watcher->objects();

        if ($search = $this->search) {
            $query->where('name', 'like', "%$search%");
        }

        $addedObjects = $this->watcher->objects()
            ->whereIn('guid', $this->added)
            ->get();

        return view('livewire.nav.objects-filter', [
            'objects' => $query->paginate(10),
            'addedObjects' => $addedObjects,
        ]);
    }
}
