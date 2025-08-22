@extends('frontend.layouts.app')
@section('content')
    <main>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}

                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}

                    </div>
                @endif
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                        <li class="breadcrumb-item">Reset Password</li>
                    </ol>
                </div>
            </div>
        </section>
        <section class=" section-10">
            <div class="container">
                <div class="login-form">
                    <form action="{{ route('front.processResetPassword') }}" method="post">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <h4 class="modal-title">Login to Your Account</h4>
                        <div class="form-group">
                            <input name="new_password" id="new_password" type="password"
                                class="form-control @error('new_password') is-invalid  @enderror" placeholder="New Password"
                                value="">
                            @error('new_password')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input name="confirm_password" id="confirm_password" type="password"
                                class="form-control @error('confirm_password') is-invalid  @enderror"
                                placeholder="Confirm Password" value="">
                            @error('confirm_password')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <input type="submit" class="btn btn-dark btn-block btn-lg" value="submit">
                    </form>
                    <div class="text-center small"> <a href="{{ route('account.login') }}">Login</a></div>
                </div>
            </div>
        </section>
    </main>
@endsection
