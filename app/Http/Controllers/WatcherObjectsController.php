<?php

namespace App\Http\Controllers;

use App\WatchdogRepository;
use DirectoryTree\Watchdog\Ldap\Transformers\AttributeTransformer;
use DirectoryTree\Watchdog\LdapWatcher;

class WatcherObjectsController extends Controller
{
    /**
     * Displays a list of all of the watchers objects.
     *
     * @param LdapWatcher $watcher
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(LdapWatcher $watcher)
    {
        return view('watchers.objects.index', ['watcher' => $watcher]);
    }

    /**
     * Displays a summary page of the object.
     *
     * @param LdapWatcher $watcher
     * @param int         $objectId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(LdapWatcher $watcher, $objectId)
    {
        $object = $watcher->objects()->findOrFail($objectId);

        return view('watchers.objects.show',[
            'watcher' => $watcher,
            'object' => $object,
        ]);
    }

    /**
     * Displays the objects properties.
     *
     * @param LdapWatcher $watcher
     * @param int         $objectId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * Displays the objects changes.
     *
     * @param LdapWatcher $watcher
     * @param int         $objectId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changes(LdapWatcher $watcher, $objectId)
    {
        $object = $watcher->objects()->findOrFail($objectId);

        return view('watchers.objects.changes',[
            'watcher' => $watcher,
            'object' => $object,
            'changes' => $object->changes()->latest()->paginate(10),
        ]);
    }

    /**
     * Displays the objects notifications.
     *
     * @param LdapWatcher $watcher
     * @param int         $objectId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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
