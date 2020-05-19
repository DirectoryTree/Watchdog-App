@extends('layouts.base')

@section('body')
<div class="h-100">
    <div class="container pt-4">
        <div class="d-flex justify-content-center my-4">
            <img alt="Watchdog logo" width="175" src="{{ asset('img/logo-large.svg') }}"/>
        </div>

        <h2 class="text-center text-muted">Domains</h2>

        <div class="row justify-content-center">
                @forelse($watchers as $watcher)
                    <div class="col-md-3">
                        <div class="card shadow-sm mb-4">
                            <div class="row justify-content-center my-4">
                                <div class="col-auto bg-secondary rounded-circle p-4">
                                    <i data-feather="server" width="75" height="75"></i>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-auto">
                                    <h4 class="mb-0">{{ \Illuminate\Support\Str::studly($watcher->name) }}</h4>
                                </div>
                            </div>

                            <div class="row m-4">
                                <div class="col">
                                    <a href="{{ route('watchers.show', $watcher) }}" class="btn btn-block btn-primary">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-3">
                        <div class="list-group-item rounded shadow-sm text-muted">
                            No domains have been added yet.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
