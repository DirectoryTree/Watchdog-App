<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\WatchdogRepository;
use DirectoryTree\Watchdog\LdapWatcher;

class WatchdogNotificationList extends Component
{
    use WithPagination, Sortable;

    /**
     * The LDAP watcher.
     *
     * @var LdapWatcher
     */
    public $watcher;

    /**
     * The LDAP watchdog key.
     *
     * @var string
     */
    public $watchdogKey;

    /**
     * Mount the component.
     *
     * @param LdapWatcher $watcher
     * @param string      $watchdogKey
     */
    public function mount(LdapWatcher $watcher, $watchdogKey)
    {
        $this->watcher = $watcher;
        $this->watchdogKey = $watchdogKey;
    }

    /**
     * The sortable fields.
     *
     * @return string[]
     */
    protected function sortable()
    {
        return ['created_at'];
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        $watchdog = (new WatchdogRepository($this->watcher))->find($this->watchdogKey);

        $query = $watchdog->notifications()->with('object');

        return view('livewire.watchdog-notification-list', [
            'notifications' => $query->orderBy($this->sortBy, $this->sortByDirection)->paginate(15)
        ]);
    }
}
