@extends('watchers.layout')

@section('page')
    <livewire:scan-list :watcher="$watcher"/>
@endsection
