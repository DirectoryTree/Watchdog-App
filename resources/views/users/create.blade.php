@extends('layouts.app')

@section('content')
<h3>Create User</h3>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf

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
@endsection
