@extends('layout.layout_customer')
@section('title')
    Reset password
@endsection
@section('content')
    <div class="content-header row"></div>
    <div class="content-body">
        <section class="row flexbox-container">
            <div class="col-xl-7 col-10 d-flex justify-content-center">
                <div class="card bg-authentication rounded-0 mb-0 w-100">
                    <div class="row m-0">
                        <div class="col-lg-6 d-lg-block d-none text-center align-self-center p-0">
                            <img src="../../../app-assets/images/pages/reset-password.png" alt="branding logo">
                        </div>
                        <div class="col-lg-6 col-12 p-0">
                            <div class="card rounded-0 mb-0 px-2">
                                <div class="card-header pb-1">
                                    <div class="card-title">
                                        <h4 class="mb-0">Reset Password</h4>
                                    </div>
                                </div>
                                <p class="px-2">Please enter your new password.</p>
                                <div class="card-content">
                                    <div class="card-body pt-1">
                                        <form action="/post-reset-password" method="POST">
                                            <input type="hidden" name="token" value="{{ $token }}">
                                            <input type="hidden" name="email" value="{{ $email }}">
                                            <fieldset class="form-label-group">
                                                <input type="password" class="form-control" id="user-password"
                                                    placeholder="Password" name="password">
                                                <label for="user-password">New Password</label>
                                            </fieldset>

                                            <fieldset class="form-label-group">
                                                <input type="password" class="form-control" id="user-confirm-password"
                                                    placeholder="Confirm Password" name="confirm_password">
                                                <label for="user-confirm-password">Confirm New Password</label>
                                            </fieldset>
                                            <div class="row pt-2">
                                                <div class="col-12 col-md-6 mb-1">
                                                    <a href="/signin" class="btn btn-outline-primary btn-block px-0">Go Back
                                                        to Login</a>
                                                </div>
                                                <div class="col-12 col-md-6 mb-1">
                                                    <button type="submit"
                                                        class="btn btn-primary btn-block px-0">Reset</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
