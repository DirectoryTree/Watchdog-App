@extends('layouts.plain')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h3 class="mb-0">Edit User</h3>

            <form method="post" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Are you sure you want to delete this user?')">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger shadow-sm" {{ $user->is(auth()->user()) ? 'disabled' : '' }}>
                    <i data-feather="trash"></i>
                </button>
            </form>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('users.update', $user) }}">
                    @csrf
                    @method('patch')

                    @include('users.form')

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('users.index') }}" class="btn btn-light shadow-sm">
                                    Cancel
                                </a>

                                <button type="submit" class="btn btn-primary shadow-sm">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
