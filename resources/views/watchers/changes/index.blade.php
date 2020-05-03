@extends('watchers.layout')

@section('page')
    <div class="card shadow-sm mb-2">
        <x-navbar id="objects-navbar" title="Search">


            <ul class="navbar-nav ml-auto">
                @include('components.partials.nav.clear-filters')

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown-by-object" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-cube"></i> Object
                    </a>

                    <div class="dropdown-menu dropdown-menu-right shadow mx-n4" aria-labelledby="dropdown-by-creator" style="min-width: 300px;">
                        <!-- user search -->
                    </div>
                </li>
            </ul>
        </x-navbar>
    </div>

    <div class="table-responsive bg-white shadow-sm rounded">
        <table class="table mb-0">
            <thead>
                <tr class="text-uppercase text-muted bg-secondary">
                    <th class="text-center"># ID</th>
                    <th><i class="fas fa-cube"></i> Object</th>
                    <th>Attribute</th>
                    <th><i class="fas fa-clock"></i> Changed</th>
                    <th><i class="fas fa-clock"></i> Detected</th>
                    <th></th>
                </tr>
            </thead>

            @forelse($changes as $change)
                <tr>
                    <td class="align-middle text-center">{{ $change->id }}</td>
                    <td class="align-middle">
                        <a href="{{ route('watchers.objects.show',[$watcher, $change->object]) }}">
                            {{ $change->object->name }}
                        </a>
                    </td>
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
                    <td colspan="6" class="text-muted font-weight-bold">
                        No changes have been recorded yet.
                    </td>
                </tr>
            @endforelse
        </table>
    </div>

    @if($changes->total() > $changes->perPage())
        <div class="d-flex justify-content-center mt-2">
            {{ $changes->links() }}
        </div>
    @endif
@endsection
