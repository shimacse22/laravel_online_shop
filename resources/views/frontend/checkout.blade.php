@extends('frontend.layouts.app')
@section('content')
    <main>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.shop') }}">Shop</a></li>
                        <li class="breadcrumb-item">Checkout</li>
                    </ol>
                </div>
            </div>
        </section>
        <section class="section-9 pt-4">
            <form name="orderForm" id="orderForm" method="post" action="{{ route('front.processCheckout') }}">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="sub-title">
                                <h2>Shipping Address</h2>
                            </div>
                            <div class="card shadow-lg border-0">
                                <div class="card-body checkout-form">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="text" name="first_name" id="first_name"
                                                    value="{{ !empty($customerAddress) ? $customerAddress->first_name : '' }}"
                                                    class="form-control" placeholder="First Name">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="text" name="last_name" id="last_name"
                                                    value="{{ !empty($customerAddress) ? $customerAddress->last_name : '' }}"
                                                    class="form-control" placeholder="Last Name">
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="text" name="email" id="email"
                                                    value="{{ !empty($customerAddress) ? $customerAddress->email : '' }}"
                                                    class="form-control" placeholder="Email">
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <select name="country" id="country" class="form-control">

                                                    @if (!empty($countries))
                                                        <option value="">Select a Country</option>
                                                        @foreach ($countries as $country)
                                                            <option
                                                                {{ !empty($customerAddress) && $customerAddress->country_id == $country->id ? 'selected' : '' }}
                                                                value="{{ $country->id }}">{{ $country->name }}</option>
                                                        @endforeach
                                                     
                                                    @endif

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <textarea name="address" id="address" cols="30" rows="3" placeholder="Address" class="form-control">{{ !empty($customerAddress) ? $customerAddress->address : '' }}</textarea>
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="text" name="apartment" id="apartment"
                                                    value="{{ !empty($customerAddress) ? $customerAddress->apartment : '' }}"
                                                    class="form-control"
                                                    placeholder="Apartment, suite, unit, etc. (optional)">
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <input type="text" name="city" id="city"
                                                    value="{{ !empty($customerAddress) ? $customerAddress->city : '' }}"
                                                    class="form-control" placeholder="City">
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <input type="text" name="state" id="state"
                                                    value="{{ !empty($customerAddress) ? $customerAddress->state : '' }}"
                                                    class="form-control" placeholder="State">
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <input type="text" name="zip" id="zip"
                                                    value= "{{ !empty($customerAddress) ? $customerAddress->zip : '' }}"
                                                    class="form-control" placeholder="Zip">
                                                <p></p>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="text" name="mobile" id="mobile"
                                                    value= "{{ !empty($customerAddress) ? $customerAddress->mobile : '' }} "class="form-control"
                                                    placeholder="Mobile No.">
                                                <p></p>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <textarea name="order_notes" id="order_notes" cols="30" rows="2" placeholder="Order Notes (optional)"
                                                    class="form-control">{{ !empty($customerAddress) ? $customerAddress->notes : '' }}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="sub-title">
                                <h2>Order Summery</h3>
                            </div>
                            <div class="card cart-summery">
                                <div class="card-body">
                                    @foreach (Cart::content() as $item)
                                        <div class="d-flex justify-content-between pb-2">
                                            <div class="h6">{{ $item->name }} X {{ $item->qty }}</div>
                                            <div class="h6">${{ $item->price * $item->qty }}</div>
                                        </div>
                                    @endforeach

                                    <div class="d-flex justify-content-between summery-end">
                                        <div class="h6"><strong>Subtotal</strong></div>
                                        <div class="h6"><strong>${{ Cart::subtotal() }}</strong></div>
                                    </div>
                                    <div class="d-flex justify-content-between summery-end">
                                        <div class="h6"><strong>Discount</strong></div>
                                        <div class="h6" id="discount"><strong>${{ $discount }}</strong></div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <div class="h6"><strong>Shipping</strong></div>
                                        <div class="h6"><strong
                                                id="shippingAmount">${{ number_format($totalShippingCharge, 2) }}</strong>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2 summery-end">
                                        <div class="h5"><strong>Total</strong></div>
                                        <div class="h5"><strong
                                                id="grandTotal">${{ number_format($grandTotal, 2) }}</strong></div>
                                    </div>
                                </div>

                            </div>
                            <div class="input-group apply-coupon mt-4">
                                <input type="text" placeholder="Coupon Code" name="discount_code" id="discount_code"
                                    class="form-control">
                                <button class="btn btn-dark" type="button" id="apply-discount">Apply Coupon</button>
                            </div>
                            @if (Session::has('code'))
                                <div id="discount_wrapper">
                                    <div class="input-group mt-4" id="discount_response">
                                        <strong>{{ Session::get('code')->code }}</strong>
                                        <a class="btn btn-sm btn-danger" id="remove_discount"><i
                                                class="fa fa-times"></i></a>
                                    </div>
                                </div>
                            @endif

                            <div class="card payment-form ">
                                <h3 class="card-title h5 mb-3">Payment Details</h3>
                                <div class="">
                                    <input checked type="radio" name="payment_method" value='cod' id='method1'>
                                    <label for="method1">Cash On Delivery</label>
                                </div>
                                <div class="">
                                    <input type="radio" name="payment_method" value='stripe' id='method2'>
                                    <label for="method2">Stripe</label>
                                </div>
                                <div class="card-body p-0 mt-3 d-none" id="card-payment-form">
                                    <input type="hidden" name="stripeToken" id="stripe-token">
                                    <div id="card-element" class="form-control">

                                    </div>
                                    
                                </div>
                                
                                <div class="pt-4">
                                    {{-- <a href="#" class="btn-dark btn btn-block w-100">Pay Now</a> --}}
                                    <button type="submit" class="btn-dark btn btn-block w-100" onclick="createToken()">Pay Now</button>
                                </div>
                            </div>
                            <!-- CREDIT CARD FORM ENDS HERE -->
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
@endsection
@section('customJS')
{{-- <script src="https://js.stripe.com/v3/"></script>
<script>
 var stripe = Stripe('{{ env("STRIPE_KEY") }}');
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-element');
    function createToken(){
                stripe.createToken(cardElement).then(function(result) {
        // Handle result.error or result.token
        console.log(result);
        if(result.token){
            document.getElementById("stripe-token").value=result.token.id;
        }
        });
    }
  
</script> --}}
<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ env("STRIPE_KEY") }}');
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-element');

    // Toggle card payment form visibility
    $("#method1").click(function() {
        if ($(this).is(":checked")) {
            $("#card-payment-form").addClass("d-none");
        }
    });

    $("#method2").click(function() {
        if ($(this).is(":checked")) {
            $("#card-payment-form").removeClass("d-none");
        }
    });

    // Order form submission
    $("#orderForm").submit(function(event) {
        event.preventDefault();
        var form = $(this);
        var paymentMethod = $("input[name='payment_method']:checked").val();

        if (paymentMethod === 'stripe') {
            // Stripe payment method selected
            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    alert(result.error.message);  // Show error to the user
                } else {
                    // Append Stripe token to form
                    $("<input>").attr({
                        type: "hidden",
                        name: "stripeToken",
                        value: result.token.id
                    }).appendTo(form);

                    // Submit the form with AJAX for Stripe
                    processCheckout(form);
                }
            });
        } else {
            // Normal form submission for other payment methods
            processCheckout(form);
        }
    });

    // Function to process checkout
    function processCheckout(form) {
        $.ajax({
            url: '{{ route('front.processCheckout') }}',
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    // Reset validation errors and show success
                    $("#first_name").siblings("p").removeClass("invalid-feedback").html('');
                    $("#first_name").removeClass("is-invalid");

                    $("#last_name").siblings("p").removeClass("invalid-feedback").html('');
                    $("#last_name").removeClass("is-invalid");

                    $("#mobile").siblings("p").removeClass("invalid-feedback").html('');
                    $("#mobile").removeClass("is-invalid");

                    $("#email").siblings("p").removeClass("invalid-feedback").html('');
                    $("#email").removeClass("is-invalid");

                    $("#country").siblings("p").removeClass("invalid-feedback").html('');
                    $("#country").removeClass("is-invalid");

                    $("#address").siblings("p").removeClass("invalid-feedback").html('');
                    $("#address").removeClass("is-invalid");

                    $("#city").siblings("p").removeClass("invalid-feedback").html('');
                    $("#city").removeClass("is-invalid");

                    $("#state").siblings("p").removeClass("invalid-feedback").html('');
                    $("#state").removeClass("is-invalid");

                    $("#zip").siblings("p").removeClass("invalid-feedback").html('');
                    $("#zip").removeClass("is-invalid");

                    // Redirect to the thank you page
                    window.location.href = "{{ url('/thankyou/') }}/" + response.orderId;
                } else {
                    // Handle errors if the response status is false
                    var errors = response.errors;

                    if (errors.first_name) {
                        $("#first_name").siblings("p").addClass("invalid-feedback").html(errors.first_name);
                        $("#first_name").addClass("is-invalid");
                    } else {
                        $("#first_name").siblings("p").removeClass("invalid-feedback").html('');
                        $("#first_name").removeClass("is-invalid");
                    }

                    if (errors.last_name) {
                        $("#last_name").siblings("p").addClass("invalid-feedback").html(errors.last_name);
                        $("#last_name").addClass("is-invalid");
                    } else {
                        $("#last_name").siblings("p").removeClass("invalid-feedback").html('');
                        $("#last_name").removeClass("is-invalid");
                    }

                    if (errors.mobile) {
                        $("#mobile").siblings("p").addClass("invalid-feedback").html(errors.mobile);
                        $("#mobile").addClass("is-invalid");
                    } else {
                        $("#mobile").siblings("p").removeClass("invalid-feedback").html('');
                        $("#mobile").removeClass("is-invalid");
                    }

                    if (errors.email) {
                        $("#email").siblings("p").addClass("invalid-feedback").html(errors.email);
                        $("#email").addClass("is-invalid");
                    } else {
                        $("#email").siblings("p").removeClass("invalid-feedback").html('');
                        $("#email").removeClass("is-invalid");
                    }

                    if (errors.country) {
                        $("#country").siblings("p").addClass("invalid-feedback").html(errors.country);
                        $("#country").addClass("is-invalid");
                    } else {
                        $("#country").siblings("p").removeClass("invalid-feedback").html('');
                        $("#country").removeClass("is-invalid");
                    }

                    if (errors.address) {
                        $("#address").siblings("p").addClass("invalid-feedback").html(errors.address);
                        $("#address").addClass("is-invalid");
                    } else {
                        $("#address").siblings("p").removeClass("invalid-feedback").html('');
                        $("#address").removeClass("is-invalid");
                    }

                    if (errors.city) {
                        $("#city").siblings("p").addClass("invalid-feedback").html(errors.city);
                        $("#city").addClass("is-invalid");
                    } else {
                        $("#city").siblings("p").removeClass("invalid-feedback").html('');
                        $("#city").removeClass("is-invalid");
                    }

                    if (errors.state) {
                        $("#state").siblings("p").addClass("invalid-feedback").html(errors.state);
                        $("#state").addClass("is-invalid");
                    } else {
                        $("#state").siblings("p").removeClass("invalid-feedback").html('');
                        $("#state").removeClass("is-invalid");
                    }

                    if (errors.zip) {
                        $("#zip").siblings("p").addClass("invalid-feedback").html(errors.zip);
                        $("#zip").addClass("is-invalid");
                    } else {
                        $("#zip").siblings("p").removeClass("invalid-feedback").html('');
                        $("#zip").removeClass("is-invalid");
                    }
                }
            },
            error: function(jqXHR, exception) {
                console.log('Something went wrong');
            }
        });
    }
</script>
{{-- <script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ env("STRIPE_KEY") }}');
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-element');

    $("#orderForm").submit(function(event) {
        event.preventDefault();
        var form = $(this);
        var paymentMethod = $("input[name='payment_method']:checked").val();

        if (paymentMethod === 'stripe') {
            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    alert(result.error.message);  // Show error to the user
                } else {
                    // Append Stripe token to form
                    $("<input>").attr({
                        type: "hidden",
                        name: "stripeToken",
                        value: result.token.id
                    }).appendTo(form);

                    // Submit the form with AJAX
                    processCheckout(form);
                }
            });
        } else {
            // Submit form normally for other payment methods
            processCheckout(form);
        }
    });

    function processCheckout(form) {
        $.ajax({
            url: '{{ route('front.processCheckout') }}',
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    window.location.href = "{{ url('/thankyou/') }}/" + response.orderId;
                } else {
                    alert("Payment failed. Please try again.");
                }
            },
            error: function(jqXHR, exception) {
                console.log('Something went wrong');
            }
        });
    }
</script>
   

    <script type="text/javascript">
        $("#method1").click(function() {
            if ($(this).is(":checked")) {
                $("#card-payment-form").addClass("d-none");
            }
        });
        $("#method2").click(function() {
            if ($(this).is(":checked")) {
                $("#card-payment-form").removeClass("d-none");
            }
        });

        //order form submission
        $("#orderForm").submit(function(event) {
            event.preventDefault();
            var element = $(this)
            //  $("button[type=submit]").prop('disabled',true);
            $.ajax({
                url: '{{ route('front.processCheckout') }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    // $("button[type=submit]").prop('disabled',false);
                    var errors = response.errors;

                    if (response.status == false) {
                        if (errors.first_name) {
                            $("#first_name").siblings("p").addClass("invalid-feedback").html(errors
                                .first_name);
                            $("#first_name").addClass("is-invalid");
                        } else {
                            $("#first_name").siblings("p").removeClass("invalid-feedback").html('');
                            $("#first_name").removeClass("is-invalid");
                        }
                        if (errors.last_name) {
                            $("#last_name").siblings("p").addClass("invalid-feedback").html(errors
                                .last_name);
                            $("#last_name").addClass("is-invalid");
                        } else {
                            $("#last_name").siblings("p").removeClass("invalid-feedback").html('');
                            $("#last_name").removeClass("is-invalid");
                        }
                        if (errors.mobile) {
                            $("#mobile").siblings("p").addClass("invalid-feedback").html(errors.mobile);
                            $("#mobile").addClass("is-invalid");
                        } else {
                            $("#mobile").siblings("p").removeClass("invalid-feedback").html('');
                            $("#mobile").removeClass("is-invalid");
                        }

                        if (errors.email) {
                            $("#email").siblings("p").addClass("invalid-feedback").html(errors.email);
                            $("#email").addClass("is-invalid");
                        } else {
                            $("#email").siblings("p").removeClass("invalid-feedback").html('');
                            $("#email").removeClass("is-invalid");
                        }
                        if (errors.country) {
                            $("#country").siblings("p").addClass("invalid-feedback").html(errors
                                .country);
                            $("#country").addClass("is-invalid");
                        } else {
                            $("#country").siblings("p").removeClass("invalid-feedback").html('');
                            $("#country").removeClass("is-invalid");
                        }
                        if (errors.address) {
                            $("#address").siblings("p").addClass("invalid-feedback").html(errors
                                .address);
                            $("#address").addClass("is-invalid");
                        } else {
                            $("#address").siblings("p").removeClass("invalid-feedback").html('');
                            $("#address").removeClass("is-invalid");
                        }
                        if (errors.city) {
                            $("#city").siblings("p").addClass("invalid-feedback").html(errors.city);
                            $("#city").addClass("is-invalid");
                        } else {
                            $("#city").siblings("p").removeClass("invalid-feedback").html('');
                            $("#city").removeClass("is-invalid");
                        }
                        if (errors.state) {
                            $("#state").siblings("p").addClass("invalid-feedback").html(errors.state);
                            $("#state").addClass("is-invalid");
                        } else {
                            $("#state").siblings("p").removeClass("invalid-feedback").html('');
                            $("#state").removeClass("is-invalid");
                        }
                        if (errors.zip) {
                            $("#zip").siblings("p").addClass("invalid-feedback").html(errors.zip);
                            $("#zip").addClass("is-invalid");
                        } else {
                            $("#zip").siblings("p").removeClass("invalid-feedback").html('');
                            $("#zip").removeClass("is-invalid");
                        }

                    } else {

                        $("#first_name").siblings("p").removeClass("invalid-feedback").html('');
                        $("#first_name").removeClass("is-invalid");

                        $("#last_name").siblings("p").removeClass("invalid-feedback").html('');
                        $("#last_name").removeClass("is-invalid");

                        $("#mobile").siblings("p").removeClass("invalid-feedback").html('');
                        $("#mobile").removeClass("is-invalid");

                        $("#email").siblings("p").removeClass("invalid-feedback").html('');
                        $("#email").removeClass("is-invalid");

                        $("#country").siblings("p").removeClass("invalid-feedback").html('');
                        $("#country").removeClass("is-invalid");

                        $("#address").siblings("p").removeClass("invalid-feedback").html('');
                        $("#address").removeClass("is-invalid");

                        $("#city").siblings("p").removeClass("invalid-feedback").html('');
                        $("#city").removeClass("is-invalid");

                        $("#state").siblings("p").removeClass("invalid-feedback").html('');
                        $("#state").removeClass("is-invalid");

                        $("#zip").siblings("p").removeClass("invalid-feedback").html('');
                        $("#zip").removeClass("is-invalid");

                        window.location.href = "{{ url('/thankyou/') }}/" + response.orderId;

                    }

                },
                error: function(jqXHR, exception) {
                    console.log('something went wrong');
                }
            });
        }); --}}

        $("#country").change(function() {
            $.ajax({
                url: '{{ route('front.getOrderSummary') }}',
                type: 'post',
                data: {
                    country_id: $(this).val()
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == true) {
                        $("#shippingAmount").html('$' + response.totalShippingCharge);
                        $("#grandTotal").html('$' + response.grandTotal);
                    }

                }
            })
        })

        $('body').on('click', '#apply-discount', function() {
            $.ajax({
                url: '{{ route('front.applyDiscount') }}',
                type: 'post',
                data: {
                    code: $("#discount_code").val(),
                    country_id: $('#country').val()
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == true) {
                        $("#shippingAmount").html('$' + response.totalShippingCharge);
                        $("#grandTotal").html('$' + response.grandTotal);
                        $("#discount").html('$' + response.discount);
                        $("#discount_wrapper").html(response.discountString);
                    } else {
                        $("#discount_wrapper").html("<span class='text-danger'>" + response.message +
                            "</span>");

                    }
                }
            })

        });

        $('body').on('click', '#remove_discount', function() {

            $.ajax({
                url: '{{ route('front.removeDiscount') }}',
                type: 'post',
                data: {
                    country_id: $('#country').val()
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == true) {
                        $("#shippingAmount").html('$' + response.totalShippingCharge);
                        $("#grandTotal").html('$' + response.grandTotal);
                        $("#discount").html('$' + response.discount);
                        $("#discount_response").html('');
                        $("#discount_code").val('');
                    }

                }
            })

        })
    </script>
  
   
    
@endsection
