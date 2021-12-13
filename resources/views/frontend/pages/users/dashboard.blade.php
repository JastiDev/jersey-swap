@extends ('../../layouts/app')
@section('title')
    Dashboard - Jersey Swap
@endsection
@section('content')
    <section id="dashboard" class="pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    @if(auth()->user()->profile_picture!='default-user.png')
                                    <img src="{{url('/').'/'.auth()->user()->profile_picture}}" alt="Admin" class="rounded-circle" width="150">
                                    @else
                                    <img src="{{asset('assets/images/default-user.png')}}" alt="Admin" class="rounded-circle" width="150">
                                    @endif
                                    <div class="mt-3">
                                        <h4>{{auth()->user()->username}}</h4>
                                        @if(isset(auth()->user()->tag_line))
                                        <p class="text-secondary mb-1">{{auth()->user()->tag_line}}</p>
                                        @endif
                                       {{--  <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex flex-column">
                                    <div class="mt-3">
                                        <h6>About</h6>
                                        @if(isset(auth()->user()->about))
                                        <p class="text-secondary mb-1">{{auth()->user()->about}}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @auth
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex flex-column">
                                    <div class="mt-3">
                                        <h6>Credits</h6>
                                        <h5 class="mt-2 mb-2">${{$user->credits}}</h5>
                                        @if($user->credits>0 &&  $user->hasAnyWithdrawlRequest()==false)
                                        <form method="POST" action="{{url('withdraw')}}">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Withdraw Amount</button>
                                        </form>
                                        @elseif($user->credits>0 && $user->hasAnyWithdrawlRequest()==true)
                                        <p class="text-muted">Your withdrawl request is in process. Once it's approved you will be able to make an other withdrawl request!</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endauth
                    </div>

                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                       {{auth()->user()->f_name." ".auth()->user()->l_name}}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{auth()->user()->email}}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{auth()->user()->phone}}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Post Code</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{auth()->user()->postcode}}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{auth()->user()->address}}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a class="btn btn-primary" href="{{url('users/settings/account')}}">Edit Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('frontend.components.reviews')
                    </div>
                </div>
        </section>
@endsection
