<?php

namespace App\Http\Controllers;

use DirectoryTree\Watchdog\Ldap\Transformers\AttributeTransformer;
use DirectoryTree\Watchdog\LdapWatcher;
use Illuminate\Support\Arr;

class WatcherChangesController extends Controller
{
    /**
     * Displays a list of all the watchers detected changes.
     *
     * @param LdapWatcher $watcher
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(LdapWatcher $watcher)
    {
        return view('watchers.changes.index', ['watcher' => $watcher]);
    }

    /**
     * Displays the specified change detected by the watcher.
     *
     * @param LdapWatcher $watcher
     * @param int         $changeId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(LdapWatcher $watcher, $changeId)
    {
        $change = $watcher->changes()->with('object')->findOrFail($changeId);

        $before = (new AttributeTransformer(
            [$change->attribute => $change->before]
        ))->transform();

        $after = (new AttributeTransformer(
            [$change->attribute => $change->after])
        )->transform();

        $removed = array_diff($before[$change->attribute], $after[$change->attribute]);
        $added = array_diff($after[$change->attribute], $before[$change->attribute]);

        return view('watchers.changes.show', [
            'watcher' => $watcher,
            'change' => $change,
            'before' => Arr::first($before),
            'after' => Arr::first($after),
            'removed' => $removed,
            'added' => $added,
        ]);
    }
}
