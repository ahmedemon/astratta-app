    <div class="footer">
        <div class="container pb-0">
            <div class="row mx-auto justify-content-between">
                <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0 px-lg-2 px-4 col20">
                    <img class="footer-nav-logo" src="{{ asset('frontend/images/logo.png') }}" alt="" />
                    <p class="about ms-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sem non ornare nibh metus a. Faucibus dictumst et mattis vestibulum.</p>
                    <div class="social-links">
                        <a href="" class=""><i class="fab fa-facebook-f"></i></a>
                        <a href="" class=""><i class="fab fa-instagram"></i></a>
                        <a href="" class=""><i class="fab fa-linkedin-in"></i></a>
                        <a href="" class=""><i class="fab fa-youtube"></i></a>
                        <a href="" class=""><i class="fab fa-twitter"></i></a>
                    </div>
                </div>

                <div class="col-md-12 col-lg-6 col-xl-6 col60">
                    <div class="row">
                        <div class="col-6 mb-4 mb-lg-0 col50">
                            <ul class="link-section mb-5">
                                <h1 class="footer-heading">Links</h1>
                                <li class="list-group-item"><a href="/" class="">Home</a></li>
                                <li class="list-group-item"><a href="{{ route('painting.index') }}" class="">Painings</a></li>
                                <li class="list-group-item"><a href="{{ route('artist.index') }}" class="">Artists</a></li>
                                <li class="list-group-item"><a href="{{ route('blogs') }}" class="">Blog</a></li>
                                <li class="list-group-item"><a href="{{ route('about') }}" class="">About</a></li>
                                <li class="list-group-item"><a href="{{ route('contact') }}" class="">Contact</a></li>
                            </ul>
                            <div class="row">
                                <div class="col-12 mb-lg-0 px-4 sub-links">
                                    <a href="{{ route('contract') }}" class="sub-link d-block mb-3">Contract</a>
                                    <a href="" class="sub-link d-block">Privacy Policy</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-4 mb-lg-0 col50">
                            <ul class="contact-section">
                                <h1 class="footer-heading">Contact</h1>
                                <li class="list-group-item">4340 Wetzel Lane, Alden, Michigan, 49612</li>
                                <li class="list-group-item">231-331-3433</li>
                                <li class="list-group-item">989-273-5609</li>
                                <li class="list-group-item">info@astrattra.com</li>
                                <li class="list-group-item">contact@astrattra.com</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0 col20 d-lg-block d-md-block d-xl-block d-xxl-block d-none">
                    <div class="footer-gallery d-flex justify-content-lg-end justify-content-center">
                        <img class="gimg1" src="{{ asset('frontend/images/footer1.png') }}" alt="" />
                        <img class="gimg2" src="{{ asset('frontend/images/foot') }}er2.png" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-nav">
        <div class="container d-flex justify-content-between">
            <div class="">© {{ date('Y') }} Astratta | All Rights Reserved.</div>
            <div class="">
                <a href="" class="">Contract</a>
                <a href="" class="">Privacy Policy</a>
            </div>
        </div>
    </div>
