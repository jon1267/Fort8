@extends('template')

@section('content')
    <div class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><b>Fort</b>LTE</a>
            </div>
            @if(session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Reset password</p>

                    <form action="{{ route('password.request') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email">
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

                        <div class="row">
                            <div class="col-12 mb-3">
                                <button type="submit" class="btn btn-primary btn-block">Reset</button>
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

