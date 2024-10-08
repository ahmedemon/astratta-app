@extends('layouts.frontend.app', ['pageTitle' => $pageTitle])
@section('content')
    <div class="container-fluid px-0 bg-white artist-view-page-container">
        <!-- become artist section -->
        <div class="container bg-white px-lg-0">
            <div class="row mx-auto become-an-artist">
                <div class="d-lg-flex justify-content-between align-items-center">
                    <div class="col-md-12 col-lg-6 col-xl-6 col-xxl-6 d-flex justify-content-lg-start px-lg-0 justify-content-center col-12">
                        <h1 class="my-lg-0 my-3">Interested in abstract painting?</h1>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-6 col-xxl-6 d-flex justify-content-lg-end justify-content-center col-12">
                        <a href="{{ Auth::guard('seller')->check() ? route('seller.dashboard.index') : route('seller.join-us') }}" class="become-an-artist-link">{{ Auth::guard('seller')->check() ? 'Go To Dashboard' : 'Become An Artist' }}</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- become artist section -->

        <!-- artists -->
        <div class="artist-section">
            <div class="container artist-section-container section2-container-3 px-lg-0">
                <div class="artist-loop row justify-content-between mx-auto">
                    @foreach ($artists as $artist)
                        <div class="col-md-6 col-6 col-lg-3 col-xl-3 col-xxl-3 d-flex justify-content-center px-lg-0">
                            <div class="item">
                                <div>
                                    <img src="{{ $artist->image ? asset('storage/seller/' . $artist->image) : asset('vendor/images/artist/avatar.svg') }}" alt="" />
                                    <p class="my-0"><a href="{{ route('artist.show', $artist->id) }}" class="text-dark text-decoration-none">{{ $artist->name ?? $artist->username }}</a></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- artists -->
    </div>
@endsection
