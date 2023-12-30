<!doctype html>
<html class="modern fixed has-top-menu has-left-sidebar-half">
<head>
    @include('.admin.includes.head')
</head>
<body>
<!-- start: page -->
<section class="body-sign">
    <div class="center-sign">
        <div class="panel card-sign">
            <div class="col-md-6">
                <a href="home" class="logo float-left">
                    <img src="{{ asset('/assets/img/logo-default.png') }}" alt="PinkAd Admin" />
                </a>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <p class="m-0">Enter your e-mail below and we will send you reset instructions!</p>
                </div>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group mb-0">
                        <div class="input-group">
                            <input name="email" id="email" type="email" placeholder="E-mail" class="form-control form-control-lg" />
                            <button class="btn btn-primary btn-lg" type="submit">Reset!</button>
                        </div>
                    </div>

                    <p class="text-center mt-3">Remembered? <a href="{{ route('login') }}">Sign In!</a></p>
                </form>
            </div>
        </div>

        <p class="text-center text-muted mt-3 mb-3"><a href="https://pinkad.pk/">PinkAd</a> &copy; Copyright 2023. All Rights Reserved.</p>
    </div>
</section>
<!-- end: page -->
<footer class="row">
    @include('.admin.includes.footer')
</footer>
</body>
</html>


{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
