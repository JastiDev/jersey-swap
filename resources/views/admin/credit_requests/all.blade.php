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
                                    <th class="nosort">User</th>
                                    <th>Credit</th>
                                    <th>Created at</th>
                                    <th>Status</th>
                                    <th class="nosort">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($credit_requests as $credit)
                                <tr>
                                    <td>
                                        <a href="{{url('admin/users/'.$credit->user_id)}}">
                                            <img src="{{static_url('avatar/'.$credit->owner->profile_picture)}}" class="table-user-thumb" alt="">
                                        </a>
                                    </td>
                                    <td>$ {{$credit->credit}}</td>
                                    <td>{{date('d M , Y',strtotime($credit->created_at))}}</td>
                                    <td>
                                        @if($credit->status=="progress")
                                            <span class="badge badge-warning">Progress</span>
                                        @elseif($credit->status=="completed")
                                            <span class="badge badge-success">Completed</span>
                                        @elseif($credit->status=="cancelled")
                                            <span class="badge badge-danger">Cancelled</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="table-actions">
                                            @if($credit->status=="progress")
                                                <form method="POST" action="{{url('admin/credit-requests/'.$credit->id)}}" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">
                                                        Withdrawn
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{url('admin/credit-requests/'.$credit->id)}}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-theme">
                                                        Cancel Request
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
