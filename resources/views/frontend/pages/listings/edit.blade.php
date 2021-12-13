@extends ('../../layouts/app')
@section('title')
    Edit Listing - Jersey Swap
@endsection
@section('content')
    <section id="dashboard" class="pt-5 pb-5">
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
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h1>Post Details About Your Sports Jersey to Get Offers</h1>
                                <hr>
                                <form id="product-upload-form" method="POST" action="{{url('/listing/update')}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="listing_id" value="{{$listing->id}}">
                                    <div class="mb-3">
                                        <label for="product_title" class="form-label">Product Title</label>
                                        <input type="text" class="form-control @error('product_title') is-invalid @enderror" id="product_title" placeholder="Product Title" value="{{$listing->product_title}}" name="product_title" required>
                                        @error('product_title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6 mb-3">
                                          <label for="price" class="form-label">Price($)</label>
                                          <input type="number" class="form-control" id="price" min="1" name="price"  value="{{$listing->price}}">
                                      </div>
                                      <div class="col-md-6 mb-3">
                                          <label for="category" class="form-label">Category</label>
                                          <select name="category" id="category" class="form-control" value=1>
                                              <option value = 0 @if($listing->category==0) selected="selected" @endif>Jersey</option>
                                              <option value = 1 @if($listing->category==1) selected="selected" @endif>Card</option>
                                          </select>
                                      </div>
                                    </div>                                        <label for="product_description" class="form-label">Description</label>
                                        <textarea class="form-control @error('product_description') is-invalid @enderror" id="product_description" rows="5" name="product_description" required>{{$listing->product_description}}</textarea>
                                        @error('product_description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <img src="{{asset($listing->product_img)}}" width="30%">
                                    <div class="mb-3">
                                        <label for="product_img" class="form-label">Featured Image</label>
                                        <input type="file" class="form-control @error('product_img') is-invalid @enderror" id="product_img" accept="image/*" name="product_img">
                                        @error('product_img')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <p>Jersey Status</P>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="authenticity" id="inlineRadio1" value="1" @if($listing->authentic==1) checked="" @endif>
                                            <label class="form-check-label" for="inlineRadio1">Authentic</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="authenticity" id="inlineRadio2" value="0" @if($listing->authentic==0) checked="" @endif>
                                            <label class="form-check-label" for="inlineRadio2">Not Authentic</label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <h2>Upload Image Gallery</h2>
                                        <small>Gallery images are used to show the condition of the sports jersey.</small>
                                    </div>
                                    <div class="mb-3 text-center">
                                        <label for="product_photos">
                                            <button type="button" id="uitp_gallery" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-plus"></i></button>
                                        </label>
                                        <div style="visibility:hidden">
                                            <input type="file" id='product_photos' name="file" accept="image/*">
                                        </div>

                                    </div>
                                    <div id="delete-files">
                                    </div>
                                    {{-- Listing Gallery --}}
                                    <div class="mb-3 text-center">
                                        <div id="img-gallery" class="row g-3 img-gallery-uploader">
                                            @foreach($listing_gallery as $listing_data)
                                            <div class="col-md-3">
                                                <div class="img-box">
                                                    <img src="{{asset('storage/products/'.$listing_data->image)}}" data-img="{{$listing_data->id}}">
                                                    <button class="btn btn-circle btn-remove">
                                                    <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="mb-3 text-end">
                                        <button id="post-listing-btn" type="submit" class="btn btn-primary">Update Listing</button>
                                    </div>
                                    <div id="spinner" class="text-end"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
@endsection
