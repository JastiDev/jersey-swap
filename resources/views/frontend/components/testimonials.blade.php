@if($testimonials!==null && count($testimonials)>0)
<section id="testimonials" class="pt-5  pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mb-5">
                <h2>Read what our customers say:</h2>
            </div>
            <!-- Testimonial 1 -->
            @foreach ($testimonials as $testimonial)
                <div class="col-md-6 mb-4">
                    <div class="card testimonial-card">
                        <div class="card-body">
                            <i class="fas fa-quote-left mb-2"></i>
                            <p>{{$testimonial->description}}</p>
                            <div class="product-meta d-flex flex-row">
                                <div class="user-avatar p-1">
                                    <img src="{{asset($testimonial->avatar)}}" class="avatar">
                                </div>
                                <div class="user-name align-self-center">
                                    <p>{{$testimonial->name}}</p>
                                    <small>{{$testimonial->designation}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
