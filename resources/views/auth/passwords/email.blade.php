@extends('layouts.app')

@section('content')
    <section id="login" class="auth-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mx-auto">
                    <div class="card mt-5 mb-5">
                        <div class="card-body">
                            <h3 class="text-center card-title">Reset Password</h3>
                            <hr>
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Registered Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3 d-grid">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-key"></i> Reset Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
