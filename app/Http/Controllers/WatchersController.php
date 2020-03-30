<?php

namespace App\Http\Controllers;

use DirectoryTree\Watchdog\Watchdog;
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

    /**
     * Display stats on the given watcher.
     *
     * @param LdapWatcher $watcher
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(LdapWatcher $watcher)
    {
        $watchdogs = collect(
            config("watchdog.watch.{$watcher->model}", [])
        )->transform(function ($watchdog) {
            return app($watchdog);
        })->mapWithKeys(function (Watchdog $watchdog) {
            $createdToday = $watchdog->notifications()->whereDate('created_at', today())->get();

            return [$watchdog->getName() => $createdToday];
        });

        return view('watchers.show', [
            'watcher' => $watcher,
            'watchdogs' => $watchdogs,
        ]);
    }

    public function scan()
    {
        Artisan::call('watchdog:setup');

        return redirect()->back();
    }
}
