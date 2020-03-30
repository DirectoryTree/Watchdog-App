@extends('watchers.layout')

@section('page')
    <form class="mb-2">
        <div class="form-row">
            <div class="col-md-8">
                <input type="search" class="form-control shadow-sm" placeholder="Search for objects...">
            </div>

            <div class="col-3">
                <div class="input-group rounded shadow-sm">
                    <div class="input-group-prepend">
                        <label class="input-group-text">Attribute</label>
                    </div>

                    <select class="custom-select">
                        <option></option>
                    </select>
                </div>
            </div>

            <div class="col">
                <button type="submit" class="btn btn-block btn-primary shadow-sm">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <div class="table-responsive bg-white shadow-sm rounded">
        <table class="table mb-0">
            <thead>
                <tr class="text-uppercase text-muted bg-secondary">
                    <th class="text-center"># ID</th>
                    <th><i class="fas fa-cube"></i> Object</th>
                    <th>Attribute</th>
                    <th><i class="fas fa-clock"></i> Changed</th>
                    <th><i class="fas fa-clock"></i> Created</th>
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
                    <td class="align-middle">{{ $change->ldap_updated_at }}</td>
                    <td class="align-middle">{{ $change->created_at }}</td>
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
