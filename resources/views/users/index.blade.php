@extends('layouts.plain')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Users</h2>

            <a href="{{ route('users.create') }}" class="btn btn-primary shadow-sm">
                Create User
            </a>
        </div>

        <div class="list-group">
            @foreach($users as $user)
                <a href="{{ route('users.edit', $user) }}" class="list-group-item list-group-item-action shadow-sm">
                    <div class="d-flex flex-column">
                        <h4 class="mb-0 font-weight-normal">{{ $user->name }}</h4>
                        <h5 class="text-muted mb-0 font-weight-normal">{{ $user->email }}</h5>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>

    <div class="row justify-content-center my-4">
        <div class="col-auto">
            <a href="{{ url('/') }}" class="btn btn-light shadow-sm d-flex align-items-center">
                <i data-feather="arrow-left" width="15" height="15"></i>
                Back to Home
            </a>
        </div>
    </div>
@endsection
