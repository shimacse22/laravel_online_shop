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
            @include('admin.message')
            <form enctype="multipart/form-data" action="{{ route('shipping.store') }}" method='post' id='shippingForm'
                name='shippingForm'>
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
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                            <option value="rest_of_world">Rest of the world</option>
                                        @endif
                                    </select>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <input type="text" name="amount" id="amount" value="" placeholder="Amount"
                                        class="form-control">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary" class="form-control">Create</button>
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
                                            <a href="{{ route('shipping.edit', $item->id) }}"
                                                class="btn btn-primary">Edit</a>
                                            <a href=" javascript:void(0);" onclick="deleteShipping({{ $item->id }})"
                                                class="btn btn-danger">Delete</a>
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
                url: "{{ route('shipping.store') }}",
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
        });
        //for delete shipping charges
        function deleteShipping(id) {
            var url = '{{ route('shipping.delete', 'ID') }}'
            var newUrl = url.replace("ID", id)
            if (confirm("Are you sure you want to delete this cart?")) {
                $.ajax({
                    url: newUrl,
                    type: 'delete',
                    data: {},
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        window.location.href = "{{ route('shipping.create') }}";
                    }
                });
            }
        }
    </script>
@endsection
