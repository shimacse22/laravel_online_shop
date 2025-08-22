@extends('frontend.layouts.app')
@section('content')
    <main>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                        <li class="breadcrumb-item">Settings</li>
                    </ol>
                </div>
            </div>
        </section>
        <section class=" section-11 ">
            <div class="container  mt-5">
                <div class="row">
                    <div class="col-md-12">
                        @include('frontend.account.common.message')
                    </div>
                    <div class="col-md-3">
                        @include('frontend.account.common.sidebar')
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0 pt-2 pb-2">Personal Information</h2>
                            </div>
                            <form action="{{ route('account.profileUpdate') }}" method="post" name="profileForm"
                                id="profileForm">
                                @csrf
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="name">Name</label>
                                            <input value={{ $users->name }} type="text" name="name" id="name"
                                                placeholder="Enter Your Name" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email">Email</label>
                                            <input value={{ $users->email }} type="text" name="email" id="email"
                                                placeholder="Enter Your Email" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone">Phone</label>
                                            <input value={{ $users->phone }} type="text" name="phone" id="phone"
                                                placeholder="Enter Your Phone" class="form-control">
                                            <p></p>
                                        </div>

                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-dark">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card mt-5">
                            <div class="card-header">
                                <h2 class="h5 mb-0 pt-2 pb-2">Address</h2>
                            </div>
                            <form action="{{ route('account.addressUpdate') }}" method="post" name="addressForm"
                                id="addressForm">
                                @csrf
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="first_name">First Name</label>
                                            <input value="{{ !empty($address->first_name) ? $address->first_name : '' }}"
                                                type="text" name="first_name" id="first_name"
                                                placeholder="Enter Your First Name" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="last_name"> Last Name</label>
                                            <input value="{{ !empty($address->last_name) ? $address->last_name : '' }}"
                                                type="text" name="last_name" id="last_name"
                                                placeholder="Enter Your Last Name" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email">Email</label>
                                            <input value="{{ !empty($address->email) ? $address->email : '' }}"
                                                type="text" name="email" id="email" placeholder="Enter Your Email"
                                                class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="mobile">Mobile</label>
                                            <input value="{{ !empty($address->mobile) ? $address->mobile : '' }}"
                                                type="text" name="mobile" id="mobile" placeholder="Enter Your Mobile"
                                                class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="mb-3">
                                            <label for="country_id">Country</label>
                                            <select name="country_id" id="country_id" class="form-control">
                                                <option value="">Select a Country</option>
                                                @if (!empty($countries))
                                                    @foreach ($countries as $country)
                                                        <option
                                                            {{ !empty($address) && $address->country_id == $country->id ? 'selected' : ' ' }}
                                                            value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <p></p>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address">Address</label>
                                            <textarea name="address" id="address" cols="30" rows="5" class="form-control"
                                                placeholder="Enter Your Address">{{ !empty($address->address) ? $address->address : '' }}</textarea>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="apartment">Apartment</label>
                                            <input value="{{ !empty($address->apartment) ? $address->apartment : '' }}"
                                                type="text" name="apartment" id="apartment"
                                                placeholder="Enter Your Apartment" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="city">City</label>
                                            <input value="{{ !empty($address->city) ? $address->city : '' }}"
                                                type="text" name="city" id="city"
                                                placeholder="Enter Your City" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="state">State</label>
                                            <input value="{{ !empty($address->state) ? $address->state : '' }}"
                                                type="text" name="state" id="state"
                                                placeholder="Enter Your State" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="zip">Zip</label>
                                            <input value="{{ !empty($address->zip) ? $address->zip : '' }}"
                                                type="text" name="zip" id="zip"
                                                placeholder="Enter Your Zip" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-dark">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('customJS')
    <script>
        $("#profileForm").submit(function(event) {
            event.preventDefault();
            var element = $(this)
            //  $("button[type=submit]").prop('disabled',true);
            $.ajax({
                url: '{{ route('account.profileUpdate') }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    // $("button[type=submit]").prop('disabled',false);
                    if (response.status == true) {

                        $("#name").siblings("p").removeClass("invalid-feedback").html('');
                        $("#name").removeClass("is-invalid");

                        $(" #profileForm #email").siblings("p").removeClass("invalid-feedback").html(
                        '');
                        $(" #profileForm #email").removeClass("is-invalid");

                        $("#phone").siblings("p").removeClass("invalid-feedback").html('');
                        $("#phone").removeClass("is-invalid");

                        window.location.href = "{{ route('account.profile') }}"

                    } else {

                        var errors = response.errors;
                        if (errors.name) {
                            $("#name").siblings("p").addClass("invalid-feedback").html(errors.name);
                            $("#name").addClass("is-invalid");
                        } else {
                            $("#name").siblings("p").removeClass("invalid-feedback").html('');
                            $("#name").removeClass("is-invalid");
                        }
                        if (errors.email) {
                            $("#profileForm #email").siblings("p").addClass("invalid-feedback").html(
                                errors.email);
                            $("#profileForm #email").addClass("is-invalid");
                        } else {
                            $("#profileForm #email").siblings("p").removeClass("invalid-feedback").html(
                                '');
                            $("#profileForm #email").removeClass("is-invalid");
                        }
                        if (errors.phone) {
                            $("#phone").siblings("p").addClass("invalid-feedback").html(errors.phone);
                            $("#phone").addClass("is-invalid");
                        } else {
                            $("#phone").siblings("p").removeClass("invalid-feedback").html('');
                            $("#phone").removeClass("is-invalid");
                        }
                    }
                }
            });
        })
        //
        $("#addressForm").submit(function(event) {
            event.preventDefault();
            var element = $(this)
            //  $("button[type=submit]").prop('disabled',true);
            $.ajax({
                url: '{{ route('account.addressUpdate') }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    // $("button[type=submit]").prop('disabled',false);
                    if (response.status == true) {
                        $("#first_name").siblings("p").removeClass("invalid-feedback").html('');
                        $("#first_name").removeClass("is-invalid");

                        $("#last_name").siblings("p").removeClass("invalid-feedback").html('');
                        $("#last_name").removeClass("is-invalid");

                        $("#addressForm #email").siblings("p").removeClass("invalid-feedback").html('');
                        $("#addressForm #email").removeClass("is-invalid");

                        $("#mobile").siblings("p").removeClass("invalid-feedback").html('');
                        $("#mobile").removeClass("is-invalid");

                        $("#country_id").siblings("p").removeClass("invalid-feedback").html('');
                        $("#country_id").removeClass("is-invalid");

                        $("#city").siblings("p").removeClass("invalid-feedback").html('');
                        $("#city").removeClass("is-invalid");

                        $("#state").siblings("p").removeClass("invalid-feedback").html('');
                        $("#state").removeClass("is-invalid");

                        $("#zip").siblings("p").removeClass("invalid-feedback").html('');
                        $("#zip").removeClass("is-invalid");

                        window.location.href = "{{ route('account.profile') }}"
                    } else {

                        var errors = response.errors;
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

                        if (errors.email) {
                            $("#addressForm #email").siblings("p").addClass("invalid-feedback").html(
                                errors.email);
                            $("#addressForm #email").addClass("is-invalid");
                        } else {
                            $("#addressForm #email").siblings("p").removeClass("invalid-feedback").html(
                                '');
                            $("#addressForm #email").removeClass("is-invalid");
                        }
                        if (errors.mobile) {
                            $("#mobile").siblings("p").addClass("invalid-feedback").html(errors.mobile);
                            $("#mobile").addClass("is-invalid");
                        } else {
                            $("#mobile").siblings("p").removeClass("invalid-feedback").html('');
                            $("#mobile").removeClass("is-invalid");
                        }

                        if (errors.country_id) {
                            $("#country_id").siblings("p").addClass("invalid-feedback").html(errors
                                .country_id);
                            $("#country_id").addClass("is-invalid");
                        } else {
                            $("#country_id").siblings("p").removeClass("invalid-feedback").html('');
                            $("#country_id").removeClass("is-invalid");
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



                    }
                }
            });
        })  //
    </script>
@endsection
