<?php

Breadcrumbs::for('watchers.objects.show', function ($trail, $watcher, $object) {
    if ($object->parent) {
        $trail->parent('watchers.objects.show', $watcher, $object->parent);
    }

    $trail->push($object->name, route('watchers.objects.show', [$watcher, $object]));
});
