@extends('../../layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-settings bg-blue"></i>
                        <div class="d-inline">
                            <h5>Settings</h5>
                            <span>Get the control over the system and update settings!</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('admin/dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ url('admin/testimonials') }}">Testimonials</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Components</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                @if (session('success-prices'))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> {{ session('success-prices') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="ik ik-x"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h3>Prices</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ url('admin/settings/prices') }}">
                            @csrf
                            <div class="form-group">
                                <label for="shipping">Shipping Price ($) *</label>
                                <input type="number" class="form-control @error('shipping') is-invalid @enderror" id="shipping" placeholder="Minimum Price is $1" name="shipping"
                                    value="{{ $settings['prices']['shipping']->setting_value ?? 20 }}" min="1" required>
                                @error('shipping')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="security">Security Fee ($) *</label>
                                <input type="number" class="form-control @error('security') is-invalid @enderror" id="security" placeholder="Minimum Price is $1" name="security"
                                    value="{{ $settings['prices']['security']->setting_value ?? 30 }}" min="1" required>
                                @error('security')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary mr-2">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                @if (session('success-banner'))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> {{ session('success-banner') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="ik ik-x"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h3>Home Page Banner</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ url('admin/settings/banner') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @if(isset($settings['banner']) && !empty($settings['banner']))
                                <div class="form-group">
                                    <img src="{{asset($settings['banner']->setting_value)}}" width="100%" class="rounded">
                                </div>
                                <div class="form-group">
                                    <a href="{{$settings['banner_link']->setting_value}}" target="_blank">{{$settings['banner_link']->setting_value}}
                                    </a>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="banner">Banner *</label>
                                <input type="file" class="form-control" id="banner" name="banner" accept="image/*" required>
                            </div>
                            <div class="form-group">
                                <label for="banner">Call to action(URL Link) *</label>
                                <input type="url" class="form-control" id="banner" name="link" required>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary mr-2">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
