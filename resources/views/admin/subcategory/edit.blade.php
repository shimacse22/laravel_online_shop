@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit SubCategory</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('subcategory.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form enctype="multipart/form-data" action="{{ route('subcategory.update', $subcategory->id) }}" method='post'
                id='subCategoryForm' name='subCategoryForm'>
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="name">Category</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        @if ($categories->isNotEmpty())
                                            @foreach ($categories as $category)
                                                <option {{ $subcategory->category_id == $category->id ? 'selected' : '' }}
                                                    value='{{ $category->id }}'>{{ $category->category_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" value='{{ old('name', $subcategory->name) }}' name="name"
                                        id="name" class="form-control" placeholder="Name">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input value="{{ old('slug', $subcategory->slug) }}" type="text" name="slug"
                                        id="slug" class="form-control" placeholder="Slug">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select id="status" name="status" class="form-control">
                                        <option {{ $subcategory->status == '1' ? 'selected' : '' }} value="1">Active
                                        </option>
                                        <option {{ $subcategory->status == '0' ? 'selected' : '' }} value="0">Block
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="showHome">Show on Home</label>
                                    <select id="showHome" name="showHome" class="form-control">
                                        <option {{ $subcategory->showHome == 'YES' ? 'selected' : '' }} value="YES">YES
                                        </option>
                                        <option {{ $subcategory->showHome == 'NO' ? 'selected' : '' }} value="NO">NO
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('subcategory.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
        </div>
        <!-- /.card -->
        </form>
    </section>
@endsection

@section('customJS')
    <script>
        $("#subCategoryForm").submit(function(event) {
            event.preventDefault();
            var element = $(this)
            $.ajax({
                url: '{{ route('subcategory.update', $subcategory->id) }}',
                type: 'put',
                data: element.serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == true) {

                        $("#name").siblings("p").removeClass("invalid-feedback").html('');
                        $("#name").removeClass("is-invalid");

                        $("#slug").siblings("p").removeClass("invalid-feedback").html('');
                        $("#slug").removeClass("is-invalid");

                        window.location.href = "{{ route('subcategory.index') }}"
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
