@error('avatar')
<div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger fade show" role="alert">
                    <strong>Error!</strong> {{$message}}
                </div>
            </div>
        </div>
@enderror

@if(session('success'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success fade show" role="alert">
                    <strong>Success!</strong> {{session('success')}}
                </div>
            </div>
        </div>
@endif

<form method="POST" action="{{ url('users/settings/profile-photo') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <p>Hover over the profile picture to update.</p>
    </div>
    <div class="mb-3">
        <div class="upload_avatar mx-auto">
            @if(auth()->user()->profile_picture!='default-user.png')
                <img src="{{static_url('avatar/'.auth()->user()->profile_picture)}}" class="avatar">
            @else
                <img src="{{asset('assets/images/default-user.png')}}" class="avatar">
            @endif
            <div class="overlay">
                <button id="update_profile_photo_btn" type="button" class="btn"><i class="fa fa-camera"></i></button>
            </div>
        </div>
        <div style="visibility:hidden">
            <input id="avatar" type="file" accept="image/*" name="avatar">
        </div>
    </div>
</form>
