<?php

namespace App\Http\Controllers;

use DirectoryTree\Watchdog\LdapWatcher;

class WatcherScansController extends Controller
{
    public function index(LdapWatcher $watcher)
    {
        return view('watchers.scans.index', [
            'watcher' => $watcher,
        ]);
    }
}
