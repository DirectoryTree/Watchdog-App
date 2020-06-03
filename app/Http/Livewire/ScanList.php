<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use DirectoryTree\Watchdog\LdapWatcher;

class ScanList extends Component
{
    use WithPagination;

    /**
     * The LDAP watcher to view scans by.
     *
     * @var LdapWatcher
     */
    public $watcher;

    /**
     * The requested scan type.
     *
     * @var string
     */
    public $type;

    /**
     * Mount the component.
     *
     * @param LdapWatcher $watcher
     */
    public function mount(LdapWatcher $watcher)
    {
        $this->watcher = $watcher;
        $this->type = request()->query('type', $this->type);
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        $query = $this->watcher->scans()->with('progress')->latest();

        switch(request('type')) {
            case 'successful':
                $query->whereNotNull('completed_at');
                break;
            case 'error':
                $query->whereNull('completed_at')->whereNotNull('started_at');
                break;
        }

        return view('livewire.scan-list', [
            'scans' => $query->paginate(10)
        ]);
    }

    /**
     * The pagination view to use.
     *
     * @return string
     */
    public function paginationView()
    {
        return 'pagination::bootstrap-4';
    }
}
