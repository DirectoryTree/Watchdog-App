@extends('watchers.layout')

@section('page')
    <h3>{{ $watchdog->getName() }}</h3>

    <livewire:watchdog-notification-list
        :watcher="$watcher"
        :watchdog-key="$watchdog->getKey()"
    />
@endsection
