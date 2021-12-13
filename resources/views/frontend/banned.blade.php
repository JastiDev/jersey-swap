@extends ('../../layouts/app')

@section('content')

    <section id="about-us" class="mt-3 pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto" style="text-align: center;">
                    <h2>Account Banned!</h2>
                    <p>
                        @if (session('error'))
                            {{ session('error') }}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection
