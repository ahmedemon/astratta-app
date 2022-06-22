@extends('layouts.frontend.app', ['pageTitle' => $pageTitle])
@section('content')
    <div class="container-fluid px-0 bg-white product-view-page-container">
        <!-- artist details -->
        <div class="container view-artist">
            <div class="row justify-content-md-between justify-content-lg-between justify-content-xl-between justify-content-xxl-between justify-content-center">
                <div class="left-side col-md-5 px-lg-0">
                    <div class="card border-0 bg-transparent">
                        <img src="{{ asset('frontend/images/artist/artist.png') }}" alt="" />
                        <h3 class="my-0">ETEL FRESKO</h3>
                        <p class="my-0">Abstract Painter</p>
                        <hr class="my-0" />
                        <div class="artist-description">
                            <p class="my-0">
                                Italian painter, (Istanbul, 1958). <br /><br />
                                She moved with her family to Italy, Alessandria, in 1962, at the early age of four, here she studied until she reached artistic maturity, culminating her career at the Bramante artistic high school in Asti. <br /><br />
                                In 1973 she takes several summer courses in Paris and Lausanne. <br /><br />
                                She finished her studies and got her artistic diploma at the Albertina Academy in Turin. <br /><br />
                                In 1978, eager for new artistic knowledge, she moved to London where she worked in antiques and fashion in order to support herself, while continuing to expand her knowledge in the art world. <br /><br />
                                She will return to Italy, in 1983, in Celle Ligure, Liguria, just 30 km from Genoa, and, there, she will continue to feed her hunger for shapes, colors and landscapes. <br /><br />
                                In 1990 she moved to Madrid, Spain, with the ambition of getting to know Spanish art and paintings and its painters in depth. Here she also works on antiques to support herself, and, meanwhile, continues to study and expand her dreams about art. <br /><br />
                                From 2007 to 2010 she lives in Lanzarote, Canary Islands, where she realizes that this world remains very limited and that she cuts her inspiration in the abstract, which is what she now draws her attention with maximum interest. <br /><br />
                                In 2012 she moved to Israel, Tel Aviv, perhaps in search of the roots of every believer, she will be there for a year studying art and working in private galleries. <br /><br />
                                Finally, in 2013, she decides to return to Madrid and start her career in professional painting, devoting herself mostly to abstract art, making it her livelihood and spending almost all her time fostering her imagination, dreams and transferring them to canvas.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="right-side col-md-6 section2-container-2">
                    <div class="row justify-content-between">
                        <div class="col-6 px-lg-0 best-selling-container painting">
                            <a href="{{ route('painting.show', 1) }}">
                                <img class="p-3" src="{{ asset('frontend/images/best-selling/bs5.png') }}" alt="" />
                                <h3>Deserunt mollit anim id est laborum.</h3>
                                <p class="my-0">$5000</p>
                                <div class="d-flex align-items-center justify-content-lg-start justify-content-between buy-now">
                                    <small class="my-0">Buy Now</small>
                                    <div class="d-flex align-items-center">
                                        <svg width="33" height="8" viewBox="0 0 33 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M32.3536 4.35355C32.5488 4.15829 32.5488 3.84171 32.3536 3.64644L29.1716 0.464464C28.9763 0.269201 28.6597 0.269201 28.4645 0.464464C28.2692 0.659726 28.2692 0.976308 28.4645 1.17157L31.2929 4L28.4645 6.82842C28.2692 7.02369 28.2692 7.34027 28.4645 7.53553C28.6597 7.73079 28.9763 7.73079 29.1716 7.53553L32.3536 4.35355ZM4.37114e-08 4.5L32 4.5L32 3.5L-4.37114e-08 3.5L4.37114e-08 4.5Z" fill="black" />
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 px-lg-0 best-selling-container painting">
                            <a href="{{ route('painting.show', 1) }}">
                                <img class="p-3" src="{{ asset('frontend/images/best-selling/bs4.png') }}" alt="" />
                                <h3>Deserunt mollit anim id est laborum.</h3>
                                <p class="my-0">$5000</p>
                                <div class="d-flex align-items-center justify-content-lg-start justify-content-between buy-now">
                                    <small class="my-0">Buy Now</small>
                                    <div class="d-flex align-items-center">
                                        <svg width="33" height="8" viewBox="0 0 33 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M32.3536 4.35355C32.5488 4.15829 32.5488 3.84171 32.3536 3.64644L29.1716 0.464464C28.9763 0.269201 28.6597 0.269201 28.4645 0.464464C28.2692 0.659726 28.2692 0.976308 28.4645 1.17157L31.2929 4L28.4645 6.82842C28.2692 7.02369 28.2692 7.34027 28.4645 7.53553C28.6597 7.73079 28.9763 7.73079 29.1716 7.53553L32.3536 4.35355ZM4.37114e-08 4.5L32 4.5L32 3.5L-4.37114e-08 3.5L4.37114e-08 4.5Z" fill="black" />
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 px-lg-0 best-selling-container painting">
                            <a href="{{ route('painting.show', 1) }}">
                                <img class="p-3" src="{{ asset('frontend/images/best-selling/bs6.png') }}" alt="" />
                                <h3>Deserunt mollit anim id est laborum.</h3>
                                <p class="my-0">$5000</p>
                                <div class="d-flex align-items-center justify-content-lg-start justify-content-between buy-now">
                                    <small class="my-0">Buy Now</small>
                                    <div class="d-flex align-items-center">
                                        <svg width="33" height="8" viewBox="0 0 33 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M32.3536 4.35355C32.5488 4.15829 32.5488 3.84171 32.3536 3.64644L29.1716 0.464464C28.9763 0.269201 28.6597 0.269201 28.4645 0.464464C28.2692 0.659726 28.2692 0.976308 28.4645 1.17157L31.2929 4L28.4645 6.82842C28.2692 7.02369 28.2692 7.34027 28.4645 7.53553C28.6597 7.73079 28.9763 7.73079 29.1716 7.53553L32.3536 4.35355ZM4.37114e-08 4.5L32 4.5L32 3.5L-4.37114e-08 3.5L4.37114e-08 4.5Z" fill="black" />
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 px-lg-0 best-selling-container painting">
                            <a href="{{ route('painting.show', 1) }}">
                                <img class="p-3" src="{{ asset('frontend/images/best-selling/bs3.png') }}" alt="" />
                                <h3>Deserunt mollit anim id est laborum.</h3>
                                <p class="my-0">$5000</p>
                                <div class="d-flex align-items-center justify-content-lg-start justify-content-between buy-now">
                                    <small class="my-0">Buy Now</small>
                                    <div class="d-flex align-items-center">
                                        <svg width="33" height="8" viewBox="0 0 33 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M32.3536 4.35355C32.5488 4.15829 32.5488 3.84171 32.3536 3.64644L29.1716 0.464464C28.9763 0.269201 28.6597 0.269201 28.4645 0.464464C28.2692 0.659726 28.2692 0.976308 28.4645 1.17157L31.2929 4L28.4645 6.82842C28.2692 7.02369 28.2692 7.34027 28.4645 7.53553C28.6597 7.73079 28.9763 7.73079 29.1716 7.53553L32.3536 4.35355ZM4.37114e-08 4.5L32 4.5L32 3.5L-4.37114e-08 3.5L4.37114e-08 4.5Z" fill="black" />
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 px-lg-0 best-selling-container painting">
                            <a href="{{ route('painting.show', 1) }}">
                                <img class="p-3" src="{{ asset('frontend/images/best-selling/bs1.png') }}" alt="" />
                                <h3>Deserunt mollit anim id est laborum.</h3>
                                <p class="my-0">$5000</p>
                                <div class="d-flex align-items-center justify-content-lg-start justify-content-between buy-now">
                                    <small class="my-0">Buy Now</small>
                                    <div class="d-flex align-items-center">
                                        <svg width="33" height="8" viewBox="0 0 33 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M32.3536 4.35355C32.5488 4.15829 32.5488 3.84171 32.3536 3.64644L29.1716 0.464464C28.9763 0.269201 28.6597 0.269201 28.4645 0.464464C28.2692 0.659726 28.2692 0.976308 28.4645 1.17157L31.2929 4L28.4645 6.82842C28.2692 7.02369 28.2692 7.34027 28.4645 7.53553C28.6597 7.73079 28.9763 7.73079 29.1716 7.53553L32.3536 4.35355ZM4.37114e-08 4.5L32 4.5L32 3.5L-4.37114e-08 3.5L4.37114e-08 4.5Z" fill="black" />
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 px-lg-0 best-selling-container painting">
                            <a href="{{ route('painting.show', 1) }}">
                                <img class="p-3" src="{{ asset('frontend/images/best-selling/bs2.png') }}" alt="" />
                                <h3>Deserunt mollit anim id est laborum.</h3>
                                <p class="my-0">$5000</p>
                                <div class="d-flex align-items-center justify-content-lg-start justify-content-between buy-now">
                                    <small class="my-0">Buy Now</small>
                                    <div class="d-flex align-items-center">
                                        <svg width="33" height="8" viewBox="0 0 33 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M32.3536 4.35355C32.5488 4.15829 32.5488 3.84171 32.3536 3.64644L29.1716 0.464464C28.9763 0.269201 28.6597 0.269201 28.4645 0.464464C28.2692 0.659726 28.2692 0.976308 28.4645 1.17157L31.2929 4L28.4645 6.82842C28.2692 7.02369 28.2692 7.34027 28.4645 7.53553C28.6597 7.73079 28.9763 7.73079 29.1716 7.53553L32.3536 4.35355ZM4.37114e-08 4.5L32 4.5L32 3.5L-4.37114e-08 3.5L4.37114e-08 4.5Z" fill="black" />
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- artist details -->

        <!-- meet our top artist -->
        @include('frontend.top-artist')
        <!-- meet our top artist -->
    </div>
@endsection
