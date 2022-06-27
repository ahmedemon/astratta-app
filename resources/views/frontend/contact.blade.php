@extends('layouts.frontend.app', ['pageTitle' => $pageTitle])
@section('content')
    <div class="container-fluid px-0 bg-white product-view-page-container">
        <!-- breadcrumb start -->
        <div class="breadcrumb">
            <div class="container d-flex align-items-center">
                <div class="bct">
                    <h1 class="my-0">{{ $pageTitle }}</h1>
                    <p class="my-0">
                        <a href="/" class="text-decoration-none text-light">Home</a>
                        /
                        <a href="javascript:void();" class="text-decoration-none text-light">Contact</a>
                    </p>
                </div>
            </div>
            <svg width="475" height="288" viewBox="0 0 475 288" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g filter="url(#filter0_f_110_1804)">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M117.96 -43.3436C164.674 -53.6429 217.107 -38.8116 250.445 -4.53717C284.977 30.9654 304.906 85.8984 289.387 132.899C275.254 175.704 220.835 183.759 181.174 205.261C154.635 219.65 129.573 232.356 99.5724 235.808C60.0245 240.358 17.2217 251.143 -15.0363 227.837C-52.6431 200.666 -88.9656 153.381 -76.1943 108.819C-63.5742 64.7844 2.06967 70.5434 38.1466 42.2692C70.076 17.2456 78.3263 -34.6054 117.96 -43.3436Z" fill="url(#paint0_linear_110_1804)" />
                </g>
                <defs>
                    <filter id="filter0_f_110_1804" x="-258.803" y="-226.56" width="733.528" height="648.854" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                        <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
                        <feGaussianBlur stdDeviation="90" result="effect1_foregroundBlur_110_1804" />
                    </filter>
                    <linearGradient id="paint0_linear_110_1804" x1="-76.0763" y1="83.8635" x2="294.355" y2="108.264" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#FF007D" />
                        <stop offset="1" stop-color="#B627DC" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
        <!-- breadcrumb end -->

        <!-- get in touch start -->
        <div class="get-in-touch">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-5 px-lg-0 px-xl-0 px-xxl-0">
                        <h1>Get In Touch With Us</h1>
                        <p>send us a message we will reply shortly.</p>

                        <table class="table tabel borderless">
                            <tr class="border-white">
                                <td><i class="fas fa-phone-alt"></i></td>
                                <td class="details-td">
                                    880 16111 02145 <br />
                                    880 16111 02145
                                </td>
                            </tr>
                            <tr class="border-white">
                                <td><i class="fas fa-envelope"></i></td>
                                <td class="details-td">info@astratta.com</td>
                            </tr>
                            <tr class="border-white">
                                <td><i class="fas fa-map-marker-alt"></i></td>
                                <td class="details-td">1122 Rollins Road, Cambridge, Nebraska - 69022</td>
                            </tr>
                        </table>
                        <div class="social-links">
                            <a href="" class=""><i class="fab fa-facebook-f"></i></a>
                            <a href="" class=""><i class="fab fa-instagram"></i></a>
                            <a href="" class=""><i class="fab fa-linkedin-in"></i></a>
                            <a href="" class=""><i class="fab fa-youtube"></i></a>
                            <a href="" class=""><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                    <div class="col-md-7 form-box bg-white d-flex justify-content-end">
                        <div class="get-in-touch-form">
                            <form action="{{ route('contact.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="buyer_id" value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->id : '' }}">
                                <input type="hidden" name="seller_id" value="{{ Auth::guard('seller')->check() ? Auth::guard('seller')->user()->id : '' }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-md-12 group">
                                            <label for="name" class="label">Name</label>
                                            <input type="text" class="form-control rounded-0 border-0 border-bottom border-secondary shadow-none p-0 @error('name') is-invalid @enderror" placeholder="John doe" name="name" value="{{ old('name') }}" required />
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 group">
                                            <label for="subject" class="label">Subject</label>
                                            <input type="text" class="form-control rounded-0 border-0 border-bottom border-secondary shadow-none p-0 @error('subject') is-invalid @enderror" placeholder="Enter Subject" name="subject" value="{{ old('subject') }}" required />
                                            @error('subject')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-grid justify-content-end">
                                        <div class="col-md-12 group">
                                            <label for="phone" class="label">Phone</label>
                                            <input type="tel" class="form-control rounded-0 border-0 border-bottom border-secondary shadow-none p-0 @error('phone') is-invalid @enderror" placeholder="Enter Phone Number" name="phone" value="{{ old('phone') }}" required />
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 group">
                                            <label for="email" class="label">E-mail</label>
                                            <input type="email" class="form-control rounded-0 border-0 border-bottom border-secondary shadow-none p-0 @error('email') is-invalid @enderror" placeholder="johndoe@example.com" name="email" value="{{ old('email') }}" required />
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="message" class="label">Message</label>
                                        <textarea type="text" class="textarea form-control rounded-0 border-0 border-bottom border-secondary shadow-none p-0 @error('message') is-invalid @enderror" placeholder="Type your message here.." name="message" required>{{ old('message') }}</textarea>
                                        @error('message')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <button class="sign-up-button" type="submit">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- get in touch start -->

        <!-- map start -->
        <div class="map bg-white">
            <div class="container">
                <iframe class="w-100" src="https://www.google.com/maps/embed?mb=!1m18!1m12!1m3!1d7299.897638059697!2d90.41882997638328!3d23.820418953147257!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c64e5249ad39%3A0x2392867b037e718e!2sKuril%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1654150587843!5m2!1sen!2sbd" width="600" height="510" style="border: 0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <!-- map end -->
    </div>
@endsection
