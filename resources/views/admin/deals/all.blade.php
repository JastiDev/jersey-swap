@extends('../../layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="advanced_table" data-order='[[ 0, "desc" ]]' class="table w-100 ml-0">
                            <thead>
                                <tr>
                                    <th>Sr #</th>
                                    <th class="nosort">Deal #</th>
                                    <th class="nosort">Product</th>
                                    <th>Title</th>
                                    <th>Created at</th>
                                    <th>Status</th>
                                    <th class="nosort">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($deals as $deal)
                                <tr>
                                    <td>{{$deal->id}}</td>
                                    <td>{{$deal->deal_number}}</td>
                                    <td>
                                        <img src="{{asset($deal->listing->product_img)}}" class="table-user-thumb" alt="">
                                    </td>
                                    <td>{{$deal->listing->product_title}}</td>
                                    <td>{{date('d M , Y',strtotime($deal->created_at))}}</td>
                                    <td>
                                        @if($deal->deal_status=="progress")
                                            <span class="badge badge-warning">Progress</span>
                                        @elseif($deal->deal_status=="completed")
                                            <span class="badge badge-success">Completed</span>
                                        @elseif($deal->deal_status=="cancelled")
                                            <span class="badge badge-danger">Cancelled</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="{{ url('admin/deal/'.$deal->id) }}" class="btn btn-success text-white"><i
                                                class="ik ik-eye"></i>
                                            </a>
                                            @if($deal->deal_status=="progress")
                                                <form method="POST" action="{{url('admin/deals/'.$deal->id)}}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-theme">
                                                        <i class="ik ik-trash-2"></i>
                                                    </button>
                                                </form>
                                            @endif
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
