<?php

namespace App\Http\Controllers;

use DirectoryTree\Watchdog\LdapWatcher;
use Illuminate\Support\Facades\Artisan;

class WatchersController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('watchers.index', [
            'watchers' => LdapWatcher::get(),
        ]);
    }

    public function show(LdapWatcher $watcher)
    {
        return view('watchers.show', compact('watcher'));
    }

    public function scan()
    {
        Artisan::call('watchdog:setup');

        return redirect()->back();
    }
}
