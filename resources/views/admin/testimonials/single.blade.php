@extends('../../layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>Testimonials</h5>
                            <span>Show positive face of your company to your potential customers.</span>
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
                @if (session('success'))
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="ik ik-x"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h3>Testimonial</h3>
                    </div>
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ url('admin/testimonials/update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{ $testimonial->id }}">
                            <div class="form-group">
                                <label for="name">Full Name *</label>
                                <input type="text" class="form-control" id="name" placeholder="Full Name" name="name"
                                    value="{{ $testimonial->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="designation">Designation *</label>
                                <input type="text" class="form-control" id="designation" placeholder="Designation"
                                    name="designation" value="{{ $testimonial->designation }}" required>
                            </div>
                            <div class="form-group">
                                <img src="{{static_url('testimonials/'.$testimonial->avatar)}}" width="100%" class="rounded">
                            </div>
                            <div class="form-group">
                                <label for="avatar">Avatar</label>
                                <input type="file" class="form-control" id="avatar" placeholder="Avatar" name="avatar"
                                    accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="description">Decription *</label>
                                <textarea class="form-control" id="description" rows="4" name="description"
                                    required>{{ $testimonial->description }}</textarea>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary mr-2">Save Changes</button>
                                <a href="{{route('testimonial-delete',$testimonial->id)}}" class="btn btn-danger">Delete</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
