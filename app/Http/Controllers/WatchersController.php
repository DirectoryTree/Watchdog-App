<?php

namespace App\Http\Controllers;

use App\Cache\CountCache;
use App\WatchdogRepository;
use DirectoryTree\Watchdog\Watchdog;
use DirectoryTree\Watchdog\LdapWatcher;
use Illuminate\Http\Request;
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
     * @param CountCache  $cache
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(LdapWatcher $watcher, CountCache $cache)
    {
        $watchdogs = (new WatchdogRepository($watcher))
            ->get()
            ->mapWithKeys(function (Watchdog $watchdog) use ($watcher, $cache) {
                $createdToday = $cache->notifications($watcher, $watchdog);

                return [
                    $watchdog->getKey() => [
                        'watchdog' => $watchdog,
                        'today' => $createdToday,
                    ],
                ];
            });

        return view('watchers.show', [
            'watcher' => $watcher,
            'watchdogs' => $watchdogs,
        ]);
    }

    /**
     * Displays the form for editing the watcher.
     *
     * @param LdapWatcher $watcher
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(LdapWatcher $watcher)
    {
        return view('watchers.edit', [
            'watcher' => $watcher,
        ]);
    }

    /**
     * Updates the watcher.
     *
     * @param LdapWatcher $watcher
     * @param Request     $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(LdapWatcher $watcher, Request $request)
    {
        $validated = $request->validate(['name' => 'required']);

        $watcher->update(['name' => $validated['name']]);

        return redirect()->route('watchers.index');
    }

    /**
     * Force a re-scan for watchers.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function scan()
    {
        Artisan::call('watchdog:setup');

        return redirect()->back();
    }
}
