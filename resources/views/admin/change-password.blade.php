@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="col-md-12">
                @include('admin.message');
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Change Password</h1>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form enctype="multipart/form-data" action="{{ route('admin.updatePassword') }}" method='post'
                id='changePasswordForm' name='changePasswordForm'>
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="old_name"> Old Password</label>
                                    <input type="text" value='{{ old('old_password') }}' name="old_password"
                                        id="old_password" class="form-control" placeholder="Old Password">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="new_password">New Password</label>
                                    <input value="{{ old('new_password') }}" type="text" name="new_password"
                                        id="new_password" class=" form-control" placeholder="New Password">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="new_password">Confirm Password</label>
                                    <input value="{{ old('confirm_password') }}" type="text" name="confirm_password"
                                        id="confirm_password" class=" form-control" placeholder="Confirm Password">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
        </div>
        <!-- /.card -->
        </form>
    </section>
@endsection

@section('customJS')
    <script>
        $("#changePasswordForm").submit(function(event) {
            event.preventDefault();
            var element = $(this)
            $("button[type=submit]").prop('disabled', true);
            $.ajax({
                url: '{{ route('admin.updatePassword') }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    $("button[type=submit]").prop('disabled', false);
                    if (response['status'] == true) {


                        $("#old_password").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback')
                            .html(errors['old_password']);

                        $("#new_password").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback')
                            .html(errors['new_password']);
                        $("#confirm_password").removeClass('is-invalid').siblings('p').removeClass(
                                'invalid-feedback')
                            .html(errors['confirm_password']);

                        window.location.href = "{{ route('admin.changePassword') }}"
                    } else {
                        var errors = response['errors'];

                        if (errors['old_password']) {
                            $("#old_password").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['old_password']);
                        }
                        if (errors['new_password']) {
                            $("#new_password").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['new_password']);
                        }
                        if (errors['confirm_password']) {
                            $("#confirm_password").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['confirm_password']);
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
