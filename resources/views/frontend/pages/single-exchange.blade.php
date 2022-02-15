@extends ('../../layouts/app')
@section('title')
    Listing - Jersey Swap
@endsection
@section('content')
    <section id="signle-product" class="pt-5 pb-5">
        <div class="container">
            @if (session('success'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success fade show" role="alert">
                            <strong>Success!</strong> {{ session('success') }}
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-8 mx-auto mb-5">
                    <h1>{{ $listing->product_title }}</h1>
                        @if($listing->authentic)
                        <span class="text-success">Authentic</span>
                        @else
                        <span class="text-dark">Non Authentic</span>
                        @endif
                    <div class="product-meta d-flex flex-row">
                        <div class="user-avatar p-1">
                            <img src="{{ static_url('avatar/'.$listing->user->profile_picture) }}" class="avatar" alt="User Avatar">
                        </div>
                        <div class="user-name align-self-center">
                            By <a href="{{url('user/'.$listing->owner->username)}}">{{$listing->owner->username}}</a>
                        </div>
                    </div>
                    <img id="featured" src="{{ static_url('products_featured/'.$listing->product_img) }}" width="100%" alt="{{$listing->product_title}}">
                    <div class="mt-3 text-success fw-bold">
                        <span>Buy Now: ${{$listing->price}}</span>
                    </div>
                    <div class="description mt-2 mb-2">
                        <h3>Description: </h3>
                        <p>{{ $listing->product_description }}</p>
                    </div>
                    <div class="gallery mb-3">
                        @foreach ($listing_gallery as $img)
                            <a href="{{ static_url('products/' . $img->image) }}" target="_blank">
                                <img src="{{ static_url('products/' . $img->image) }}" class="rounded" alt="Listing Gallery">
                            </a>
                        @endforeach
                    </div>
                    @auth
                        @if (auth()->user()->id !== $listing->posted_by && auth()->user()->role->role!=="admin")
                            <div class="text-end d-flex my-5">
                                <!-- <form method="POST" action="{{ url('offer/post') }}">
                                    @csrf
                                    <input type="hidden" name="listing_id"  value="{{$listing->id}}">
                                    <input type="hidden" name="amount"  value="{{$listing->price}}">
                                    <input type="hidden" name="isBuy"  value="true">
                                    <button type="submit" class="btn btn-success fs-5">
                                        Buy it now
                                    </button>
                                </form> -->

                                <button type="button" class="btn btn-primary fs-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Make Offer
                                </button>
                            </div>
                            <div class="my-5">
                                <span>Have a question about the item?</span>
                                <a href="{{url('/messages')}}" class="btn btn-success ms-4 fs-5">Message Seller</a>
                            </div>
                        @endif
                        @if (auth()->user()->role->role=="admin" && $listing->status!=="cancelled" && $listing->status!=="closed")
                            <div class="text-end">
                                <form method="POST" action="{{url('admin/cancel-listing')}}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="listing"  value="{{$listing->id}}">
                                    <button type="submit" class="btn btn-danger">Cancel Listing</button>
                                </form>
                            </div>
                        @endif
                    @endauth
                    @guest
                        <div class="text-start">
                            <a href="{{url('login')}}" class="btn btn-success"> Log in to make offer</a>
                        </div>
                    @endguest
                </span>
            </div>
        </div>
    </section>
    @auth
        @if (auth()->user()->id !== $listing->posted_by)
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Make Trade Offer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="offer-form" method="POST" action="{{ url('offer/post') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="my-4">
                                    <p>Offers can be made:</p>
                                    <ul class="ps-4">
                                        <li>Item for item: Please include images of the item you are trading and leave the amount as “0”. Then press “post offer”.</li>
                                        <li>Money for item: Please include the amount you wish to offer and leave the “image gallery” empty.  Then press “post offer”. </li>
                                        <li>Item and money for item: Please include the amount you wish to offer and images of the item you are attempting to trade. Then press “post offer”.  (Please use this feature when the trade needs to be more equal). </li>
                                    </ul>
                                    <div class="fs-5 text mb-4">
                                        How would you like to acquire item?
                                    </div>
                                    <div class="form-check my-2">
                                        <input class="form-check-input" type="radio" name="trade_method" id="item4item">
                                        <label class="form-check-label" for="item4item">
                                            Item for item
                                        </label>
                                    </div>
                                    <div class="form-check my-2">
                                        <input class="form-check-input" type="radio" name="trade_method" id="money4item">
                                        <label class="form-check-label" for="money4item">
                                            Money for item
                                        </label>
                                    </div>
                                    <div class="form-check my-2">
                                        <input class="form-check-input" type="radio" name="trade_method" id="both4them">
                                        <label class="form-check-label" for="both4them">
                                            Item and money for them
                                        </label>
                                    </div>
                                </div>
                                <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                                <div id="exchange_amount" class="mb-3">
                                    <label for="amount" class="col-form-label">Amount($)</label>
                                    <input type="number" class="form-control" id="amount" name="amount" value="0" placeholder="Amount">
                                </div>
                                <div id="exchagne_gallery" class="mb-3">
                                    <h5>Image Gallery</h5>
                                    <span>Upload images to the gallery to show the condition of the sports jersey/ sports card. </span>
                                    <div class="mb-3 text-center">
                                        <label for="product_photos">
                                            <button type="button" id="uitp_gallery" class="btn btn-primary btn-circle btn-lg">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </label>
                                        <div style="visibility:hidden">
                                            <input type="file" id='product_photos' name="files" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="mb-3 text-center">
                                        <div id="img-gallery" class="row g-3 img-gallery-uploader">
                                        </div>
                                    </div>
                                    <div class="file-upload-content">
                                        <img class="file-upload-image" src="#" alt="your image" />
                                        <div class="image-title-wrap">
                                            <button type="button" onclick="removeUpload()" class="remove-image">
                                                Remove <span class="image-title">Uploaded Image</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button id="post-offer-btn" type="submit" class="btn btn-primary">Post Offer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endauth
@endsection

@section('custom-scripts')
<script>
    $(document).ready(function() {
        $("#exchange_amount").css("display","none");
        $("#exchagne_gallery").css("display","none");

        $('input[type="radio"]').bind('click', function(){
            console.log(this.id);
            if(this.id == 'item4item'){
                $("#exchange_amount").css("display","none");
                $("#exchagne_gallery").css("display","block");
            }else if(this.id == 'money4item'){
                $("#exchange_amount").css("display","block");
                $("#exchagne_gallery").css("display","none");
            }else if(this.id == 'both4them'){
                $("#exchange_amount").css("display","block");
                $("#exchagne_gallery").css("display","block");
            }

        });

    }); 
</script>
@endsection
