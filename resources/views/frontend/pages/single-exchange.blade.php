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
                <div class="col-md-8 mx-auto">
                    <h1>{{ $listing->product_title }}</h1>
                        @if($listing->authentic)
                        <small style="color: green;">Authentic</small>
                        @else
                        <small style="color: dark;">Non Authentic</small>
                        @endif
                    <div class="product-meta d-flex flex-row">
                        <div class="user-avatar p-1">
                            <img src="{{ asset($listing->user->profile_picture) }}" class="avatar" alt="User Avatar">
                        </div>
                        <div class="user-name align-self-center">
                            By <a href="{{url('user/'.$listing->owner->username)}}">{{$listing->owner->username}}</a>
                        </div>
                    </div>
                    <img id="featured" src="{{ asset($listing->product_img) }}" width="100%" alt="{{$listing->product_title}}">
                    <div style="margin-top: 8px; color: green; font-weight: bold;">
                        <span>Buy Now: ${{$listing->price}}</span>
                    </div>
                    <div class="description mt-2 mb-2">
                        <h3>Description</h3>
                        <p>{{ $listing->product_description }}</p>
                    </div>
                    <div class="gallery mb-3">
                        @foreach ($listing_gallery as $img)
                            <a href="{{ asset('storage/products/' . $img->image) }}" target="_blank">
                                <img src="{{ asset('storage/products/' . $img->image) }}" class="rounded" alt="Listing Gallery">
                            </a>
                        @endforeach
                    </div>
                    @auth
                        @if (auth()->user()->id !== $listing->posted_by && auth()->user()->role->role!=="admin")
                            <div class="text-end" style="display: flex; justify-content: flex-end">
                              <form method="POST" action="{{ url('offer/post') }}">
                                @csrf
                                <input type="hidden" name="listing_id"  value="{{$listing->id}}">
                                <input type="hidden" name="amount"  value="{{$listing->price}}">
                                <input type="hidden" name="isBuy"  value="true">
                                <button type="submit" class="btn btn-success">
                                    Buy it now
                                </button>
                              </form>

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" style="margin-left: 8px"
                                    data-bs-target="#exampleModal">
                                    Make trade Offer
                                </button>
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
                        <div class="text-end">
                            <a href="{{url('login')}}" class="btn btn-success"> Log in to make offer</a>
                        </div>
                    @endguest
                </div>
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
                                <p>Users can make trade offers! Offers can be made:</p>
                                <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <img src="{{asset($listing->product_img)}}" width="100%">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="amount" class="col-form-label">Amount($)</label>
                                    <input type="number" class="form-control" id="amount" name="amount" placeholder="Amount">
                                </div>
                                <div class="mb-3">
                                    <h5>Upload Image Gallery</h5>
                                    <span>Upload Images to the Gallery Which Describes the Condition of the Sports Jersey. </span>
                                </div>
                                <div class="mb-3 text-center">
                                    <label for="product_photos">
                                        <button type="button" id="uitp_gallery" class="btn btn-primary btn-circle btn-lg"><i
                                                class="fa fa-plus"></i></button>
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
                                        <button type="button" onclick="removeUpload()" class="remove-image">Remove <span
                                                class="image-title">Uploaded Image</span></button>
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
