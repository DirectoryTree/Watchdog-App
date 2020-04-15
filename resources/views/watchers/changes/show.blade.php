@extends('watchers.layout')

@section('page')
    <div class="d-flex justify-content-between mb-2">
        <div>
            <a href="{{ url()->previous(route('watchers.changes.index', $watcher)) }}" class="btn btn-light shadow-sm">
                <i class="fas fa-chevron-left"></i> Back to Changes
            </a>
        </div>

        <div>
            <a href="#" class="btn btn-light shadow-sm">
                View attribute changes
            </a>

            <a href="#" class="btn btn-light shadow-sm">
                View object changes
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body d-flex justify-content-between">
            <h2 class="text-muted flex-shrink-1 mr-4"># {{ $change->id }}</h2>

            <div class="flex-grow-1">
                <a href="{{ route('watchers.objects.show', [$watcher, $change->object]) }}" class="h5 d-block">{{ $change->object->name }}</a>
                <h6 class="text-muted">{{ $change->object->dn }}</h6>

                <hr/>

                <div class="row">
                    <div class="col">
                        <h4>{{ $change->attribute }}</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <table class="table bg-secondary rounded overflow-hidden shadow-sm">
                            <thead>
                                <tr class="text-center text-uppercase text-muted">
                                    <th>Before</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($before as $value)
                                <tr class="{{ in_array($value, $removed) ? 'bg-danger' : '' }}">
                                    <td>
                                        @if($value instanceof \Carbon\Carbon)
                                            <x-date-time :date="$value"></x-date-time>
                                        @else
                                            {{ $value }}
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td><em>No value.</em></td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table bg-secondary rounded overflow-hidden shadow-sm">
                            <thead>
                                <tr class="text-center text-uppercase text-muted">
                                    <th>After</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($after as $value)
                                <tr class="{{ in_array($value, $added) ? 'bg-success' : '' }}">
                                    <td>
                                        @if($value instanceof \Carbon\Carbon)
                                            <x-date-time :date="$value"></x-date-time>
                                        @else
                                            {{ $value }}
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td><em>No value.</em></td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
