@extends('watchers.objects.layout')

@section('tab')
    <div class="table-responsive bg-white shadow-sm rounded">
        <table class="table">
            <thead>
            <tr class="text-uppercase text-muted bg-secondary">
                <th class="tex">Attribute</th>
                <th>Value</th>
            </tr>
            </thead>
            <tbody>
            @forelse($attributes as $attribute => $values)
                <tr>
                    <td>{{ $attribute }}</td>
                    <td>
                        @forelse($values as $value)
                            {{ $value }}
                        @empty

                        @endforelse
                    </td>
                </tr>
            @empty

            @endforelse
            </tbody>
        </table>
    </div>
@endsection
