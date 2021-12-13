@extends('../../layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            @if($deal->deal_status!=="cancelled" && $deal->deal_status!=="completed")
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Actions
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="POST" class="d-inline" action="{{url('admin/deals/'.$deal->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Cancel Deal</button>
                                </form>
                                <form class="d-inline">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#demoModal">Add Tracking</button>
                                </form>
                                <form method="POST" class="d-inline" action="{{url('admin/deals/'.$deal->id)}}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Mark as Completed</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Tracking Modal Form --}}
            <div class="modal fade" id="demoModal" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="demoModalLabel">Record Tracking</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form method="POST" action="{{url('admin/deals/tracking/'.$deal->id)}}">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="deal_id" value="{{$deal->id}}">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Jersey Recieved" required="">
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea name="message" class="form-control" id="message" placeholder="Jersey Recieved by user" required=""></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            @elseif($deal->deal_status=="completed")
                <div class="col-md-12">
                    <div class="alert alert-success" role="alert">
                        Deal has been completed!
                    </div>
                </div>
            @elseif($deal->deal_status=="cancelled")
                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        Deal has been cancelled!
                    </div>
                </div>
            @endif
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        Deal# <span class="badge badge-success">{{$listing->deal->deal_number}}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Listing
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{asset($listing->product_img)}}" width="100%">
                            </div>
                            <div class="col-md-8">
                                <h1>{{$listing->product_title}}</h1>
                                <p>{{$listing->product_description}}</p>
                                <hr>
                                <h6>Gallery</h6>
                                <div class="row">
                                    @foreach($listing_gallery as $listing_image)
                                        <div class="col-md-2">
                                            <a href="{{asset('storage/products/'.$listing_image->image)}}" target="_blank">
                                                <img src="{{asset('storage/products/'.$listing_image->image)}}" width="100%">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Offer
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h1>Offer Price : ${{$offer->offer_price}}</h1>
                            </div>
                            <div class="col-md-8">
                                <h6>Gallery</h6>
                                <div class="row">
                                    @foreach($offer_gallery as $listing_image)
                                        <div class="col-md-2">
                                            <a href="{{asset('storage/offers/'.$listing_image->image)}}" target="_blank">
                                                <img src="{{asset('storage/offers/'.$listing_image->image)}}" width="100%">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h1>List Maker Invoice</h1>
                        @if($list_maker_invoice!==null && $list_maker_invoice->invoice_status=="unpaid")
                            <span class="badge badge-danger" style="margin-left:2px;">Unpaid</span>
                        @elseif($list_maker_invoice!==null && $list_maker_invoice->invoice_status=="paid")
                            <span class="badge badge-success" style="margin-left:2px;">Paid</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <p>Invoice For <a href="{{url('user/'.$listing->owner->username)}}" target="_blank"><span class="badge badge-dark">{{$listing->owner->username}}</span></a></p>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($list_maker_invoice->invoice_meta() as $meta)
                                            <tr>
                                                <td>
                                                    @if($meta->meta_key=="f_name")
                                                        First Name
                                                    @elseif($meta->meta_key=="l_name")
                                                        Last Name
                                                    @elseif($meta->meta_key=="shipping_address")
                                                        Shipping Address
                                                    @else
                                                        {{ucfirst($meta->meta_key)}}
                                                    @endif
                                                </td>
                                                <td>{{$meta->meta_value}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="bg-dark text-white">
                                        <tr>
                                            <td>Total:</td>
                                            <td>$ {{$list_maker_invoice->billable_amount}}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h1>Offer Maker Invoice</h1>
                        @if($list_maker_invoice!==null && $offer_maker_invoice->invoice_status=="unpaid")
                            <span class="badge badge-danger" style="margin-left:2px;">Unpaid</span>
                        @elseif($offer_maker_invoice!==null && $offer_maker_invoice->invoice_status=="paid")
                            <span class="badge badge-success" style="margin-left:2px;">Paid</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <p>Invoice For <a href="{{url('user/'.$offer->owner->username)}}" target="_blank"><span class="badge badge-dark">{{$offer->owner->username}}</span></a></p>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($offer_maker_invoice->invoice_meta() as $meta)
                                            <tr>
                                                <td>
                                                    @if($meta->meta_key=="f_name")
                                                        First Name
                                                    @elseif($meta->meta_key=="l_name")
                                                        Last Name
                                                    @elseif($meta->meta_key=="shipping_address")
                                                        Shipping Address
                                                    @else
                                                        {{ucfirst($meta->meta_key)}}
                                                    @endif
                                                </td>
                                                <td>{{$meta->meta_value}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="bg-dark text-white">
                                        <tr>
                                            <td>Total:</td>
                                            <td>$ {{$offer_maker_invoice->billable_amount}}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-md-12">
                <div class="card latest-update-card">
                    <div class="card-header">
                        <h3>Tracking</h3>
                    </div>
                    <div class="card-block">
                        <div class="scroll-widget">
                            <div class="latest-update-box">
                                @foreach($deal_tracking as $tracking)
                                <div class="row pt-20 pb-30">
                                    <div class="col-auto text-right update-meta pr-0">
                                        <i class="b-primary update-icon ring"></i>
                                    </div>
                                    <div class="col pl-5">
                                        <a href="#!">
                                            <h6>{{$tracking->title}}</h6>
                                        </a>
                                        <p class="text-muted mb-0">{{$tracking->message}}</p>
                                        <p class="text-muted mb-0"><b>Dated</b> {{date('d M , Y',strtotime($tracking->created_at))}}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
