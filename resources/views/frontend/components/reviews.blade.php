<div class="card mb-3 rating-box">
    <div class="card-body">
        <div class="row">
            <div id="reviews_container"></div>
        </div>
    </div>
</div>
@include('frontend.components.react-loader')
<script>
    const user = {{$user->id}};
</script>
<script type="text/babel" src="{{asset('assets/react/review-container.js')}}"></script>
