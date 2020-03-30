<?php

namespace App\Http\Controllers;

use DirectoryTree\Watchdog\LdapWatcher;

class WatcherObjectsController extends Controller
{
    public function index(LdapWatcher $watcher)
    {
        return view('watchers.objects.index', [
            'watcher' => $watcher,
            'objects' => $watcher->objects()->roots()->get(),
        ]);
    }
}
