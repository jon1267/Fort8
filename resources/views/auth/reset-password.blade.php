@extends('template')

@section('content')
    <div class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><b>Fort</b>LTE</a>
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Reset password</p>

                    <form action="{{ route('password.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="input-group mb-3">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $request->email }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('email')
                                <span class="invalid-feedback is-invalid" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input id="password-confirm" type="password" class="form-control"  name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-3">
                                <button type="submit" class="btn btn-primary btn-block">Update</button>
                            </div>
                        </div>

                    </form>

                    <p class="mb-0">
                        <a href="{{ url('/register') }}" class="text-center">Register a new membership</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection


