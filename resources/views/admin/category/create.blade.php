@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Category</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('category.show') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form enctype="multipart/form-data" action="{{ route('category.store') }}" method='post' id='categoryForm'
                name='categoryForm'>
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="category_name">Name</label>
                                    <input type="text" value="" name="category_name" id="category_name"
                                        class="form-control" placeholder="Name">
                                    <p></p>


                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="category_slug">Slug</label>
                                    <input value="" type="text" readonly name="category_slug" id="category_slug"
                                        class=" form-control" placeholder="Slug">

                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="hidden" name="image_id" id="image_id" value=" "
                                        class="form-control">
                                    <label for="image">Choose image</label>
                                    {{-- <input type="file" name="category_img" id="image" class="form-control" placeholder="Slug"> --}}
                                    <div id="image" class="dropzone dz-clickable">
                                        <div class="dz-message needsclick">
                                            <br>Drop files here or click to upload.<br><br>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select id="status" name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Block</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="showHome">Show on Home</label>
                                    <select id="showHome" name="showHome" class="form-control">
                                        <option value="YES">YES</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('category.show') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>

        </div>
        <!-- /.card -->
        </form>
    </section>
@endsection

@section('customJS')
    <script>
        $("#categoryForm").submit(function(event) {
            event.preventDefault();
            var element = $(this)
            $.ajax({
                url: '{{ route('category.store') }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == true) {

                        $("#category_name").siblings("p").removeClass("invalid-feedback").html('');
                        $("#category_name").removeClass("is-invalid");

                        $("#category_slug").siblings("p").removeClass("invalid-feedback").html('');
                        $("#category_slug").removeClass("is-invalid");

                        window.location.href = "{{ route('category.show') }}"
                    } else {
                        var errors = response['errors'];

                        if (errors['category_name']) {
                            $("#category_name").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['category_name']);
                        } else {
                            $("#category_name").siblings("p").removeClass("invalid-feedback").html('');
                            $("#category_name").removeClass("is-invalid");
                        }


                        if (errors['category_slug']) {
                            $("#category_slug").addClass('is-invalid').siblings('p').addClass(
                                    'invalid-feedback')
                                .html(errors['category_slug']);
                        } else {
                            $("#category_slug").siblings("p").removeClass("invalid-feedback").html('');
                            $("#category_slug").removeClass("is-invalid");
                        }

                    }

                },
                error: function(jqXHR, exception) {
                    console.log('something went wrong');
                }
            })
        })
    </script>
    <script>
        $("#category_name").change(function() {
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
                        $("#category_slug").val(response["slug"]);
                    }

                }
            })
        })

        Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            init: function() {
                this.on('addedfile', function(file) {
                    if (this.files.length > 1) {
                        this.removeFile(this.files[0]);
                    }
                });
            },
            url: "{{ route('temp-images.create') }}",
            maxFiles: 1,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(file, response) {
                $("#image_id").val(response.image_id);
                //console.log(response)
            }
        });
    </script>
@endsection
