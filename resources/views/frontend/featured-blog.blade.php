<div class="container blog-site px-lg-0">
    <div class="d-flex justify-content-between align-items-center section-heading">
        <h1 class="">Featured Post</h1>
        <img class="h-100" src="{{ asset('frontend/images/line1.png') }}" alt="" />
    </div>
    @if ($featuredBlogs->count() == 0)
        <h4 class="text-center mt-5">No blog uploaded yet!!</h4>
    @else
        <div class="blog-loop owl-carousel owl-theme">
            @foreach ($featuredBlogs as $blog)
                <div class="item">
                    <a href="{{ route('blog', $blog->id) }}" class="text-decoration-none text-dark">
                        <div class="col-md-12">
                            <img class="w-100" src="{{ asset('storage/blogs/' . $blog->image) }}" alt="" height="296px" style="border-radius: 10px" />
                            <p class="author my-0">{{ $blog->topic }}</p>
                            <p class="title my-0">{{ $blog->title }}</p>
                            <p class="description my-0">{{ Str::limit($blog->description, 115) }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
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
