@extends('../../layouts.admin')
@section('content')
    <div class="container-fluid">
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
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="advanced_table" class="table w-100 ml-0">
                            <thead>
                                <tr>
                                    <th class="nosort">Avatar</th>
                                    <th>Full Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Joined at</th>
                                    <th>Account</th>
                                    <th class="nosort">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    @if($user->role->role=='user')
                                    <tr>
                                        <td><img src="{{ asset($user->profile_picture) }}" class="table-user-thumb" alt=""></td>
                                        <td>{{ $user->f_name . ' ' . $user->l_name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ date('d M, Y', strtotime($user->created_at)) }}</td>
                                        <td>
                                        @if($user->banned)
                                        <span class="badge badge-danger">Banned</span>
                                        @else
                                        <span class="badge badge-success">Active</span>
                                        @endif
                                        </td>
                                        <td>
                                            <div class="table-actions">
                                                <a href="{{url('/admin/users/'.$user->id)}}"><i class="ik ik-eye"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
