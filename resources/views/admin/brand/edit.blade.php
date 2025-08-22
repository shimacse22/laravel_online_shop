@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Edit Brand</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('brand.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form enctype="multipart/form-data" action="{{ route('brand.update', $brand->id) }}" method='post' id='brandForm'
                name='brandForm'>
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" value='{{ old('name', $brand->name) }}' name="name"
                                        id="name" class="form-control" placeholder="Name">
                                    <p></p>


                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input value="{{ old('slug', $brand->slug) }}" type="text" name="slug"
                                        id="slug" class="form-control" placeholder="Slug">
                                    <p></p>
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
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('brand.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>

        </div>
        <!-- /.card -->
        </form>
    </section>
@endsection

@section('customJS')
    <script>
        $("#brandForm").submit(function(event) {
            event.preventDefault();
            var element = $(this)
            $("button[type=submit]").prop('disabled', true);
            $.ajax({
                url: '{{ route('brand.update', $brand->id) }}',
                type: 'put',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    $("button[type=submit]").prop('disabled', false);
                    if (response['status'] == true) {

                        $("#name").siblings("p").removeClass("invalid-feedback").html('');
                        $("#name").removeClass("is-invalid");

                        $("#slug").siblings("p").removeClass("invalid-feedback").html('');
                        $("#slug").removeClass("is-invalid");

                        window.location.href = "{{ route('brand.index') }}"
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
    <script>
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
    </script>
@endsection
