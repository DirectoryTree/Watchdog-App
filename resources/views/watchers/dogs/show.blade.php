@extends('watchers.layout')

@section('page')
    <h3>{{ $watchdog->getName() }}</h3>

    <div class="table-responsive bg-white shadow-sm rounded">
        <table class="table mb-0">
            <thead>
                <tr class="text-uppercase text-muted bg-secondary">
                    <th><i class="fas fa-cube"></i> Object</th>
                    <th><i class="fas fa-clock"></i> Detected</th>
                    <th class="text-center"><i class="fas fa-info-circle"></i> Notification Sent</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notifications as $notification)
                    <tr>
                        <td>
                            <a href="{{ route('watchers.objects.show', [$watcher, $notification->object]) }}">
                                {{ $notification->object->name }}
                            </a>
                        </td>
                        <td>{{ $notification->created_at->format(config('watchdog.notifications.date_format')) }}</td>
                        <td class="text-center">
                            @if($notification->sent)
                                <span class="badge badge-success">Yes</span>
                            @else
                                <span class="badge badge-warning">No</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted font-weight-bold">
                            No events of this type have occurred yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($notifications->total() > $notifications->perPage())
        <div class="d-flex justify-content-center mt-2">
            {{ $notifications->links() }}
        </div>
    @endif
@endsection
