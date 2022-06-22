@extends('layouts.frontend.app', ['pageTitle' => 'Login'])

@section('content')
    <div class="container-fluid px-0 bg-white d-flex">
        <div class="sign-in-form-section">
            <div class="container px-0">
                <div class="row justify-content-between mx-auto">
                    <div class="form-left-side-container col-lg-8 col-xl-8 col-xxl-8 col-md-12"></div>
                    <div class="form-right-side-container col-lg-4 col-xl-4 col-xxl-4 col-md-12 d-flex justify-content-lg-end pe-lg-0 pe-xl-0 pe-xxl-0">
                        <div class="form-right-side px-0">
                            <h1 class="my-0">Sign In</h1>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="inputGroup mb30">
                                    <label for="username">Username / Email</label>
                                    <input type="text" name="login" id="username" class="px-0 form-control rounded-0 border-0 border-bottom border-secondary shadow-none @error('login') is-invalid @enderror" placeholder="info@example.com" value="{{ old('login') }}" required autocomplete="login" autofocus />
                                    @error('login')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                                <div class="inputGroup mb20">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" class="px-0 form-control rounded-0 border-0 border-bottom border-secondary shadow-none" placeholder="Enter your password here" name="password" required autocomplete="current-password" />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                                <div class="inputGroup form-check mb30">
                                    <div class="d-flex align-items-center">
                                        <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                                        <label class="form-check-label" for="remember">Remember me</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn rounded-0 border-0 login">LOGIN</button>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="sub-link">Forget Password?</a>
                                @endif
                                <div class="d-flex justify-content-between align-items-center or">
                                    <hr />
                                    <small>Or</small>
                                    <hr />
                                </div>
                                <a href="{{ route('register') }}" class="btn rounded-0 sign-in-button create-account">CREATE ACCOUNT</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
