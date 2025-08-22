<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Shop :: Administrative Panel</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/custom.css') }}">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h3">Administrative Panel</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign up to start your session</p>
                <form action="{{ route('admin.store') }}" name="registrationForm" id= "registrationForm" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                        <p></p>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                        <p></p>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Phone" id="phone" name="phone">
                        <p></p>
                    </div>
                    <div class="input-group mb-3">
                        <input name="password" id="password" type="password" class="form-control"
                            placeholder="Password">
                        <p></p>
                    </div>
                    <div class="input-group mb-3">
                        <input name="password_confirmation" id="password_confirmation" type="password"
                            class="form-control" placeholder=" Confirm Password">
                        <p></p>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin-assets/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('admin-assets/js/demo.js') }}"></script>
    <script>
        $("#registrationForm").submit(function(event) {
            event.preventDefault();
            var element = $(this)
            $("button[type=submit]").prop('disabled', true);
            $.ajax({
                url: '{{ route('admin.store') }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    $("button[type=submit]").prop('disabled', false);
                    var errors = response.errors;

                    if (response.status == false) {
                        if (errors.name) {
                            $("#name").siblings("p").addClass("invalid-feedback").html(errors.name);
                            $("#name").addClass("is-invalid");
                        } else {
                            $("#name").siblings("p").removeClass("invalid-feedback").html('');
                            $("#name").removeClass("is-invalid");
                        }

                        if (errors.email) {
                            $("#email").siblings("p").addClass("invalid-feedback").html(errors.email);
                            $("#email").addClass("is-invalid");
                        } else {
                            $("#email").siblings("p").removeClass("invalid-feedback").html('');
                            $("#email").removeClass("is-invalid");
                        }
                        if (errors.phone) {
                            $("#phone").siblings("p").addClass("invalid-feedback").html(errors.phone);
                            $("#phone").addClass("is-invalid");
                        } else {
                            $("#phone").siblings("p").removeClass("invalid-feedback").html('');
                            $("#phone").removeClass("is-invalid");
                        }
                        if (errors.password) {
                            $("#password").siblings("p").addClass("invalid-feedback").html(errors
                                .password);
                            $("#password").addClass("is-invalid");
                        } else {
                            $("#password").siblings("p").removeClass("invalid-feedback").html('');
                            $("#password").removeClass("is-invalid");
                        }

                    } else {

                        $("#name").siblings("p").removeClass("invalid-feedback").html('');
                        $("#name").removeClass("is-invalid");

                        $("#email").siblings("p").removeClass("invalid-feedback").html('');
                        $("#email").removeClass("is-invalid");

                        $("#password").siblings("p").removeClass("invalid-feedback").html('');
                        $("#password").removeClass("is-invalid");

                        window.location.href = "{{ route('admin.login') }}"
                    }
                },
                error: function(jqXHR, exception) {
                    console.log('something went wrong');
                }
            });
        })
    </script>
</body>
</html>
