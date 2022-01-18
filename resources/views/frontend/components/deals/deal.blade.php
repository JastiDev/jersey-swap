<section id="single-listing">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-single-listing-div mt-md-5 mb-md-5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{static_url('products_featured/'.$listing->product_img)}}" class="w-100">
                            </div>
                            <div class="col-md-8">
                                @if($listing->status=="cancelled")
                                    <span class="badge bg-danger">Canelled</span>
                                @endif
                                @if($listing->deal!==null)
                                <h5><span class="text-green font-weight-bold">Deal#</span> {{$listing->deal->deal_number}}</h5>
                                @endif
                                <h1>{{__($listing->product_title)}}</h1>
                                <div class="description mb-3">
                                    {{__($listing->product_description)}}
                                </div>
                                <div class="gallery mb-3">
                                   @foreach($listing_gallery as $img)
                                        <a href="{{static_url('products/'.$img->image)}}" target="_blank">
                                            <img src="{{static_url('products/'.$img->image)}}" class="rounded" alt="...">
                                        </a>
                                    @endforeach
                                </div>
                                @if($listing->status!="cancelled" && $listing->status!="closed")
                                    <div class="mb-3">
                                        <form method="POST" action="{{url('listing/cancel')}}">
                                            @csrf
                                            <input type="hidden" name="listing" value="{{$listing->id}}">
                                            <button type="submit" class="btn btn-danger"> <i class="fa fa-trash"></i> Cancel
                                                Listing</button>
                                            @if($listing->listingOffers()<=0)
                                                <a href="{{url('listing/edit/'.$listing->id)}}" class="btn btn-success"><i class="fa fa-pencil"></i> Edit Listing</a>
                                            @endif
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
