<form id="user-account" method="POST" action="{{ url('users/settings/account') }}">
    @csrf
    
    {{-- First Name --}}
    <div class="mb-3 row">
        <label for="f_name" class="col-sm-3 col-form-label">First Name</label>
        <div class="col-sm-9">
            <input id="f_name" type="text" class="form-control @error('f_name') is-invalid @enderror" name="f_name"
                placeholder="First Name" value="{{ $user->f_name }}" required>
            @error('f_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    {{-- Last Name --}}
    <div class="mb-3 row">
        <label for="l_name" class="col-sm-3 col-form-label">Last Name</label>
        <div class="col-sm-9">
            <input id="l_name" type="text" class="form-control @error('l_name') is-invalid @enderror" name="l_name"
                placeholder="Last Name" value="{{ $user->l_name }}" required>
            @error('l_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    {{-- Phone --}}
    <div class="mb-3 row">
        <label for="phone" class="col-sm-3 col-form-label">Phone</label>
        <div class="col-sm-9">
            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                placeholder="Phone" value="{{ $user->phone }}" required>
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    {{-- Postcode --}}
    <div class="mb-3 row">
        <label for="postcode" class="col-sm-3 col-form-label">Postcode</label>
        <div class="col-sm-9">
            <input id="postcode" type="text" class="form-control @error('postcode') is-invalid @enderror"
                name="postcode" placeholder="Postcode" value="{{ $user->postcode }}" required>
            @error('postcode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    {{-- Address --}}
    <div class="mb-3 row">
        <label for="l_name" class="col-sm-3 col-form-label">Address</label>
        <div class="col-sm-9">
            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                placeholder="Address" value="{{ $user->address }}" required>
            @error('l_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    {{-- About --}}
    <div class="mb-3 row">
        <label for="about" class="col-sm-3 col-form-label">About</label>
        <div class="col-sm-9">
            <textarea id="about" type="text" class="form-control @error('about') is-invalid @enderror" name="about"
                placeholder="Ex… I collect football sports jerseys and want to trade for hockey jerseys."
                rows="5" required>{{ $user->about }}</textarea>
            @error('about')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="mb-3 text-end">
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>
    
    <div id="toast_wrapper" class="position-fixed top-0 end-0 p-3 mt-6" style="z-index: 1100">
        <div class="toast align-items-center text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Changes saved successfully.
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

</form>
    
@include('frontend.components.scripts')
@yield('custom-scripts')

<script>
    $(document).ready(function () {
        $('#user-account').submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('users/settings/account') }}",
                method: 'post',
                data: {
                    f_name: $('#f_name').val(),
                    l_name: $('#l_name').val(),
                    phone : $('#phone').val(),
                    postcode: $('#postcode').val(),
                    address: $('#address').val(),
                    about: $('#about').val(),
                },
                success: function(result){
                    $('.toast').toast('show');
                },
                error: function (request, status, error) {
                    console.error(error);
                }
            });
        });
    })
</script>

