@extends('layouts.plain')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h3>Register an Account</h3>
                        <h6 class="text-muted">This account will be the global watchdog administrator.</h6>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        @include('users.form')

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary shadow-sm">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
