@extends('../../layouts.admin')
@section('content')
    <div class="container-fluid">

        @if(session('success'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="ik ik-x"></i>
                    </button>
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header row">
                        <div class="col col-sm-3">
                            <div class="card-options d-inline-block">
                                <a href="{{url('admin/testimonials/add-new')}}" class="btn btn-icon btn-primary text-white"><i class="ik ik-plus"></i></a>
                            </div>
                        </div>
                        <div class="col col-sm-6">
                            <div class="card-search with-adv-search dropdown">
                                <form action="">
                                    <input type="text" class="form-control global_filter" id="global_filter"
                                        placeholder="Search.." required>
                                    <button type="button" class="btn btn-icon"><i class="ik ik-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="col col-sm-3">
                            <div class="card-options text-right">
                                <span class="mr-5" id="top">1 - 50 of 2,500</span>
                                <a href="#"><i class="ik ik-chevron-left"></i></a>
                                <a href="#"><i class="ik ik-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="advanced_table" class="table w-100 ml-0">
                            <thead>
                                <tr>
                                    <th class="nosort">Avatar</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th class="nosort">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($testimonials as $testimonial)
                                    <tr>
                                        <td><img src="{{ asset($testimonial->avatar) }}" class="table-user-thumb" alt="avatar"></td>
                                        <td>{{ $testimonial->name }}</td>
                                        <td>{{ $testimonial->designation }}</td>
                                        <td>
                                            <div class="table-actions">
                                                <a href="{{ url('/admin/testimonials/'.$testimonial->id) }}"><i
                                                        class="ik ik-eye"></i></a>

                                                <a href="{{ route('testimonial-delete', $testimonial->id) }}"><i
                                                        class="ik ik-trash-2"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
