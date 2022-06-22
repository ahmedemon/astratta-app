<div class="container blog-site px-lg-0">
    <div class="d-flex justify-content-between align-items-center section-heading">
        <h1 class="">Related Post</h1>
        <img class="h-100" src="{{ asset('frontend/images/line1.png') }}" alt="" />
    </div>
    <div class="blog-loop owl-carousel owl-theme">
        <div class="item">
            <a href="{{ route('blog', 1) }}" class="text-decoration-none text-dark">
                <div class="col-md-12">
                    <img class="w-100" src="{{ asset('frontend/images/blog-demo.png') }}" alt="" />
                    <p class="author my-0">Designer</p>
                    <p class="title my-0">Sheri Briggs</p>
                    <p class="description my-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mi, enim, ut aliquam convallis in. Habitasse sollicitudin.</p>
                </div>
            </a>
        </div>
        <div class="item">
            <a href="{{ route('blog', 1) }}" class="text-decoration-none text-dark">
                <div class="col-md-12">
                    <img class="w-100" src="{{ asset('frontend/images/blog-demo.png') }}" alt="" />
                    <p class="author my-0">Developer</p>
                    <p class="title my-0">Sheri Briggs</p>
                    <p class="description my-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mi, enim, ut aliquam convallis in. Habitasse sollicitudin.</p>
                </div>
            </a>
        </div>
        <div class="item">
            <a href="{{ route('blog', 1) }}" class="text-decoration-none text-dark">
                <div class="col-md-12">
                    <img class="w-100" src="{{ asset('frontend/images/blog-demo.png') }}" alt="" />
                    <p class="author my-0">Graphic Designer</p>
                    <p class="title my-0">Sheri Briggs</p>
                    <p class="description my-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mi, enim, ut aliquam convallis in. Habitasse sollicitudin.</p>
                </div>
            </a>
        </div>
    </div>
</div>
@push('js')
    <script>
        jQuery(document).ready(function($) {
            $(".blog-loop").owlCarousel({
                loop: true,
                margin: 20,
                responsive: {
                    300: {
                        items: 2,
                    },
                    500: {
                        items: 2,
                    },
                    800: {
                        items: 2,
                    },
                    1000: {
                        items: 3,
                    },
                    1200: {
                        items: 3,
                    },
                    1300: {
                        items: 3,
                    },
                    1400: {
                        items: 3,
                    },
                    1700: {
                        items: 3,
                    },
                },
            });
        });
    </script>
@endpush
