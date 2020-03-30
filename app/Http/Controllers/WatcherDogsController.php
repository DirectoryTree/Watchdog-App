<?php

namespace App\Http\Controllers;

use App\WatchdogRepository;
use DirectoryTree\Watchdog\LdapWatcher;

class WatcherDogsController extends Controller
{
    public function show(LdapWatcher $watcher, $name)
    {
        $watchdog = (new WatchdogRepository($watcher))->find($name);

        abort_if(is_null($watchdog), 404);

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
