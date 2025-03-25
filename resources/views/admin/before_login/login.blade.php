
@extends('admin.layout.loginapp')

@section('content')
        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-6 col-lg-6">
                        <div class="card overflow-hidden">
                            <div class="row g-0">
                                <div class="col-lg-12">
                                    <div class="d-flex flex-column h-100">
                                        <div class="auth-brand p-4">
                                            <a href="index.html" class="logo-dark" style="text-align: center;">
                                                <img src="{{ asset('web/images/svg/logo_inline.svg') }}" alt="dark logo" height="100">
                                            </a>
                                        </div>
                                        <div class="p-4 my-auto">
                                            
                                            <h4 class="fs-20">Sign In</h4>
                                            <p class="text-muted mb-3">Enter your email address and password to access account. </p>

                                            <!-- form -->
                                            <form  action="{{route('signin')}}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="emailaddress" class="form-label">Email address</label>
                                                    <input class="form-control" type="email" id="emailaddress" required="" name="email" placeholder="Enter your email" value="{{old('email')}} ">
                                                </div>
                                                <div class="mb-3">
                                                    <a href="auth-forgotpw.html" class="text-muted float-end"><small>Forgot
                                                            your
                                                            password?</small></a>
                                                    <label for="password" class="form-label">Password</label>
                                                    <input name="password" class="form-control" type="password" required="" id="password" placeholder="Enter your password">

                                                </div>

                                                <div class="mb-0 text-start">
                                                    <button class="btn btn-soft-primary w-100" type="submit">
                                                        <i class="ri-login-circle-fill me-1"></i> <span class="fw-bold">Log In</span> </button>
                                                </div>

                                            </form>
                                            <!-- end form-->
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
@endsection

