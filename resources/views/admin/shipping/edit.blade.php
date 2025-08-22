@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Shipping Management</h1>
                </div>

            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif
            <form enctype="multipart/form-data" action="{{ route('shipping.update', $shippingCharge->id) }}" method='post'
                id='shippingForm' name='shippingForm'>
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <select name="country" id="country" class="form-control">
                                        <option value="">Select a country</option>
                                        @if (!empty($countries))
                                            @foreach ($countries as $country)
                                                <option {{ $shippingCharge->country_id == $country->id ? 'selected' : '' }}
                                                    value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                            <option {{ $shippingCharge->country_id == 'rest_of_world' ? 'selected' : '' }}
                                                value="rest_of_world">Rest of the world</option>
                                        @endif
										</select>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <input type="text" value="{{ $shippingCharge->amount }}" name="amount"
                                        id="amount" value="" placeholder="Amount" class="form-control">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary" class="form-control">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <!-- /.card -->
        </form>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                            @if (!empty($shippingCharges))
                                @foreach ($shippingCharges as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->country_id == 'rest_of_world' ? 'Rest of the World ' : $item->name }}
                                        </td>
                                        <td>{{ $item->amount }}</td>
                                        <td>
                                            <a href="" class="btn btn-primary">Edit</a>
                                            <a href="" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('customJS')
    <script>
        $("#shippingForm").submit(function(event) {
            event.preventDefault();
            var element = $(this)
            $.ajax({
                url: "{{ route('shipping.update', $shippingCharge->id) }}",
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == true) {
                        window.location.href = "{{ route('shipping.create') }}"
                        $("#country").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback')
                            .html(errors['country']);

                        $("#amount").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback')
                            .html(errors['amount']);

                    } else {
                        var errors = response['errors'];

                        if (errors['country']) {
                            $("#country").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['country']);
                        } else {
                            $("#country").removeClass('is-invalid').siblings('p').removeClass(
                                    'invalid-feedback')
                                .html(errors['']);
                        }

                        if (errors['amount']) {
                            $("#amount").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['amount']);
                        } else {
                            $("#amount").removeClass('is-invalid').siblings('p').removeClass(
                                    'invalid-feedback')
                                .html(errors['']);
                        }
                    }

                },
                error: function(jqXHR, exception) {
                    console.log('something went wrong');
                }
            })
        })
    </script>
@endsection
