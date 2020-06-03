@extends('watchers.objects.layout')

@section('tab')
    <div class="table-responsive bg-white border rounded">
        <table class="table mb-0">
            <thead>
                <tr class="text-uppercase text-muted bg-secondary">
                    <th class="text-right">Attribute</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
            @forelse($attributes as $attribute => $values)
                <tr>
                    <td class="bg-secondary text-right align-middle">{{ $attribute }}</td>
                    <td>
                        @if(count($values) > 1)
                            <ul class="m-0 list-unstyled">
                                @foreach($values as $value)
                                    <li>{{ \Illuminate\Support\Arr::first((array) $value) }}</li>
                                @endforeach
                            </ul>
                        @else
                            @forelse($values as $value)
                                {{ \Illuminate\Support\Arr::first((array) $value) }}
                            @empty
                                <em>No value</em>
                            @endforelse
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-muted text-center font-weight-bold">
                        No attributes are present for this object.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
