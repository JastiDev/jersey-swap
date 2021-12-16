@extends ('../../layouts/app')
@section('title')
    Profile - Jersey Swap
@endsection
@section('content')
    <section id="dashboard" class="pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    @if($user->profile_picture!='default-user.png')
                                    <img src="{{url('/').'/'.$user->profile_picture}}" alt="Admin" class="rounded-circle" width="150">
                                    @else
                                    <img src="{{asset('assets/images/default-user.png')}}" alt="Admin" class="rounded-circle" width="150">
                                    @endif
                                    <div class="mt-3">
                                        <h4>{{$user->username}}</h4>
                                        <!-- @if($user->tag_line)
                                        <p class="text-secondary mb-1">{{$user->tag_line}}</p>
                                        @endif
                                       {{--  <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p> --}} -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column">
                                    <div class="mt-3">
                                        <h6>About</h6>
                                        @if($user->about)
                                        <p class="text-secondary mb-1">{{$user->about}}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        @include('frontend.components.reviews',[
                        'user'=>$user
                        ])
                    </div>
                </div>
        </section>
@endsection
