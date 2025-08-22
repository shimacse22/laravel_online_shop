@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Page</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('page.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('page.store') }}" method="post" name="pageForm" id="pageForm">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input value="" type="text" name="name" id="name" class="form-control"
                                        placeholder="Name">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email">Slug</label>
                                    <input value="" type="text" name="slug" id="slug" class="form-control"
                                        placeholder="Slug">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="content">Content</label>
                                    <textarea value="" name="content" id="content" class="summernote" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('page.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
        </div>
        </form>
        <!-- /.card -->
    @endsection
    @section('customJS')
        <script>
            // Summernote
            $('.summernote').summernote({
                height: '300px'
            });

            //for slug
            $("#name").change(function() {
                element = $(this);
                $.ajax({
                    url: '{{ route('getSlug') }}',
                    type: 'get',
                    data: {
                        title: element.val()
                    },
                    dataType: 'json',
                    success: function(response) {

                        if (response["status"] == true) {
                            $("#slug").val(response["slug"]);
                        }

                    }
                })
            })

            //For form submit
            $("#pageForm").submit(function(event) {
                event.preventDefault();
                var element = $(this)
                $("button[type=submit]").prop('disabled', true);
                $.ajax({
                    url: '{{ route('page.store') }}',
                    type: 'post',
                    data: element.serializeArray(),
                    dataType: 'json',
                    success: function(response) {
                        $("button[type=submit]").prop('disabled', false);
                        if (response['status'] == true) {

                            $("#name").siblings("p").removeClass("invalid-feedback").html('');
                            $("#name").removeClass("is-invalid");

                            $("#slug").siblings("p").removeClass("invalid-feedback").html('');
                            $("#slug").removeClass("is-invalid");

                            window.location.href = "{{ route('page.index') }}"
                        } else {
                            var errors = response['errors'];

                            if (errors['name']) {
                                $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                                    .html(errors['name']);
                            } else {
                                $("#name").siblings("p").removeClass("invalid-feedback").html('');
                                $("#name").removeClass("is-invalid");
                            }
                            if (errors['slug']) {
                                $("#slug").addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                                    .html(errors['slug']);
                            } else {
                                $("#slug").siblings("p").removeClass("invalid-feedback").html('');
                                $("#slug").removeClass("is-invalid");

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
