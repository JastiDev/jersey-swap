<section id="offers" class="mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>@if($deal!==null || count($offers)==1) Offer @else Offers @endif</h2>
                <hr>
                @if(count($offers)>0)
                    @foreach($offers as $offer)
                        <div class="card card-offer mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1">
                                        <img class="avatar" src="{{ static_url('avatar/'.$offer->owner->profile_picture) }}">
                                    </div>
                                    <div class="col-md-11">
                                        <div class="row">
                                            <div class="col">
                                                <p>By <a href="#">{{$offer->owner->username}}</a></p>
                                            </div>
                                            @if($offer->offer_price>0)
                                            <div class="col text-end">
                                                <div class="amount">
                                                    ${{$offer->offer_price}}
                                                </div>
                                            </div>
                                            @endif
                                        </div>


                                        <div class="description mb-3">
                                            @if($offer->offer_price>0 && count($offer->gallery)==0)
                                                I want to swap jersey for the ${{$offer->offer_price}}.
                                            @elseif($offer->offer_price===0 && count($offer->gallery)>=1)
                                                I want to swap jersey and give you my jersey in exchange of your jersey.
                                            @elseif($offer->offer_price>0 && count($offer->gallery)>=1)
                                                I want to sawp jersey and will give you my jersey and $${{$offer->offer_price}}.
                                            @endif
                                        </div>

                                        <div class="gallery mb-3">
                                        @foreach($offer->gallery as $img)
                                            <a href="{{ asset('storage/offers/' . $img->image) }}" target="__blank">
                                                <img src="{{ asset('storage/offers/' . $img->image) }}" class="rounded" alt="...">
                                            </a>
                                        @endforeach
                                        </div>


                                        <div class="buttons text-end">
                                            <form>
                                                <input type="hidden">
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Decline
                                                    Offer</button>
                                            </form>
                                            <form>
                                                <input type="hidden">
                                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Accept
                                                    Offer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card card-offer mb-3">
                            <div class="card-body text-center pt-5 pb-5">
                                <h3>Oops...</h3>
                                <p>No Offer recieved yet, check again later!</p>
                            </div>
                        </div>
                @endif
            </div>
        </div>
    </div>
</section>
