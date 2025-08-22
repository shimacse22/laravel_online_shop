@extends('user.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">					
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create User</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="users.html" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="{{route('product.store')}}" method='post' id='productForm' name='productForm' >
            @method('put')
            @csrf
        <!-- Default box -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">								
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input  value="{{ old('name') }}" type="text" name="name" id="name" class="@error('name') is-invalid @enderror form-control" placeholder="Name">
                                @error('name')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror		
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input  value="{{ old('email') }}" type="text" name="email" id="email" class="@error('email') is-invalid @enderror form-control" placeholder="Email">
                                @error('email')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror	
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="phone">Phone</label>
                                <input  value="{{ old('phone') }}" type="text" name="phone" id="phone" class="@error('phone') is-invalid @enderror" placeholder="Phone">
                                @error('phone')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror	
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="phone">Address</label>
                                <textarea name="address" id="address" class="form-control" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>							
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="users.html" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </div>
        <!-- /.card -->
        </form>
    </section>
    <!-- /.content -->
@endsection