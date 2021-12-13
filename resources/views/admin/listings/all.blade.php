@extends('../../layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="advanced_table" class="table w-100 ml-0">
                            <thead>
                                <tr>
                                    <th class="nosort">Product</th>
                                    <th>Title</th>
                                    <th>Posted By</th>
                                    <th>Created at</th>
                                    <th>Status</th>
                                    <th class="nosort">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($listings as $listing)
                                <tr>
                                    <td>
                                        <img src="{{asset($listing->product_img)}}" class="table-user-thumb" alt="">
                                    </td>
                                    <td>{{$listing->product_title}}</td>
                                    <td>{{$listing->owner->f_name." ".$listing->owner->l_name}}</td>
                                    <td>{{date('d M, Y', strtotime($listing->created_at))}}</td>
                                    <td>
                                    @if($listing->status=="posted")
                                    <span class="badge badge-success">Active</span>
                                    @elseif($listing->status=="closed")
                                    <span class="badge badge-warning">Started Deal</span>
                                    @else
                                    <span class="badge badge-danger">Cacnelled</span>
                                    @endif
                                    <td>
                                        <div class="table-actions">
                                            <a href="#"><i class="ik ik-eye"></i></a>
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
