@extends('layouts.app')
@section('title')
    Login - Jersey Swap
@endsection
@section('meta_description')
    Login to Jersey Swap. Find perfect jersey and create an offer!
@endsection
@section('content')
<section id="login" class="auth-section" style="min-height: calc(100vh - 498px);">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mx-auto">
                        <div class="card mt-5 mb-5">
                            <div class="card-body">
                                <h1 class="text-center">Log In</h1>
                                <form method="POST" action="{{route('login')}}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email/Username</label>
                                        <input id="email type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email/Username" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 d-grid">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-sign-in"></i> Log In</button>
                                    </div>
                                    <div class="mb-3">
                                        @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">Forget Password?</a>
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="mb-3 d-grid">
                                        <a href="{{route('register')}}" class="btn btn-primary"><i class="fa fa-user"></i> Create Account</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

