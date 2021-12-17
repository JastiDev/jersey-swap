@extends ('../../layouts/app')
@section('title')
    Notifications - Jersey Swap
@endsection
@section('content')
    <section id="dashboard" class="pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div id="deals-table" class="deals-table">
                            <div class="filter-title">
                                <div class="row">
                                    <div class="col-6">
                                        Notifications
                                    </div>
                                    <div class="col-6 text-end">
                                        <a href="{{url('notification/markallasread')}}" class="btn btn-sm btn-success btn-markall-notifications"> <i class="fa fa-check"></i> Mark All as Read</a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover w-100">
                                    <thead>
                                        <td width="20px"></td>
                                        <td></td>
                                        <td></td>
                                    </thead>
                                    <tbody>
                                    @foreach($notifications as $notification)
                                        <tr>
                                            <td>
                                            @if($notification->type=="App\Notifications\AccountCreated")
                                                <i class="fas fa-thumbs-up notification-icon"></i>
                                            @elseif($notification->type=="App\Notifications\ListingCreated")
                                                <i class="far fa-smile-beam notification-icon"></i>
                                            @elseif($notification->type=="App\Notifications\ListingNotification")
                                                @if($notification->data['type']=="cancelled")
                                                    <i class="fas fa-sad-tear notification-icon"></i>
                                                @endif
                                            @elseif($notification->data['type']=='listing')
                                                <i class="fas fa-times notification-icon"></i>
                                            @else
                                                <i class="fa fa-check notification-icon"></i>
                                            @endif
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div id="notify_img" class="col-md-2 col-12 mb-md-0 mb-2">
                                                        @if(isset($notification->data['image_url']))
                                                            <img src="{{$notification->data['image_url']}}" class="product_img" alt="Jersey Swap">
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6 col-12 mb-md-0 mb-2">
                                                        {{$notification->data['message']}}
                                                    </div>
                                                    <div class="col-md-4 col-12 text-end">
                                                        @if($notification->data['url']!==null)
                                                        <a href="{{$notification->data['url']}}" class="btn btn-sm btn-success ">{{$notification->data['url_text']}}</a>
                                                        @endif
                                                        <a href="{{url('notification/markasread/'.$notification->id)}}" class="btn btn-sm btn-success">Mark as Read</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            {{--<div class="text-center mb-3">
                                <button class="btn btn-primary">
                                    Load More
                                </button>
                            </div>--}}
                        </div>
                    </div>
                </div>
        </section>
@endsection