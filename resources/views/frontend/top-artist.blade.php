<div class="container section2-container-3 px-lg-0">
    <div class="d-flex justify-content-between align-items-center section-heading">
        <h2 class="my-0">Meet Our Top Artists</h2>
        <img class="h-100" src="{{ asset('frontend/images/line1.png') }}" alt="" />
    </div>
    <div class="artist-loop owl-carousel owl-theme">
        @foreach (config('top_artists') as $item)
            <div class="item">
                <div class="col-md-12 d-flex justify-content-center">
                    <a class="text-decoration-none" href="{{ route('artist.show', $item->id) }}">
                        <div>
                            <img height="247px" width="247px" src="{{ $item->image ? asset('storage/seller/' . $item->image) : asset('vendor/images/artist/avatar.svg') }}" alt="" />
                            <p class="my-0">{{ $item->name ?? $item->username }}</p>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach

    </div>
</div>

@push('js')
    <script>
        jQuery(document).ready(function($) {
            $(".artist-loop").owlCarousel({
                loop: true,
                margin: 50,
                responsive: {
                    300: {
                        items: 1,
                    },
                    500: {
                        items: 1,
                    },
                    800: {
                        items: 2,
                    },
                    1000: {
                        items: 3,
                    },
                    1200: {
                        items: 4,
                    },
                    1300: {
                        items: 4,
                    },
                    1400: {
                        items: 4,
                    },
                    1700: {
                        items: 4,
                    },
                    1800: {
                        items: 4,
                    },
                    1900: {
                        items: 4,
                    },
                    2000: {
                        items: 4,
                    },
                    2100: {
                        items: 4,
                    },
                    2200: {
                        items: 4,
                    },
                },
            });
        });
    </script>
@endpush
