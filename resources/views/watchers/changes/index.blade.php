@extends('watchers.layout')

@section('page')
    <h2>Changes</h2>

    <livewire:changes-list :watcher="$watcher"/>
@endsection
