@extends ('../../layouts/app')
@section('title')
    About us - Jersey Swap
@endsection
@section('meta_description')
Jersey Swap is revolutionizing the sports jersey industry by providing a  platform that operates as the central hub for all sports jersey trading.    
@endsection
@section('content')
    <section id="page-box" class="page-hero-box">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>About us</h1>
                    <ul class="breadcrumb mx-auto justify-content-center" aria-label="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            About
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="about-boxes" class="m-n-t-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="card bg-white">
                        <div class="card-body text-center">
                            <img src="assets/images/icons/add-user.png" class="mb-2" alt="User Signup">
                            <h3>Easy</h3>
                            <p>No in person meet up.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-white">
                        <div class="card-body text-center">
                            <img src="assets/images/icons/shield.png" class="mb-2" alt="Secure Jersey Swapping">
                            <h3>Secure</h3>
                            <p>Jersey Swap facilitates every deal.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-white">
                        <div class="card-body text-center">
                            <img src="assets/images/icons/team.png" class="mb-2" alt="Reliable Jersey Swap">
                            <h3>Reliable</h3>
                            <p>Buyers, Sellers, and Traders can be confident in all transactions.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-white">
                        <div class="card-body text-center">
                            <img src="assets/images/icons/technical-support.png" class="mb-2" alt="Best Support by Jersey Swap">
                            <h3>Support</h3>
                            <p><a href="{{url('contact')}}">Contact Us</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about-us" class="mt-md-3 mt-0 pt-md-5 pt-0 pb-md-5 pb-0">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="assets/images/bg.jpg" width="100%" alt="Sports Team Playing">
                </div>
                <div class="col-md-6">
                    <h2 class="mt-3 mb-1">How Can We Help You Expand Your Collection</h2>
                    <div class="divider"></div>
                    <p>Jersey Swap is revolutionizing the sports jersey industry. Our platform operates as the central hub for all sports jersey trading. All transactions will be completed via online where Jersey Swap will facilitate every deal made on our website. 
                    Sellers, list their items for sale/trade on Jersey Swap, while buyers/traders pursue listings available.
                    </p>
		    <p>
                         List It - Sellers / Traders can create listings completely free.
			 <br/>
			Trade It - Users will have the opportunity to accept or decline offers from different users.
			 <br/>
			Send It - When a trade is made both parties will send the sports jersey or card to each other.
			 <br/>
			Collect It - Expand your sports collection beyond your wildest dtreams.
                    </p>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.components.testimonials',[
    'testimonials' => $testimonials
    ])

@endsection
