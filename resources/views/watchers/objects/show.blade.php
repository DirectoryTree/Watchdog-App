@extends('watchers.objects.layout')

@section('tab')
    <div class="row">
        <div class="col">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Changes</h6>
                    <h2 class="mb-0">{{ $object->changes()->count() }}</h2>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Changes Today</h6>
                    <h2 class="mb-0">{{ $object->changes()->whereDate('created_at', today())->count() }}</h2>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Last Change</h6>
                    @if($change = $object->changes()->latest()->first())
                        <h2 class="mb-0">{{ $change->ldap_updated_at->diffForHumans() }}</h2>
                    @else
                        <h2 class="mb-0">Never</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
