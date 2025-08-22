@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Discount Coupon</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('coupon.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form enctype="multipart/form-data" action="{{ route('coupon.store') }}" method='post' id='discountForm'
                name='discountForm'>
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Coupon Code</label>
                                    <input type="text" name="code" id="code" value=""
                                        placeholder="Coupon Code" class="form-control">

                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name"> Coupon Name</label>
                                    <input type="text" name="name" id="name" value=""
                                        placeholder="Coupon Name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Active</option>

                                        <option value="0">Block</option>
                                    </select>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type">Coupon Type</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="percent">Percent</option>

                                        <option value="fixed">Fixed</option>
                                    </select>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="max_uses">Maximum Uses</label>
                                    <input type="number" name="max_uses" id="max_uses" value=""
                                        placeholder="max_uses" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="max_uses_user">Maximum Uses User</label>
                                    <input type="number" name="max_uses_user" id="max_uses_user" value=""
                                        placeholder="max_uses_user" class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="discount_amount">Discount Amount</label>
                                    <input type="text" name="discount_amount" id="discount_amount" value=""
                                        placeholder="discount_amount" class="form-control">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="min_amount">Minimum Amount</label>
                                    <input type="text" name="min_amount" id="min_amount" value=""
                                        placeholder="min_amount" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="starts_at">Start Date</label>
                                    <input autocomplete="off" type="text" name="starts_at" id="starts_at" value=""
                                        placeholder="starts_at" class="form-control">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="expires_at">Expire Date</label>
                                    <input autocomplete="off" type="text" name="expires_at" id="expires_at"
                                        value="" placeholder="expires_at" class="form-control">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="pb-5 pt-3">
                            <button type="submit" class="btn btn-primary">Create</button>
                            <a href="{{ route('coupon.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                        </div>
                    </div>
                </div>
        </div>
        <!-- /.card -->
        </form>
    </section>
@endsection

@section('customJS')
    <script type="text/javascript">
        //for datepicker
        $(document).ready(function() {
            $('#starts_at').datetimepicker({
                // options here
                format: 'Y-m-d H:i:s',
            });

            $('#expires_at').datetimepicker({
                // options here
                format: 'Y-m-d H:i:s',
            });
        });

        //submit discount form
        $("#discountForm").submit(function(event) {
            event.preventDefault();
            var element = $(this)
            $.ajax({
                url: "{{ route('coupon.store') }}",
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == true) {
                        window.location.href = "{{ route('coupon.index') }}"
                        $("#code").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback')
                            .html(errors['code']);

                        $("#type").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback')
                            .html(errors['type']);
                        $("#discount_amount").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback')
                            .html(errors['discount_amount']);

                        $("#status").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback')
                            .html(errors['status']);
                        $("#starts_at").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback')
                            .html(errors['starts_at']);
                        $("#expires_at").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback')
                            .html(errors['expires_at']);

                    } else {
                        var errors = response['errors'];

                        if (errors['code']) {
                            $("#code").addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                                .html(errors['code']);
                        } else {
                            $("#code").removeClass('is-invalid').siblings('p').removeClass(
                                    'invalid-feedback')
                                .html(errors['']);
                        }

                        if (errors['type']) {
                            $("#type").addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                                .html(errors['type']);
                        } else {
                            $("#type").removeClass('is-invalid').siblings('p').removeClass(
                                    'invalid-feedback')
                                .html(errors['']);
                        }
                        if (errors['discount_amount']) {
                            $("#discount_amount").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['discount_amount']);
                        } else {
                            $("#discount_amount").removeClass('is-invalid').siblings('p').removeClass(
                                    'invalid-feedback')
                                .html(errors['']);
                        }
                       
                        if (errors['status']) {
                            $("#status").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['status']);
                        } else {
                            $("#status").removeClass('is-invalid').siblings('p').removeClass(
                                    'invalid-feedback')
                                .html(errors['']);
                        }
                        if (errors['starts_at']) {
                            $("#starts_at").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['starts_at']);
                        } else {
                            $("#starts_at").removeClass('is-invalid').siblings('p').removeClass(
                                    'invalid-feedback')
                                .html(errors['']);
                        }
                        if (errors['expires_at']) {
                            $("#expires_at").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['expires_at']);
                        } else {
                            $("#expires_at").removeClass('is-invalid').siblings('p').removeClass(
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
    </script>
@endsection
