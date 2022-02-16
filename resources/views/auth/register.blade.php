@extends('layouts.app')
@section('title')
    Register - Jersey Swap
@endsection
@section('meta_description')
    Register your account and start trading your jersey and get offers.
@endsection
@section('content')
<section id="login" class="auth-section" style="min-height: calc(100vh - 498px);">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="card mt-5 mb-5">
                            <div class="card-body">
                                <h1 class="text-center">Sign Up</h1>
                                <form method="POST" action="{{ route('register') }}">
                                @csrf
                                    <div class="row mb-3">
                                        {{-- First Name --}}
                                        <div class="col">
                                            <label for="f_name" class="form-label">First Name</label>
                                            <input id="f_name" type="text" class="form-control @error('f_name') is-invalid @enderror" placeholder="First Name" name="f_name" value="{{ old('f_name') }}" required autocomplete="f_name" autofocus>
                                            @error('f_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- Last Name --}}
                                        <div class="col">
                                            <label for="l_name" class="form-label">Last Name</label>
                                            <input id="l_name" type="text" class="form-control @error('l_name') is-invalid @enderror" placeholder="Last Name" name="l_name" value="{{ old('l_name') }}" required autocomplete="l_name" autofocus>
                                            @error('l_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    {{-- Username --}}
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input id="username" type="text" class="form-control  @error('username') is-invalid @enderror" placeholder="Username" name="username" value="{{ old('username') }}" required autocomplete="username">
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password-confirm" class="form-label">Confirm Password</label>
                                        <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" required>
                                            <label class="form-check-label" for="flexCheckChecked">
                                                By checking the box you agree to the sites terms and conditions.
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mb-3 d-grid">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-user"></i> Sign Up</button>
                                    </div>
                                    <hr>
                                    <div class="mb-3 d-grid">
                                        <a href="{{route('login')}}" class="btn btn-primary"><i class="fa fa-sign-in"></i> Already have an account? Log In</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
