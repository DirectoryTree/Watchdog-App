<?php

namespace App\Http\Controllers;

use App\WatchdogRepository;
use DirectoryTree\Watchdog\LdapWatcher;
use DirectoryTree\Watchdog\Ldap\Transformers\AttributeTransformer;

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
        $query = $watcher->objects();

        if ($search = request('search')) {
            $opened = false;
            $query->with('parent')->where('name', 'like', "%$search%");
        } else {
            $opened = true;
            $query->roots()->with('children');
        }

        return view('watchers.objects.index', [
            'watcher' => $watcher,
            'objects' => $query->get(),
            'opened' => $opened,
        ]);
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
            'changes' => $object->changes()->latest()->paginate(15),
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
            'notifications' => $object->notifications()->latest()->paginate(15),
        ]);
    }

    /**
     * Displays the objects timeline.
     *
     * @param LdapWatcher $watcher
     * @param int         $objectId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function timeline(LdapWatcher $watcher, $objectId)
    {
        $validated = request()->validate([
            'day' => 'date',
            'start' => 'date',
        ]);

        $object = $watcher->objects()->findOrFail($objectId);

        $changes = $object->changes()
            ->selectRaw('count(*) as count, date(created_at) as date')
            ->groupByRaw('date')
            ->orderByRaw('date desc')
            ->get();

        $changesForDay = isset($validated['day'])
            ? $object->changes()->whereDate('created_at', $validated['day'])->paginate()
            : collect();

        if (isset($validated['day'])) {
            $accumulatedChanges = $object->changes()->select('attribute', 'after')
                ->groupBy(['attribute', 'after', 'created_at'])
                ->whereBetween('created_at', [
                    $validated['day'],
                    now(),
                ])->oldest()->get()->map(function ($change) use ($object) {
                    return [
                        'attribute' => $change->attribute,
                        'before' => $change->before,
                        'after' => $object->values[$change->attribute],
                    ];
                });
        }

        $days = [];

        foreach (range(0, 89) as $day) {
            $days[] = now()->subDay($day)->format('Y-m-d');
        }

        return view('watchers.objects.timeline', [
            'watcher' => $watcher,
            'object' => $object,
            'changes' => $changes,
            'days' => array_reverse($days),
            'changesForDay' => $changesForDay,
            'accumulatedChanges' => isset($accumulatedChanges) ? $accumulatedChanges : collect(),
        ]);
    }
}
