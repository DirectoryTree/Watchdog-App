<?php

Breadcrumbs::for('watchers.index', function ($trail) {
    $trail->push('Watchers', route('watchers.index'));
});

Breadcrumbs::for('watchers.show', function ($trail, $watcher) {
    $trail->parent('watchers.index');
    $trail->push($watcher->name, route('about'));
});
