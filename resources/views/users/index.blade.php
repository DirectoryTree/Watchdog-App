@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">Users</h2>

                    <a href="{{ route('users.create') }}" class="btn btn-primary shadow-sm">
                        Add User
                    </a>
                </div>

                <div class="list-group">
                    @foreach($users as $user)
                        <a href="{{ route('users.edit', $user) }}" class="list-group-item list-group-item-action shadow-sm">
                            <div class="d-flex flex-column">
                                <h4 class="mb-0">{{ $user->name }}</h4>
                                <h5 class="text-muted mb-0">{{ $user->email }}</h5>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
