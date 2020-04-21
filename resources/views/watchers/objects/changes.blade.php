@extends('watchers.objects.layout')

@section('tab')
    <div class="table-responsive bg-white shadow-sm rounded">
        <table class="table mb-0">
            <thead>
                <tr class="text-uppercase text-muted bg-secondary">
                    <th class="text-center"># ID</th>
                    <th>Attribute</th>
                    <th><i class="fas fa-clock"></i> Changed</th>
                    <th><i class="fas fa-clock"></i> Detected</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @forelse($changes as $change)
                <tr>
                    <td class="text-center align-middle">{{ $change->id }}</td>
                    <td class="align-middle">{{ $change->attribute }}</td>
                    <td class="align-middle">
                        <x-date-time :date="$change->ldap_updated_at"></x-date-time>
                    </td>
                    <td class="align-middle">
                        <x-date-time :date="$change->created_at"></x-date-time>
                    </td>
                    <td class="align-middle text-center">
                        <a href="{{ route('watchers.changes.show', [$watcher, $change]) }}" class="btn btn-sm btn-light border shadow-sm">
                            View
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-muted text-center font-weight-bold">
                        No changes have been recorded.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if($changes->total() > $changes->perPage())
        <div class="d-flex justify-content-center mt-2">
            {{ $changes->links() }}
        </div>
    @endif
@endsection
