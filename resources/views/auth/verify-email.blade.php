@extends('template')

@section('content')
<div class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Fort</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Вы должны подтвердить свой электронный адрес.
                Проверьте ваш email, кликните ссылку подтверждения.</p>
            <form action="{{ route('verification.send') }}" method="post">
                @csrf

                <div class="row">
                    <div class="col-12 mb-3">
                        <button type="submit" class="btn btn-primary btn-block">Resend</button>
                    </div>

                </div>
            </form>

            <!--<div class="social-auth-links text-center mb-3">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                </a>
            </div>-->
            <!-- /.social-auth-links -->

            <!--<p class="mb-1">
                <a href="{{ url('/forgot-password') }}">I forgot my password</a>
            </p>
            <p class="mb-0">
                <a href="{{ url('/register') }}" class="text-center">Register a new membership</a>
            </p>-->
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
</div>
<!-- /.login-box -->
@endsection
