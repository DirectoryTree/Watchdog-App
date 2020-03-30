<?php

namespace App\Http\Controllers;

use DirectoryTree\Watchdog\Ldap\Transformers\AttributeTransformer;
use DirectoryTree\Watchdog\LdapWatcher;
use Illuminate\Support\Arr;

class WatcherChangesController extends Controller
{
    public function index(LdapWatcher $watcher)
    {
        return view('watchers.changes.index', [
            'watcher' => $watcher,
            'changes' => $watcher->changes()->with('object')->latest()->paginate(10),
        ]);
    }

    public function show(LdapWatcher $watcher, $changeId)
    {
        $change = $watcher->changes()->with('object')->findOrFail($changeId);

        $before = (new AttributeTransformer(
            [$change->attribute => $change->before]
        ))->transform();

        $after = (new AttributeTransformer(
            [$change->attribute => $change->after])
        )->transform();

        return view('watchers.changes.show', [
            'watcher' => $watcher,
            'change' => $change,
            'before' => Arr::first($before),
            'after' => Arr::first($after),
        ]);
    }
}
