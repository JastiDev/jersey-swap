@extends ('../../layouts/app')
@section('title')
    Listing - Jersey Swap
@endsection
@section('content')
<style type="text/css">
    /* 
        Use :not with impossible condition so inputs are only hidden 
        if pseudo selectors are supported. Otherwise the user would see
        no inputs and no highlighted stars.
    */
    .rating input[type="radio"]:not(:nth-of-type(0)) {
        /* hide visually */    
        border: 0;
        clip: rect(0 0 0 0);
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
    }
    .rating [type="radio"]:not(:nth-of-type(0)) + label {
        display: none;
    }
    
    label[for]:hover {
        cursor: pointer;
    }
    
    .rating .stars label:before {
        content: "★";
        font-size: 40px;
    }
    
    .stars label {
        color: lightgray;
    }
    
    .stars label:hover {
        text-shadow: 0 0 1px #000;
    }
    
    .rating [type="radio"]:nth-of-type(1):checked ~ .stars label:nth-of-type(-n+1),
    .rating [type="radio"]:nth-of-type(2):checked ~ .stars label:nth-of-type(-n+2),
    .rating [type="radio"]:nth-of-type(3):checked ~ .stars label:nth-of-type(-n+3),
    .rating [type="radio"]:nth-of-type(4):checked ~ .stars label:nth-of-type(-n+4),
    .rating [type="radio"]:nth-of-type(5):checked ~ .stars label:nth-of-type(-n+5) {
        color: orange;
    }
    
    .rating [type="radio"]:nth-of-type(1):focus ~ .stars label:nth-of-type(1),
    .rating [type="radio"]:nth-of-type(2):focus ~ .stars label:nth-of-type(2),
    .rating [type="radio"]:nth-of-type(3):focus ~ .stars label:nth-of-type(3),
    .rating [type="radio"]:nth-of-type(4):focus ~ .stars label:nth-of-type(4),
    .rating [type="radio"]:nth-of-type(5):focus ~ .stars label:nth-of-type(5),
    .checked{
        color: darkorange;
    }
</style>
    @if (session('success'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success fade show" role="alert">
                    <strong>Success!</strong> {{ session('success') }}
                </div>
            </div>
        </div>
    @endif
      
    @if($listing->deal!==null && $listing->deal->deal_status=="completed")
        @include('frontend.components.deals.completed')
    @endif
    @include('frontend.components.deals.deal',[
    'listing' => $listing,
    'listing_gallery' => $listing_gallery
    ])
    
    @if($listing->status!=="cancelled" && $listing->listingOffers()>0)
        <div id="data-loader"></div>
        @include('frontend.components.react-loader')
        <script>
            const listing = {{$listing->id}};
            const listing_status = "{{$listing->status}}";
            const csrf= "{{csrf_token()}}";
        </script>
        <script type="text/babel" src="{{asset('assets/react/single-listing.js')}}"></script>
        
        @if($listing->deal!==null && $listing->deal->deal_status=="completed")
           @if($listing->deal->reviews()!==null && count($listing->deal->reviews())==2)
           @php
           $reviews = $listing->deal->reviews();
       @endphp
       <div class="container">
           <div class="row">
               <div class="col-md-12 mr-2 mb-2">
                   <h2>Reviews</h2>
                   <hr>
                   @foreach($reviews  as $review)
                   <div class="card card-offer mb-3">
                       <div class="card-body">
                           <div class="row">
                               <div class="col-md-1">
                                   <img class="avatar" src="{{static_url('avatar/'.$review->avatar())}}">
                               </div><div class="col-md-11">
                                   <div class="row">
                                       <div class="col">
                                           <p>By <a href="{{url('user/'.$review->given_by_username())}}">{{$review->given_by_username()}}</a></p>
                                       </div>
                                       <div class="mb-2">
                                           @for($i=1;$i<=$review->rating;$i++)
                                               <span class="fa fa-star checked"></span>
                                           @endfor
                                           @for($i=5;$i>$review->rating;$i--)
                                               <span class="fa fa-star"></span>
                                           @endfor
                                       </div>
                                       <div class="description mb-3">{{$review->feedback}}</div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   @endforeach
               </div>
           </div>
       </div>
            @elseif($listing->deal->my_review()!==null)
                @php
                    $review = $listing->deal->my_review();
                @endphp
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mr-2 mb-2">
                            <h2>Reviews</h2>
                            <hr>
                            <div class="card card-offer mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <img class="avatar" src="{{static_url('avatar/'.$review->avatar())}}">
                                        </div><div class="col-md-11">
                                            <div class="row">
                                                <div class="col">
                                                    <p>By <a href="{{url('user/'.$review->given_by_username())}}">{{$review->given_by_username()}}</a></p>
                                                </div>
                                                <div class="mb-2">
                                                    @for($i=1;$i<=$review->rating;$i++)
                                                        <span class="fa fa-star checked"></span>
                                                    @endfor
                                                    @for($i=5;$i>$review->rating;$i--)
                                                        <span class="fa fa-star"></span>
                                                    @endfor
                                                </div>
                                                <div class="description mb-3">{{$review->feedback}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mr-2 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" action="{{url('review')}}">
                                        @csrf
                                        <input type="hidden" name="deal_id" value="{{$listing->deal->id}}">
                                        <div class="form-group mb-3 ">
                                            <label>Give Rating</label>
                                            <fieldset class="rating">
                                                
                                                <input id="rating-1" type="radio" name="rating" value="1" checked> 
                                                <label for="rating-1">1 star</label>
                                                <input id="rating-2" type="radio" name="rating" value="2">
                                                <label for="rating-2">2 stars</label>
                                                <input id="rating-3" type="radio" name="rating" value="3">
                                                <label for="rating-3">3 stars</label>
                                                <input id="rating-4" type="radio" name="rating" value="4">
                                                <label for="rating-4">4 stars</label>
                                                <input id="rating-5" type="radio" name="rating" value="5">
                                                <label for="rating-5">5 stars</label>
                                                
                                                <div class="stars">
                                                    <label for="rating-1" aria-label="1 star" title="1 star"></label>
                                                    <label for="rating-2" aria-label="2 stars" title="2 stars"></label>
                                                    <label for="rating-3" aria-label="3 stars" title="3 stars"></label>
                                                    <label for="rating-4" aria-label="4 stars" title="4 stars"></label>
                                                    <label for="rating-5" aria-label="5 stars" title="5 stars"></label>   
                                                </div>
                                                
                                            </fieldset>
                                        </div>

                                        <div class="form-group m-2">
                                            <label for="feedback" class="mb-2">Feedback</label>
                                            <textarea id="feedback" class="form-control" name="feedback" placeholder="How was your experience while trading your jersey swap?" rows="5"></textarea>
                                        </div>

                                        <div class="text-end m-2">
                                            <button type="submit" class="btn btn-primary m-b">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    @endif

@endsection
