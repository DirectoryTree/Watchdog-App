@extends('watchers.layout')

@section('page')
    <div class="mb-2">
        <a href="{{ url()->previous(route('watchers.changes.index', $watcher)) }}" class="btn btn-light border">
            <i class="fas fa-chevron-left"></i> Back to Changes
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <h2 class="text-muted"># {{ $change->id }}</h2>
            <a href="{{ route('watchers.objects.show', [$watcher, $change->object]) }}" class="h5 d-block">{{ $change->object->name }}</a>
            <h6 class="text-muted">{{ $change->object->dn }}</h6>

            <hr/>

            <div class="row">
                <div class="col">
                    <h4>{{ $change->attribute }}</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 table-responsive">
                    <table class="table bg-secondary rounded overflow-hidden">
                        <thead>
                            <tr class="text-center text-uppercase text-muted">
                                <th>Before</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($before as $value)
                            <tr class="{{ in_array($value, $removed) ? 'bg-danger' : '' }}">
                                <td >
                                    @if($value instanceof \Carbon\Carbon)
                                        <x-date-time :date="$value"/>
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
                <div class="col-md-6 table-responsive">
                    <table class="table bg-secondary rounded overflow-hidden">
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
                                        <x-date-time :date="$value"/>
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
@endsection
