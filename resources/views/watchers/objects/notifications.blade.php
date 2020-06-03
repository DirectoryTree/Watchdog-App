@extends('watchers.objects.layout')

@section('tab')
    <div class="table-responsive bg-white border rounded">
        <table class="table mb-0">
            <thead>
                <tr class="text-uppercase text-muted bg-secondary">
                    <th class="text-center">Sent</th>
                    <th>Subject</th>
                    <th><i class="fas fa-clock"></i> Generated</th>
                </tr>
            </thead>
            <tbody>
            @forelse($notifications as $notification)
                <tr>
                    <td class="text-center align-middle">
                        @if($notification->sent)
                            <span class="badge badge-success">Yes</span>
                        @else
                            <span class="badge badge-warning">No</span>
                        @endif
                    </td>
                    <td>
                        @if($notification->data && $subject = $notification->data['subject'])
                            {{ $subject }}
                        @else
                            <span class="badge badge-warning p-2">
                                Unable to resolve [{{ $notification->watchdog }}]
                            </span>
                        @endif
                    </td>
                    <td>
                        <x-date-time :date="$notification->created_at"/>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-muted text-center font-weight-bold">
                        No notifications have been generated for this object.
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
