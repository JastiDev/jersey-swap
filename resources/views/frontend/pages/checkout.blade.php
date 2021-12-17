@extends ('../../layouts/app')
@section('title')
    Checkout - Jersey Swap
@endsection
@section('content')
    <section id="checkout-form" class="mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 mx-auto">

                        <div class="py-5 text-center">
                            <img class="d-block mx-auto mb-4" src="assets/images/logo-transparent.png" alt="" width="50">
                            <h2>Checkout form</h2>
                            <p class="lead">Complete to start transaction!</p>
                        </div>

                        <div class="row g-5">
                            <div class="col-md-5 col-lg-4 order-md-last">
                                <h4 class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-primary">Your cart</span>
                                    <span class="badge bg-primary rounded-pill">{{$prices['offer'] >0 ? 3 : 2 }}</span>
                                </h4>
                                <ul class="list-group mb-3">
                                    <li class="list-group-item d-flex justify-content-between lh-sm">
                                        <div>
                                            <h6 class="my-0">Security Fee</h6>
                                            <small class="text-muted">Protect your jersey</small>
                                        </div>
                                        <span class="text-muted">${{$prices['security']}}</span>
                                    </li>
                                    @if($prices['offer']>0)
                                    <li class="list-group-item d-flex justify-content-between lh-sm">
                                        <div>
                                            <h6 class="my-0">Offer Price</h6>
                                            <small class="text-muted">Your offer price!</small>
                                        </div>
                                        <span class="text-muted">${{$prices['offer']}}</span>
                                    </li>
                                    @endif
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Total (USD)</span>
                                        <strong>${{$prices['security']+$prices['offer']}}</strong>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-7 col-lg-8">
                                <h4 class="mb-3">Billing Information & Details</h4>
                                <form class="needs-validation" id="payment-form" method="POST" action="{{url('charge')}}">
                                    @csrf
                                    <input type="hidden" name="type" value="{{$data['type']}}">
                                    <input type="hidden" name="listing" value="{{$data['listing']->id}}">
                                    <input type="hidden" name="offer_id" value="{{$data['offer']}}">
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <label for="f_name" class="form-label">First name</label>
                                            <input type="text" class="form-control" id="f_name" placeholder="" value="{{auth()->user()->f_name}}" name="f_name" required>
                                            <div class="invalid-feedback">
                                                Valid first name is required.
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="lastName" class="form-label">Last name</label>
                                            <input type="text" class="form-control" id="l_name" placeholder="Last Name" name="l_name" value="{{auth()->user()->l_name}}" required>
                                            <div class="invalid-feedback">
                                                Valid last name is required.
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</span></label>
                                            <input type="email" class="form-control" id="email" placeholder="you@example.com" value="{{auth()->user()->email}}" readonly="">
                                            <div class="invalid-feedback">
                                                Please enter a valid email address.
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="phone" class="form-label">Phone</span></label>
                                            @if(auth()->user()->phone!==null)
                                            <input type="phone" class="form-control" id="phone" placeholder="Enter Phone Number" value="{{auth()->user()->phone}}" required="" readonly="">
                                            @else
                                            <input type="hidden" name="enablePhone" value="1">
                                            <input type="phone" class="form-control" id="phone" placeholder="Enter Phone Number" value="{{auth()->user()->phone}}" name="phone" required>
                                            @endif
                                            <div class="invalid-feedback">
                                                Please enter a valid phone number.
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <label for="shipping_address" class="form-label">Shipping Address</label>
                                            <input type="text" class="form-control" id="shipping_address" placeholder="1234 Main St" name="shipping_address" required>
                                            <div class="invalid-feedback">
                                                Please enter your shipping address.
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <label for="country" class="form-label">Country</label>
                                            <select class="form-select" id="country" name="country" required>
                                              <option value="">Choose...</option>
                                              <option value="US">United States</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a valid country.
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="state" class="form-label">State</label>
                                            <select class="form-select" id="state" name="state" required>
                                                <option value="">Choose...</option>
                                                <option value="AL">Alabama</option>
                                                <option value="AK">Alaska</option>
                                                <option value="AZ">Arizona</option>
                                                <option value="AR">Arkansas</option>
                                                <option value="CA">California</option>
                                                <option value="CO">Colorado</option>
                                                <option value="CT">Connecticut</option>
                                                <option value="DE">Delaware</option>
                                                <option value="DC">District Of Columbia</option>
                                                <option value="FL">Florida</option>
                                                <option value="GA">Georgia</option>
                                                <option value="HI">Hawaii</option>
                                                <option value="ID">Idaho</option>
                                                <option value="IL">Illinois</option>
                                                <option value="IN">Indiana</option>
                                                <option value="IA">Iowa</option>
                                                <option value="KS">Kansas</option>
                                                <option value="KY">Kentucky</option>
                                                <option value="LA">Louisiana</option>
                                                <option value="ME">Maine</option>
                                                <option value="MD">Maryland</option>
                                                <option value="MA">Massachusetts</option>
                                                <option value="MI">Michigan</option>
                                                <option value="MN">Minnesota</option>
                                                <option value="MS">Mississippi</option>
                                                <option value="MO">Missouri</option>
                                                <option value="MT">Montana</option>
                                                <option value="NE">Nebraska</option>
                                                <option value="NV">Nevada</option>
                                                <option value="NH">New Hampshire</option>
                                                <option value="NJ">New Jersey</option>
                                                <option value="NM">New Mexico</option>
                                                <option value="NY">New York</option>
                                                <option value="NC">North Carolina</option>
                                                <option value="ND">North Dakota</option>
                                                <option value="OH">Ohio</option>
                                                <option value="OK">Oklahoma</option>
                                                <option value="OR">Oregon</option>
                                                <option value="PA">Pennsylvania</option>
                                                <option value="RI">Rhode Island</option>
                                                <option value="SC">South Carolina</option>
                                                <option value="SD">South Dakota</option>
                                                <option value="TN">Tennessee</option>
                                                <option value="TX">Texas</option>
                                                <option value="UT">Utah</option>
                                                <option value="VT">Vermont</option>
                                                <option value="VA">Virginia</option>
                                                <option value="WA">Washington</option>
                                                <option value="WV">West Virginia</option>
                                                <option value="WI">Wisconsin</option>
                                                <option value="WY">Wyoming</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please provide a valid state.
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="zipcode" class="form-label">Zip Code</label>
                                            <input type="text" class="form-control" id="zipcode" placeholder="" name="zipcode" pattern="[0-9]*" required>
                                            <div id="zipcode-message" class="invalid-feedback">
                                                Zip code required.
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4">

                                    <h4 class="mb-3">Payment</h4>

                                    <div class="row gy-3 mb-3">
                                        <div class="col-md-12">
                                            <label for="card-holder-name" class="form-label">Name on card</label>
                                            <input id="card-holder-name" type="text" class="form-control" placeholder="" required>
                                            <small class="text-muted">Full name as displayed on card</small>
                                            <div class="invalid-feedback">
                                                Name on card is required
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Stripe Elements Placeholder -->
                                    <div id="card-element"></div>

                                    <hr class="my-4">
                                    <button class="w-100 btn btn-primary btn-lg" id="card-button" type="submit" >Complete checkout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <style>
            .overlay{
                background-color: rgba(0,0,0,0.5);
                 position: fixed;
                top:0%;
                left:0%;
                height:100%;
                width:100%;
                bottom:0%;
                right:0%;
                overflow:hidden;
                padding: 20% 0 0 0;
                visibility: hidden;
            }
            .overlay.show{
                visibility: visible;
            }
        </style> 
        <div id="loader" class="overlay text-center">
            <div class="spinner-border text-light" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <p class="text-white">Processing Request</p>
        </div>
@endsection

@section('custom-scripts')
<script src="https://js.stripe.com/v3/"></script>

<script>
    // const stripe = Stripe("{{env('STRIPE_KEY','pk_live_51JMJCNLaRKsO1rdUaYMI4zbBHPssGkbtMFsbtGzAEwzcFZzZfPuFTxu37UDy2oy6hVHZdhRLlB1hdJZktcIlpZrl00RVv5kmjq')}}");
    const stripe = Stripe("{{env('STRIPE_KEY','pk_test_51JMJCNLaRKsO1rdUIvC4wtL5UHKd23TNkDVB28r9n2Pa9KtjDMwO9fQOEsD42Skh6yAfg6BCQsMoTGyJBvoTDLV400VtyPWbEh')}}");

    var flag = false;

    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');
    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    

    $("#payment-form").submit(function(e){
        if(flag==false){
            e.preventDefault();
            return false;
        }
    });
    function isUSAZipCode(str) 
    {
        return /^\d{5}(-\d{4})?$/.test(str);
    }
    function validateForm(){
        var flag = true;
        if($("#f_name").val()==""){
            $("#f_name").addClass('is-invalid');
            flag = false;
        }
        if($("#l_name").val()==""){
            $("#l_name").addClass('is-invalid');
            flag = false;
        }
        if($("#phone").val()==""){
            $("#phone").addClass('is-invalid');
            flag = false;
        }
        if($("#shipping_address").val()==""){
            $("#shipping_address").addClass('is-invalid');
            flag = false;
        }
        if($("#country").val()==""){
            $("#country").addClass('is-invalid');
            flag = false;
        }
        if($("#state").val()==""){
            $("#state").addClass('is-invalid');
            flag = false;
        }
        if($("#zipcode").val()==""){
            $("#zipcode").addClass('is-invalid');
            flag = false;
            $("#zipcode-message").html("Zip Code Required!");
        }
        else{
            if(isUSAZipCode($("#zipcode").val())){
                $("#zipcode-message").html("Invalid Zip Code!");
                $("#zipcode").addClass('is-invalid');
                flag = false;
            }
            else{
                $("#zipcode").removeClass('is-invalid');
            }
        }
        return flag;
    }
    cardButton.addEventListener('click', async (e) => {
        if(!validateForm()){
            return true;
        }
        $("#loader").addClass('show');
        const { paymentMethod, error } = await stripe.createPaymentMethod(
            'card', cardElement, {
                billing_details: {
                    name: cardHolderName.value
                }
            }
        );
        if (error) {
            // Display "error.message" to the user...
            console.error(error);
            $("#loader").removeClass('show');
            swal("Error!", "Please check your card details!", "error");
        } else {
            flag=true;
            $("#payment-form").append("<input type='hidden' name='paymentMethodId' value='" + paymentMethod.id + "'/>");
            $("#payment-form").submit();
        }
    });
</script>
@endsection