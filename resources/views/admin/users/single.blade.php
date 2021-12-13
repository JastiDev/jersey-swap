@extends('../../layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user bg-blue"></i>
                        <div class="d-inline">
                            <h5>@ {{$user->username}}</h5>
                            <span>User Profile</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin-dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Pages</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{asset($user->profile_picture)}}" class="rounded-circle" width="150" />
                            <h4 class="card-title mt-10">{{$user->f_name." ".$user->l_name}}</h4>
                            <p class="card-subtitle">{{$user->tag_line}}</p>
                        </div>
                    </div>
                    <hr class="mb-0">
                    <div class="card-body">
                        <small class="text-muted d-block">Email address </small>
                        <h6>{{$user->email}}</h6>
                        <small class="text-muted d-block pt-10">Phone</small>
                        <h6>{{$user->phone}}</h6>
                        <small class="text-muted d-block pt-10">Address</small>
                        <h6>{{$user->address}}</h6>
                        <small class="text-muted d-block pt-10">Credit</small>
                        <h6>${{$user->creditInNumber()}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="card">
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab"
                                aria-controls="pills-profile" aria-selected="true">Profile</a>
                        </li>
                        {{--
                        <li class="nav-item">
                            <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab"
                                aria-controls="pills-setting" aria-selected="false">Setting</a>
                        </li>
                        --}}
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 col-6"> <strong>Full Name</strong>
                                        <br>
                                        <p class="text-muted">{{$user->f_name." ".$user->l_name}}</p>
                                    </div>
                                    <div class="col-md-3 col-6"> <strong>Mobile</strong>
                                        <br>
                                        <p class="text-muted">{{$user->phone}}</p>
                                    </div>
                                    <div class="col-md-3 col-6"> <strong>Email</strong>
                                        <br>
                                        <p class="text-muted">{{$user->email}}</p>
                                    </div>
                                    <div class="col-md-3 col-6"> <strong>Postcode</strong>
                                        <br>
                                        <p class="text-muted">{{$user->postcode}}</p>
                                    </div>
                                </div>
                                <hr>
                                <p class="mt-30">{{$user->about}}</p>
                               
                                <div class="">
                                    {{--<form method="POST" action="" class="d-sm-inline">
                                        <button type="submit" class="btn btn-success">View Listing</button>
                                    </form>
                                    <form method="POST" action="" class="d-sm-inline">
                                        <button type="submit" class="btn btn-success">View Deals</button>
                                    </form>--}}
                                    @if($user->banned==0)
                                    <a href="{{url('admin/users/delete/'.$user->id)}}" class="btn btn-danger" title="Ban Account">Ban Account</a>
                                    @else
                                    <a href="{{url('admin/users/undelete/'.$user->id)}}" class="btn btn-danger" title="Unban Account">UnBan Account</a>
                                    <a href="{{url('admin/clear-funds/'.$user->id)}}" class="btn btn-success" title="Cancel withdrawl request and clear funds.">Clear Funds</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{--
                        <div class="tab-pane fade" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="example-name">Full Name</label>
                                        <input type="text" placeholder="Johnathan Doe" class="form-control"
                                            name="example-name" id="example-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email">Email</label>
                                        <input type="email" placeholder="johnathan@admin.com" class="form-control"
                                            name="example-email" id="example-email">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-password">Password</label>
                                        <input type="password" value="password" class="form-control" name="example-password"
                                            id="example-password">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-phone">Phone No</label>
                                        <input type="text" placeholder="123 456 7890" id="example-phone"
                                            name="example-phone" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-message">Message</label>
                                        <textarea name="example-message" name="example-message" rows="5"
                                            class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-country">Select Country</label>
                                        <select name="example-message" id="example-message" class="form-control">
                                            <option>London</option>
                                            <option>India</option>
                                            <option>Usa</option>
                                            <option>Canada</option>
                                            <option>Thailand</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-success" type="submit">Update Profile</button>
                                </form>
                            </div>
                        </div>
                        --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
