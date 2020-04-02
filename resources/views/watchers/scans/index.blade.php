@extends('watchers.layout')

@section('page')
    <livewire:scan-list :watcher="$watcher"></livewire:scan-list>
@endsection
