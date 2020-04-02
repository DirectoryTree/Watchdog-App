<?php

namespace App\Http\Controllers;

use DirectoryTree\Watchdog\Watchdog;
use DirectoryTree\Watchdog\LdapWatcher;

class WatcherDogsController extends Controller
{
    public function show(LdapWatcher $watcher, Watchdog $watchdog)
    {
        $notifications = $watchdog->notifications()
            ->with('object')
            ->latest()
            ->paginate(10);

        return view('watchers.dogs.show', [
            'watcher' => $watcher,
            'watchdog' => $watchdog,
            'notifications' => $notifications,
        ]);
    }
}
