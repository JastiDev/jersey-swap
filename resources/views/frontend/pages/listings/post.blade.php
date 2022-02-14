@extends ('../../layouts/app')
@section('title')
    Add New Listing - Jersey Swap
@endsection
@section('content')
    <section id="dashboard" class="pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h3>Fill out details about your item to get offers!</h3>
                                <hr>
                                <form id="product-upload-form" method="POST" action="{{url('/listings/add-listing')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="product_title" class="form-label">Product Title</label>
                                        <input type="text" class="form-control border border-1 @error('product_title') is-invalid @enderror" id="product_title" placeholder="Product Title" name="product_title" required>
                                        @error('product_title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="price" class="form-label">Price($)</label>
                                            <input type="number" class="form-control border border-1" id="price" min="1" name="price" value="0">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="category" class="form-label">Category</label>
                                            <select name="category" id="category" class="form-control form-select border border-1">
                                                <option value = 0>Jersey</option>
                                                <option value = 1>Card</option>
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="mb-3">
                                        <label for="product_description" class="form-label">Description</label>
                                        <textarea class="form-control border border-1 @error('product_description') is-invalid @enderror" id="product_description" rows="5" name="product_description" required></textarea>
                                        @error('product_description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="product_img" class="form-label">Featured Image</label>
                                        <input type="file" class="form-control border border-1 @error('product_img') is-invalid @enderror" id="product_img" accept="image/*" name="product_img" required>
                                        @error('product_img')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <p>Item Status</P>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="authenticity" id="inlineRadio1" value="1">
                                            <label class="form-check-label" for="inlineRadio1">Authentic</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="authenticity" id="inlineRadio2" value="0" checked="">
                                            <label class="form-check-label" for="inlineRadio2">Not Authentic</label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <h4>Image Gallery</h4>
                                        <small>Gallery images are used to show the condition of the sports jersey or sports card.</small>
                                    </div>
                                    <div class="mb-3 text-center">
                                        <label for="product_photos">
                                            <button type="button" id="uitp_gallery" class="btn btn-primary btn-circle btn-lg"><i class="fa fa-plus"></i></button>
                                        </label>
                                        <div style="visibility:hidden">
                                            <input type="file" id='product_photos' name="file" accept="image/*">
                                        </div>

                                    </div>
                                    {{-- Listing Gallery --}}
                                    <div class="mb-3 text-center">
                                        <div id="img-gallery" class="row g-3 img-gallery-uploader">
                                            
                                        </div>
                                    </div>

                                    <div class="mb-3 text-center">
                                        <button id="post-listing-btn" type="submit" class="btn btn-primary">Post Listing</button>
                                    </div>
                                    <div id="spinner" class="text-center"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
@endsection
