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
                                        <!-- Your form inputs here (first_name, last_name, email, country, etc.) -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="sub-title">
                                <h2>Order Summery</h2>
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
                                        <div class="h6"><strong id="shippingAmount">${{ number_format($totalShippingCharge, 2) }}</strong></div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2 summery-end">
                                        <div class="h5"><strong>Total</strong></div>
                                        <div class="h5"><strong id="grandTotal">${{ number_format($grandTotal, 2) }}</strong></div>
                                    </div>
                                </div>
                            </div>

                            <div class="input-group apply-coupon mt-4">
                                <input type="text" placeholder="Coupon Code" name="discount_code" id="discount_code" class="form-control">
                                <button class="btn btn-dark" type="button" id="apply-discount">Apply Coupon</button>
                            </div>
                            @if (Session::has('code'))
                                <div id="discount_wrapper">
                                    <div class="input-group mt-4" id="discount_response">
                                        <strong>{{ Session::get('code')->code }}</strong>
                                        <a class="btn btn-sm btn-danger" id="remove_discount"><i class="fa fa-times"></i></a>
                                    </div>
                                </div>
                            @endif

                            <div class="card payment-form">
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
                                    <div id="card-element" class="form-control"></div>
                                </div>

                                <div class="pt-4">
                                    <button type="submit" class="btn-dark btn btn-block w-100" onclick="createToken()">Pay Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
@endsection

@section('customJS')
<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ env("STRIPE_KEY") }}');
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-element');

    $("#method1").click(function() {
        $("#card-payment-form").addClass("d-none");
    });

    $("#method2").click(function() {
        $("#card-payment-form").removeClass("d-none");
    });

    $("#orderForm").submit(function(event) {
        event.preventDefault();
        var form = $(this);
        var paymentMethod = $("input[name='payment_method']:checked").val();

        if (paymentMethod === 'stripe') {
            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    alert(result.error.message);
                } else {
                    $("<input>").attr({
                        type: "hidden",
                        name: "stripeToken",
                        value: result.token.id
                    }).appendTo(form);
                    processCheckout(form);
                }
            });
        } else {
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
                    $(".invalid-feedback").html('');
                    $(".is-invalid").removeClass("is-invalid");
                    window.location.href = "{{ url('/thankyou/') }}/" + response.orderId;
                } else {
                    var errors = response.errors;
                    for (var key in errors) {
                        $("#" + key).siblings("p").addClass("invalid-feedback").html(errors[key]);
                        $("#" + key).addClass("is-invalid");
                    }
                }
            },
            error: function(jqXHR, exception) {
                console.log('Something went wrong');
            }
        });
    }

    $("#country").change(function() {
        $.ajax({
            url: '{{ route('front.getOrderSummary') }}',
            type: 'post',
            data: { country_id: $(this).val() },
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $("#shippingAmount").html('$' + response.totalShippingCharge);
                    $("#grandTotal").html('$' + response.grandTotal);
                }
            }
        })
    });

    $('body').on('click', '#apply-discount', function() {
        $.ajax({
            url: '{{ route('front.applyDiscount') }}',
            type: 'post',
            data: { code: $("#discount_code").val(), country_id: $('#country').val() },
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $("#shippingAmount").html('$' + response.totalShippingCharge);
                    $("#grandTotal").html('$' + response.grandTotal);
                    $("#discount").html('$' + response.discount);
                    $("#discount_wrapper").html(response.discountString);
                } else {
                    $("#discount_wrapper").html("<span class='text-danger'>" + response.message + "</span>");
                }
            }
        })
    });

    $('body').on('click', '#remove_discount', function() {
        $.ajax({
            url: '{{ route('front.removeDiscount') }}',
            type: 'post',
            data: { country_id: $('#country').val() },
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    $("#shippingAmount").html('$' + response.totalShippingCharge);
                    $("#grandTotal").html('$' + response.grandTotal);
                    $("#discount").html('$' + response.discount);
                    $("#discount_response").html('');
                    $("#discount_code").val('');
                }
            }
        })
    });
</script>
@endsection
