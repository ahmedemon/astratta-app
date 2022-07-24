@extends('layouts.frontend.app', ['pageTitle' => $pageTitle])

@section('content')
    <div class="container-fluid px-0 bg-white d-flex">
        <div class="join-us-form-section join-us">
            <div class="container px-0">
                <div class="row justify-content-between mx-auto">
                    <div class="form-left-side-container col-lg-8 col-xl-8 col-xxl-8 col-md-12"></div>
                    <div class="form-right-side-container col-lg-4 col-xl-4 col-xxl-4 col-md-12 d-flex justify-content-lg-end pe-lg-0 pe-xl-0 pe-xxl-0">
                        <div class="form-right-side px-0">
                            <h1 class="my-0">Join Us</h1>
                            @if (count($errors) > 0)
                                @foreach ($errors->all() as $error)
                                    <small class="text-danger">{{ $error }}</small>
                                @endforeach
                            @endif
                            <form action="{{ route('seller.join') }}" method="POST" enctype="multipart/form-data">
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
                                    <label for="phone">Phone</label>
                                    <input type="tel" id="phone" class="px-0 form-control rounded-0 border-0 border-bottom border-secondary shadow-none @error('phone') is-invalid @enderror" placeholder="830-541-2357" name="phone" value="{{ old('phone') }}" required autocomplete="phone" />
                                    @error('phone')
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
                                <div class="inputGroup mb30">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" id="password_confirmation" class="px-0 form-control rounded-0 border-0 border-bottom border-secondary shadow-none @error('password_confirmation') is-invalid @enderror" placeholder="Enter your password again" name="password_confirmation" required autocomplete="new-password" />
                                </div>
                                <div class="inputGroup mb30">
                                    <label for="images" class="mb-2">Your Paintings</label>
                                    <input type="file" id="images" name="images[]" class="shadow-none" multiple />
                                </div>
                                <div class="inputGroup form-check mb15">
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
                                <div class="inputGroup form-check mb30">
                                    <div class="d-flex align-items-center">
                                        <input type="checkbox" name="contact_agreement" class="form-check-input" value="1" id="contact_agreement" />
                                        <label class="form-check-label" for="contact_agreement">I agree to the <a href="">contact</a></label>
                                    </div>
                                    @error('contact_agreement')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn rounded-0 border-0 login">SEND FOR REVIEW</button>
                                <a href="{{ route('seller.log-in') }}" class="sub-link">Sign In Insted</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
