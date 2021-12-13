@if(session('success'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success fade show" role="alert">
                    <strong>Success!</strong> {{session('success')}}
                </div>
            </div>
        </div>
@endif
<form method="POST" action="{{ url('change/password') }}">
    @csrf
    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-3 col-form-label">Old Password</label>
        <div class="col-sm-9">
            <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror"
                placeholder="Old Password" name="old_password" required>
            @error('old_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
    </div>
    <div class="mb-3 row">
        <label for="staticEmail" class="col-sm-3 col-form-label">New Password</label>
        <div class="col-sm-9">
            <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror"
                placeholder="New Password" name="new_password" required>
            @error('new_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="mb-3 row">
        <label for="confirm-password" class="col-sm-3 col-form-label">Confirm Password</label>
        <div class="col-sm-9">
            <input id="confirm-password" type="password"
                class="form-control @error('confirm-password') is-invalid @enderror" placeholder="Confirm Password"
                name="confirm-password" required>
            @error('confirm-password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="mb-3 text-end">
        <button type="submit" class="btn btn-primary">Change Password</button>
    </div>
</form>
