@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit User</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('user.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('user.update', $user->id) }}" method="post" name="userForm" id="userForm">
                @method('put')
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input value="{{ old('name', $user->name) }}" type="text" name="name"
                                        id="name" class="form-control" placeholder="Name">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input value="{{ old('email', $user->email) }}" type="text" name="email"
                                        id="email" class="form-control" placeholder="Email">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone">Phone</label>
                                    <input value="{{ old('phone', $user->phone) }}" type="text" name="phone"
                                        id="phone" class="form-control" placeholder="Phone">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone">Password</label>
                                    <input value="" type="text" name="password" id="password" class="form-control"
                                        placeholder="Password">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>

                                    <select name="status" id="status" class="form-control">Status
                                        <option {{ $user->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ $user->status == 0 ? 'selected' : '' }} value="0">Block</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('user.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
        </div>
        </form>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('customJS')
    <script type="text/javascript">
        $("#userForm").submit(function(event) {
            event.preventDefault();
            var element = $(this)
            $.ajax({
                url: '{{ route('user.update', $user->id) }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == true) {

                        $("#name").siblings("p").removeClass("invalid-feedback").html('');
                        $("#name").removeClass("is-invalid");

                        $("#email").siblings("p").removeClass("invalid-feedback").html('');
                        $("#email").removeClass("is-invalid");

                        $("#phone").siblings("p").removeClass("invalid-feedback").html('');
                        $("#phone").removeClass("is-invalid");

                        $("#password").siblings("p").removeClass("invalid-feedback").html('');
                        $("#password").removeClass("is-invalid");

                        window.location.href = "{{ route('user.index') }}"
                    } else {
                        var errors = response['errors'];

                        if (errors['name']) {
                            $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                                .html(errors['name']);
                        } else {
                            $("#name").siblings("p").removeClass("invalid-feedback").html('');
                            $("#name").removeClass("is-invalid");
                        }
                        if (errors['email']) {
                            $("#email").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['email']);
                        } else {
                            $("#email").siblings("p").removeClass("invalid-feedback").html('');
                            $("#email").removeClass("is-invalid");
                        }

                        if (errors['phone']) {
                            $("#phone").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['phone']);
                        } else {
                            $("#phone").siblings("p").removeClass("invalid-feedback").html('');
                            $("#phone").removeClass("is-invalid");
                        }

                        if (errors['password']) {
                            $("#password").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['password']);
                        } else {
                            $("#password").siblings("p").removeClass("invalid-feedback").html('');
                            $("#password").removeClass("is-invalid");
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
