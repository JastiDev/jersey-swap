@extends ('../../layouts/app')
@section('title')
    Settings - Jersey Swap
@endsection
@section('content')
    <section id="dashboard" class="pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        @include('frontend.components.settings-sidebar')
                    </div>

                    <div class="col-md-9">
                        <div class="card mb-3">
                            <div class="card-header">
                                @if($type==="profile-photo")
                                Update Profile Photo
                                @elseif($type==="account")
                                Update Personal Details
                                @elseif($type==="security")
                                Security
                                @endif
                            </div>
                            <div class="card-body">
                                @if($type==="profile-photo")
                                    @include('frontend.components.settings.profilephoto')
                                @elseif($type==="account")
                                    @include('frontend.components.settings.useraccount')
                                @elseif($type==="security")
                                    @include('frontend.components.settings.security')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
        </section>
@endsection
