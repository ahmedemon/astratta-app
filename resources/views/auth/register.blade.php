@extends('layouts.frontend.app', ['pageTitle' => 'Register'])

@section('content')
    <div class="container-fluid px-0 bg-white d-flex">
        <div class="sign-up-form-section">
            <div class="container px-0">
                <div class="row justify-content-between mx-auto">
                    <div class="form-left-side-container col-lg-8 col-xl-8 col-xxl-8 col-md-12"></div>
                    <div class="form-right-side-container col-lg-4 col-xl-4 col-xxl-4 col-md-12 d-flex justify-content-lg-end pe-lg-0 pe-xl-0 pe-xxl-0">
                        <div class="form-right-side px-0">
                            <h1 class="my-0">Sign Up</h1>
                            @if (count($errors) > 0)
                                @foreach ($errors->all() as $error)
                                    <small class="text-danger">{{ $error }}</small>
                                @endforeach
                            @endif
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="inputGroup mb30">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" class="px-0 form-control rounded-0 border-0 border-bottom border-secondary shadow-none @error('username') is-invalid @enderror" placeholder="johndoe" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus />
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                                <div class="inputGroup mb30">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" class="px-0 form-control rounded-0 border-0 border-bottom border-secondary shadow-none @error('email') is-invalid @enderror" placeholder="info@enample.com" name="email" value="{{ old('email') }}" required autocomplete="email" />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                                <div class="inputGroup mb30">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" class="px-0 form-control rounded-0 border-0 border-bottom border-secondary shadow-none @error('password') is-invalid @enderror" placeholder="Enter your password" name="password" required autocomplete="new-password" />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                                <div class="inputGroup mb20">
                                    <label for="password-confirm">Confirm Password</label>
                                    <input type="password" id="password-confirm" class="px-0 form-control rounded-0 border-0 border-bottom border-secondary shadow-none" placeholder="Enter your password again" name="password_confirmation" required autocomplete="new-password" />
                                </div>
                                <div class="inputGroup form-check mb30">
                                    <div class="d-flex align-items-center">
                                        <input type="checkbox" class="form-check-input" id="privacy_policy" name="privacy_policy" value="1" required />
                                        <label class="form-check-label" for="privacy_policy">I agree to the <a href="">privary policy</a></label>
                                    </div>
                                    @error('privacy_policy')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn rounded-0 border-0 login">CREATE ACCOUNT</button>
                                <a href="{{ route('login') }}" class="sub-link">Sign In Insted</a>
                                <div class="d-flex justify-content-between align-items-center or">
                                    <hr />
                                    <small>Or</small>
                                    <hr />
                                </div>
                                <a href="{{ route('seller.join-us') }}" class="btn rounded-0 sign-in-button create-account">JOIN AS AN ARTIST</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
