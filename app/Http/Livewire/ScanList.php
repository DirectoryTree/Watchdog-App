<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use DirectoryTree\Watchdog\LdapWatcher;

class ScanList extends Component
{
    use WithPagination;

    public $watcher;

    public function paginationView()
    {
        return 'pagination::bootstrap-4';
    }

    public function mount(LdapWatcher $watcher)
    {
        $this->watcher = $watcher;
    }

    public function render()
    {
        return view('livewire.scan-list', [
            'scans' => $this->watcher->scans()->latest()->paginate(10)
        ]);
    }
}
