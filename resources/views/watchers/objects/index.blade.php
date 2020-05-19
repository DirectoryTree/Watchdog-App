@extends('watchers.layout')

@section('header')
    <h2>Objects</h2>
@endsection

@section('page')
    <livewire:watcher-object-list :watcher="$watcher"></livewire:watcher-object-list>
@endsection
