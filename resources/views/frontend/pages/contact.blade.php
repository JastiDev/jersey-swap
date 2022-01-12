@extends ('../../layouts/app')
@section('title')
    Contact us - Jersey Swap
@endsection
@section('meta_description')
    Jersey Swap - We’re here to answer any question you might have. We look forward to hearing from you.
@endsection
@section('content')
        <section id="page-box" class="page-hero-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>Contact us</h1>
                        <ul class="breadcrumb mx-auto justify-content-center" aria-label="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Contact
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact-us" class="pt-md-5 pb-md-5 pt-4 pb-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 mx-auto text-center">
                        <h2>Contact Jersey Swap!</h2>
                        <div class="divider mx-auto"></div>
                        <p>We’re here to answer any question you might have. We look forward to hearing from you.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact-us-form" class="pt-md-5 pb-md-5 pt-2 pt-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mb-md-0 mb-1">
                        <h3>Contact Details</h3>
                        <small>Get in touch with us! Call us, email us or contact via Social Media!</small>
                        <ul class="contact-list">
                            <li>
                                <div class="icon-box">
                                    <i class="fa fa-building"></i>
                                </div>
                                <div class="icon-content">
                                    <h4>United States</h4>
                                    <small>100 Springdale Rd STE A3 PMB 353, Cherry Hill NJ, 08003 </small>
                                </div>
                            </li>
                            <li>
                                <div class="icon-box">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="icon-content">
                                    <h4>officialjerseyswap@gmail.com</h4>
                                    <small>Email us your queries.</small>
                                </div>
                            </li>
                            <li>
                                <div class="icon-box">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="icon-content">
                                    <h4>856-600-4178</h4>
                                    <small>Make a phone call.</small>
                                </div>
                            </li>
                        </ul>
                        <h3>Follow us on</h3>
                        <div class="divider"></div>
                        <ul class="social-media-list mt-3">
                            <li>
                                <a href="https://www.facebook.com/OfficialJerseySwap/" target="_blank">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            {{--<li>
                                <a href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>--}}
                            <li>
                                <a href="https://instagram.com/Officialjerseyswap" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-white p-4">
                            <div class="card-body">
                                <h3>Let's start a conversation!</h3>
                                <form id="contact-form">
                                    <div class="mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input id="name" type=" text" class="form-control" placeholder="Full Name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email address</label>
                                        <input id="email" type=" email" class="form-control" placeholder="Email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Subject</label>
                                        <input id="subject" type="text" class="form-control" placeholder="Subject" required>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Message <small>(Max 500 Chraters)</small></label>
                                        <textarea id="message" class="form-control" placeholder="Leave a comment here"
                                            rows="5" maxlength="500" required></textarea>
                                    </div>
                                    <div class="mb-2 text-end">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    <div id="form-alert" class="alert alert-dismissible fade show" role="alert" style="display:none;">
                                        <p id="alert-message"></p>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection

@section('custom-scripts')
    <script>
        $(document).ready(function() {
            $('#contact-form').submit(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('contact/post') }}",
                    method: 'post',
                    data: {
                        full_name: $('#name').val(),
                        email: $('#email').val(),
                        subject : $('#subject').val(),
                        message: $('#message').val(),
                    },
                    success: function(result){
                         //$('#contact-form').reset();
                         $('#form-alert').addClass('alert-success');
                         $('#alert-message').text('Form submitted!');
                         $('#form-alert').show();
                    },
                    error: function (request, status, error) {
                         $('#form-alert').addClass('alert-danger');
                         $('#alert-message').text('There is an error in submitting the form, please try again later!');
                         $('#form-alert').show();
                    }
                 });
            });
        }); 
    </script>
    @endsection
