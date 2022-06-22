@extends('layouts.frontend.app', ['pageTitle' => $pageTitle])
@section('content')
    <div class="container-fluid px-0 bg-white product-view-page-container">
        <!-- product grettings -->
        <div class="container product-section1">
            <div class="content px-2 px-lg-0 px-xl-0 px-xxl-0">
                <div class="row align-items-center justify-content-lg-between justify-content-center hero-section">
                    <div class="product-details px-0 mb-3 mb-lg-0 col-md-12 col-lg-6 col-xl-6 col-xxl-6 col-12">
                        <div class="d-flex align-items-center title">
                            <p class="my-0">Abstract</p>
                            <img class="h-100" src="{{ asset('frontend/images/line1.png') }}" alt="" />
                        </div>
                        <h1>La Réunion Acryilic</h1>
                        <h2>$500</h2>
                        <div class="d-flex justify-content-lg-start justify-content-xl-start justify-content-xxl-start justify-content-between">
                            <a href="javascript:void();" class="btn rounded-0 border-0 buy-now-button">Buy Now</a>
                            <a href="javascript:void();" class="btn rounded-0 border-0 add-to-cart-button">Add to Cart</a>
                        </div>
                    </div>
                    <div class="px-0 art col-md-12 col-lg-6 col-xl-6 col-xxl-6 col-12">
                        <div class="d-flex justify-content-lg-end justify-content-xl-end justify-content-xxl-end justify-content-center">
                            <img id="main-image" class="" src="{{ asset('frontend/images/art/art2.png') }}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid product-section2 bg-light px-0">
            <div class="container photos-section">
                <div class="row">
                    <div class="col-md-4 px-lg-0 px-xl-0 px-xxl-0">
                        <h1 class="my-0">Photos</h1>
                    </div>
                    <div class="col-md-8 px-lg-0 px-xl-0 px-xxl-0 d-flex justify-content-lg-end justify-content-xl-end justify-content-xxl-end justify-content-between">
                        <a class="thumbnails text-left" href="javascript:void();">
                            <img onclick="change_image(this)" src="{{ asset('frontend/images/art/art2.png') }}" alt="" />
                        </a>
                        <a class="thumbnails text-center" href="javascript:void();">
                            <img onclick="change_image(this)" src="{{ asset('frontend/images/art/art1.png') }}" alt="" />
                        </a>
                        <a class="thumbnails text-end" href="javascript:void();">
                            <img onclick="change_image(this)" src="{{ asset('frontend/images/art/art3.png') }}" alt="" />
                        </a>
                    </div>
                </div>
            </div>
            <div class="container details-section">
                <div class="row">
                    <div class="col-md-4 px-lg-0 px-xl-0 px-xxl-0">
                        <h1 class="my-0">Details</h1>
                    </div>
                    <div class="col-md-8 px-lg-0 px-xl-0 px-xxl-0">
                        <div class="row">
                            <div class="col-md-6">
                                <ol>
                                    <li>Painting, Oil on Wood</li>
                                    <li>Size: 40.6 W x 40.6 H x 3.8 D cm</li>
                                    <li>Original Created:2011</li>
                                    <li>Ships in a Box</li>
                                    <li class="fw-bold">Shipping included</li>
                                    <li class="fw-bold">7 day money-back guarantee</li>
                                </ol>
                            </div>
                            <div class="col-md-6">
                                <ol>
                                    <li>Painting, Oil on Wood</li>
                                    <li>Size: 40.6 W x 40.6 H x 3.8 D cm</li>
                                    <li>Original Created:2011</li>
                                    <li>Ships in a Box</li>
                                    <li>Shipping included</li>
                                    <li>7 day money-back guarantee</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container about-paint-section">
                <div class="row">
                    <div class="col-md-4 px-lg-0 px-xl-0 px-xxl-0">
                        <h1 class="my-0">About this Paint</h1>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12 px-lg-2 px-xl-2 px-xxl-2">
                                <p class="my-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Netus malesuada fermentum, pellentesque ullamcorper porta. Proin tellus lacus, massa scelerisque erat sed pulvinar. Scelerisque ipsum id amet turpis morbi sed. Velit tristique ultricies urna, in tempor praesent viverra sodales. Montes, risus netus justo mi duis magnis aliquam ut. Commodo malesuada turpis ut cum nulla egestas in arcu ultrices. Consequat porta penatibus pulvinar non faucibus gravida interdum morbi nisl. Arcu egestas magna viverra maecenas. Et diam congue quam at. Sit nunc in feugiat eu gravida nunc cursus. Risus mauris sagittis lorem semper. Nulla lobortis imperdiet ornare arcu nulla ornare porta in. Egestas tristique ultrices dolor mattis quam id est. Mauris euismod arcu malesuada laoreet.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container about-section">
                <div class="row">
                    <div class="col-md-12 bg-white">
                        <div class="row">
                            <div class="col-md-12 headings d-flex justify-content-lg-start align-items-lg-center">
                                <img src="{{ asset('frontend/images/artist/artist.png') }}" alt="" />
                                <div class="info">
                                    <h1 class="my-0">ETEL FRESKO</h1>
                                    <p class="my-0">Abstract Painter</p>
                                </div>
                            </div>
                            <div class="col-md-12 description">
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
                                <a href="" class="">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid product-section3 bg-white px-0">
            <div class="container section2-container-2 px-lg-0">
                <div class="d-flex justify-content-between align-items-center section-heading">
                    <h1 class="my-0">Related Painting</h1>
                    <img class="h-100" src="{{ asset('frontend/images/line1.png') }}" alt="" />
                </div>
                <div class="row best-selling-container justify-content-lg-between justify-content-md-between justify-content-center w-100">
                    <div class="col-lg-6 col-xl-4 col-md-6 col-6 painting">
                        <a href="{{ route('painting.show', 1) }}">
                            <img class="p-3" src="{{ asset('frontend/images/best-selling/bs1.png') }}" alt="" />
                            <h3>Lorem Ipsum is simply dummy text of the printing and</h3>
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
                    <div class="col-lg-6 col-xl-4 col-md-6 col-6 painting">
                        <a href="{{ route('painting.show', 1) }}">
                            <img class="p-3" src="{{ asset('frontend/images/best-selling/bs2.png') }}" alt="" />
                            <h3>Why do we use it</h3>
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
                    <div class="col-lg-6 col-xl-4 col-md-6 col-6 painting">
                        <a href="{{ route('painting.show', 1) }}">
                            <img class="p-3" src="{{ asset('frontend/images/best-selling/bs3.png') }}" alt="" />
                            <h3>Lorem Ipsum is simply dummy text of the printing and</h3>
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
        <!-- product grettings -->
    </div>
@endsection


@push('js')
    <script>
        function change_image(image) {
            var container = document.getElementById("main-image");

            container.src = image.src;
        }
        document.addEventListener("DOMContentLoaded", function(event) {});
    </script>
@endpush
