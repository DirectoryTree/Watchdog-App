<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use DirectoryTree\Watchdog\LdapWatcher;

class ScanList extends Component
{
    use WithPagination;

    public $watcher;

    public $type;

    public function mount(LdapWatcher $watcher)
    {
        $this->watcher = $watcher;
        $this->type = request()->query('type', $this->type);
    }

    public function render()
    {
        $query = $this->watcher->scans()->latest();

        switch(request('type')) {
            case 'successful':
                $query->where('success', '=', true);
                break;
            case 'error':
                $query->where('success', '=', false);
                break;
        }

        return view('livewire.scan-list', [
            'scans' => $query->paginate(10)
        ]);
    }

    public function paginationView()
    {
        return 'pagination::bootstrap-4';
    }
}
