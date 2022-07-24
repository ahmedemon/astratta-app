@extends('layouts.backend.app', ['pageTitle' => $pageTitle])
@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.2.0/ekko-lightbox.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
                        <a href="" onclick="javascript:window.close()" class="btn btn-sm btn-primary">Go Back</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($paintings as $painting)
                                <a class="col-md-2" href="{{ asset('storage/seller/' . $painting->image) }}" data-toggle="lightbox" data-gallery="gallery">
                                    <img src="{{ asset('storage/seller/' . $painting->image) }}" alt="{{ $painting->id }}" class="img-fluid w-100" />
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.2.0/ekko-lightbox.min.js"></script>
    <script>
        $(document).on("click", '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    </script>
@endpush
