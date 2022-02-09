@extends ('../../layouts/app')
@section('title')
    Home - Jersey Swap
@endsection
@section('meta_description')
    The central hub to buy, sell, and trade sports jerseys and sports cards..
@endsection
@section('content')
    <section id="herobox">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>Sports Exchange!</h1>
                    <p>Jersey Swap is the nation’s platform for the best products from the past, present, and future. Buy, sell, and trade for iconic sports jerseys and sports cards with users across the country! The destination for sports jerseys and sports cards on desktop, iPhone, and Android. 
                    </p>
                    <a href="{{url('exchange')}}" class="btn btn-primary">Start Exchange</a>
                </div>
            </div>
        </div>
    </section>

    <section id="video-tutorial" class="pt-md-5 pb-md-5 pt-2 pb-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 video-wrapper">
                    <iframe src="https://player.vimeo.com/video/675557251?h=ea87267b55" style="width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe><script src="https://player.vimeo.com/api/player.js"></script>
                </div>
            </div>
        </div>
    </section>

    <section id="why-choose-us" class="pt-md-5 pb-md-5 pb-2">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="service-box">
                        <div class="icon icon-profile"></div>
                        <div class="icon-content">
                            <h3>Free Sign up</h3>
                            <p>Secure transactions</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="service-box">
                        <div class="icon icon-swap"></div>
                        <div class="icon-content">
                            <h3>Secure Swapping</h3>
                            <p>Secure transactions</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="service-box">
                        <div class="icon icon-shield"></div>
                        <div class="icon-content">
                            <h3>Risk Free</h3>
                            <p>Secure transactions</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="service-box">
                        <div class="icon icon-support"></div>
                        <div class="icon-content">
                            <a href="{{url('contact')}}"><h3>Support Desk</h3></a>
                            <p>Secure transactions</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    @if($banner!==null && $banner_url !== null)
    <section id="ad" class="mt-md-5 mb-md-5 m-sm-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{$banner_url->setting_value}}">
                        <img src="{{static_url('banner/'.$banner->setting_value)}}" class="ad">
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if($listings!==null && count($listings)>0)
    <section id="recent-trades" class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mb-3">Recent Listings</h2>
                    <div class="owl-carousel owl-theme">

                        <!-- Product 1 -->
                        
                        @foreach($listings as $listing)
                        <div class="item">
                            <div class="card product-card">
                                <a href="{{url('/exchange/'.$listing->slug)}}"><img src="{{static_url('products_featured/'.$listing->product_img)}}" class="card-img-top"
                                        alt="{{$listing->product_title}}"></a>
                                <div class="card-body">
                                    <div class="mb-2">
                                        <h6 class="font-weight-semibold mb-2 product-title">
                                            <a href="{{url('/exchange/'.$listing->slug)}}" class="text-default mb-2" data-abc="true">{{strlen($listing->product_title) >35 ? trim(substr($listing->product_title,0,35)."...") : $listing->product_title}}</a>
                                        </h6>
                                    </div>
                                    <div class="product-meta d-flex flex-row">
                                        <div class="user-avatar p-1">
                                            <img src="{{static_url('avatar/'.$listing->owner->profile_picture)}}" class="avatar">
                                        </div>
                                        <div class="user-name align-self-center">
                                            By <a href="{{url('user/'.$listing->owner->username)}}">{{$listing->owner->username}}</a>
                                        </div>
                                    </div>
                                    <div style="margin-bottom: 8px; color: green; font-weight: bold;">
                                        <span>Buy Now: ${{$listing->price}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <section id="how-it-works" class="mt-5 pt-5 pb-5 bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mb-3">
                    <h2 class="text-white mt-2 mb-md-5 mb-2">The Swap:</h2>
                </div>
                <div class="col-md-3 d-flex align-items-stretch mb-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="assets/images/icons/add-user.png" class="mb-2" alt="Signup">
                            <h5 class="card-title">Sign Up</h5>
                            <p class="card-text">Users will need to complete the registration process.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 d-flex align-items-stretch mb-2">
                    <div class="card w-100">
                        <div class="card-body text-center">
                            <img src="assets/images/icons/jersey.png" class="mb-2" alt="Jersey">
                            <h5 class="card-title">List It</h5>
                            <p class="card-text">Create listing and find the perfect match.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 d-flex align-items-stretch mb-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="assets/images/icons/versus.png" class="mb-2" alt="Versus">
                            <h5 class="card-title">Send It</h5>
                            <p class="card-text">Users will send items to each other when a deal is made.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 d-flex align-items-stretch mb-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="assets/images/icons/confirmation.png" class="mb-2" alt="Confirmation">
                            <h5 class="card-title">Collect It</h5>
                            <p class="card-text">Complete your trade or purchase and swap again.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 text-center mt-md-5 mt-2">
                    <a href="{{route('register')}}" class="btn btn-primary">Create Account Now!</a>
                </div>

            </div>
        </div>
    </section>

    @include('frontend.components.testimonials',[
        'testimonials' => $testimonials
    ])
    
@endsection
