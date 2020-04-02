<?php

namespace App\Http\Controllers;

use App\WatchdogRepository;
use DirectoryTree\Watchdog\Ldap\Transformers\AttributeTransformer;
use DirectoryTree\Watchdog\LdapWatcher;

class WatcherObjectsController extends Controller
{
    public function index(LdapWatcher $watcher)
    {
        return view('watchers.objects.index', [
            'watcher' => $watcher,
        ]);
    }

    public function show(LdapWatcher $watcher, $objectId)
    {
        $object = $watcher->objects()->findOrFail($objectId);

        return view('watchers.objects.show',[
            'watcher' => $watcher,
            'object' => $object,
        ]);
    }

    public function properties(LdapWatcher $watcher, $objectId)
    {
        $object = $watcher->objects()->findOrFail($objectId);

        $attributes = new AttributeTransformer($object->values);

        return view('watchers.objects.properties',[
            'watcher' => $watcher,
            'object' => $object,
            'attributes' => $attributes->transform(),
        ]);
    }

    public function changes(LdapWatcher $watcher, $objectId)
    {
        $object = $watcher->objects()->findOrFail($objectId);

        return view('watchers.objects.changes',[
            'watcher' => $watcher,
            'object' => $object,
            'changes' => $object->changes()->latest()->paginate(10),
        ]);
    }

    public function notifications(LdapWatcher $watcher, $objectId)
    {
        $object = $watcher->objects()->findOrFail($objectId);

        $watchdogs = new WatchdogRepository($watcher);

        return view('watchers.objects.notifications',[
            'watcher' => $watcher,
            'object' => $object,
            'watchdogs' => $watchdogs,
            'notifications' => $object->notifications()->latest()->paginate(10),
        ]);
    }
}
