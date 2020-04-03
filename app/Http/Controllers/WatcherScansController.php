<?php

namespace App\Http\Controllers;

use DirectoryTree\Watchdog\LdapWatcher;
use DirectoryTree\Watchdog\Jobs\ExecuteScan;

class WatcherScansController extends Controller
{
    /**
     * Display all recent scans.
     *
     * @param LdapWatcher $watcher
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(LdapWatcher $watcher)
    {
        return view('watchers.scans.index', [
            'watcher' => $watcher,
        ]);
    }

    /**
     * Force-start a new scan on the watcher.
     *
     * @param LdapWatcher $watcher
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function start(LdapWatcher $watcher)
    {
        ExecuteScan::dispatch($watcher);

        return redirect()->route('watchers.scans.index', $watcher);
    }
}
