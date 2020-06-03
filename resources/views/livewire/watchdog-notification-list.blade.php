<div>
    <div class="table-responsive bg-white border rounded">
        <table class="table mb-0">
            <thead>
                <tr class="text-uppercase text-muted bg-secondary">
                    <th><i class="fas fa-cube"></i> Object</th>
                    <th><i class="fas fa-clock"></i> Detected</th>
                    <th class="text-center">
                        <i class="fas fa-info-circle"></i> Notification Sent
                    </th>
                    <th class="text-center">
                        <i class="fas fa-envelope"></i> Channels
                    </th>
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
                    <td>
                        <x-date-time :date="$notification->created_at"></x-date-time>
                    </td>
                    <td class="text-center">
                        @if($notification->sent)
                            <span class="badge badge-success">Yes</span>
                        @else
                            <span class="badge badge-warning">No</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @foreach($notification->channels as $channel)
                            {{ ucfirst($channel) }}
                        @endforeach
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-muted text-center">
                        No events of this type have occurred yet.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if($notifications->total() > $notifications->perPage())
        <div class="row d-flex align-items-center mt-4">
            <div class="col-lg">
                {{ $notifications->links() }}
            </div>

            <div class="col-lg text-right text-muted">
                Showing {{ $notifications->lastItem() }} out of {{ $notifications->total() }} results
            </div>
        </div>
    @endif
</div>
