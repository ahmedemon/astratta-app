@extends('layouts.seller.app', ['pageTitle' => $pageTitle])
@section('content')
    <style>
        dl,
        ol,
        ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .imgPreview img {
            padding: 8px;
            max-width: 100px;
        }
    </style>
    <div class="container-fluid px-0 bg-light">
        <div class="container px-lg-0 px-xl-0 px-xxl-0 pt96 pb96 vendor-section">
            <div class="row justify-content-between mx-auto">
                @include('layouts.seller.side-menu')
                <div class="col-md-12 col-lg-8 col-xl-8 col-xxl-8 col-12 vendor-content">
                    <button class="btn btn-light sideMenuButton d-lg-none d-xl-none d-xxl-none" onclick="sideBarToggle()"><i class="fas fa-arrow-right"></i></button>
                    <h3 class="my-0 d-flex align-items-center justify-content-between mb35-i">
                        Add New Product <a href="{{ route('seller.product.index') }}" class="text-decoration-none text-dark"><i class="fas fa-times"></i></a>
                    </h3>
                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                    <form method="POST" action="{{ route('seller.product.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb35">
                            <div class="imgPreview"> </div>
                            <div class="custom-file">
                                <input type="file" name="images[]" class="custom-file-input" id="images" multiple="multiple">
                                <label class="custom-file-label" for="images">Choose image</label>
                            </div>
                        </div>

                        <div class="mb35">
                            <input type="text" name="product_name" value="{{ old('product_name') }}" placeholder="Product Name" class="form-control @error('product_name') in-valid @enderror" />
                            @error('product_name')
                                <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <div class="mb35">
                            <input type="number" name="product_price" value="{{ old('product_price') }}" placeholder="Price In Doller" class="form-control @error('product_price') in-valid @enderror" />
                            @error('product_price')
                                <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <div class="mb35">
                            <select name="category" value="{{ old('category') }}" id="" class="form-control">
                                <option selected>Select a category</option>
                                <option value="1">Abstract</option>
                                <option value="2">Vision</option>
                                <option value="3">Others</option>
                            </select>
                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <div class="mb35">
                            <select name="tags[]" value="{{ old('tags') }}" id="" class="form-control tags" aria-placeholder="tags">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            @error('tags')
                                <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <div class="mb35">
                            <textarea type="text" name="about_this_paint" placeholder="About this paint" class="form-control @error('about_this_paint') in-valid @enderror"></textarea>
                            @error('about_this_paint')
                                <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="mb35 col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-12">
                                <textarea type="text" name="details_1" placeholder="Details Column 1" class="form-control @error('details_1') in-valid @enderror"></textarea>
                                @error('details_1')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb35 col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-12">
                                <textarea type="text" name="details_2" placeholder="Details Column 2" class="form-control @error('details_2') in-valid @enderror"></textarea>
                                @error('details_2')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <button class="btn sign-up-button rounded">Create Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(function() {
            $(".tags").select2({
                tags: true,
                multiple: true,
            });
        });

        $(function() {
            // Multiple images preview with JavaScript
            var multiImgPreview = function(input, imgPreviewPlaceholder) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };
            $('#images').on('change', function() {
                multiImgPreview(this, 'div.imgPreview');
            });
        });
    </script>
@endpush
