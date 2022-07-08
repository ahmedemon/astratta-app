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
                    <small>Note: If you want to change images then you should select all images again or else just leave as it is.</small>
                    <h3 class="my-0 d-flex align-items-center justify-content-between mb35-i">
                        Edit "{{ $product->product_name }}" <a href="{{ route('seller.product.index') }}" class="text-decoration-none text-dark"><i class="fas fa-times"></i></a>
                    </h3>
                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                    <form method="POST" action="{{ route('seller.product.update', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @php
                            $images = $product->productImages;
                        @endphp
                        <div class="row mb35">
                            <div class="avatar-upload text-center">
                                <div class="avatar-edit">
                                    <input type="file" id="imageUpload-0" name="main_image" accept=".png, .jpg, .jpeg" class="imageUpload-0" onclick="productImage0();" />
                                    <input type="hidden" id="base_image_data-0" name="base64image1" />
                                    <label for="imageUpload-0" class="d-flex justify-content-center align-items-center"><i class="lni lni-plus"></i></label>
                                </div>
                                <div class="avatar-preview">
                                    <div id="imagePreview-0" style="background-image: url('{{ asset('storage/products/' . $product->main_image) }}')"></div>
                                </div>
                                <label for="image" class="small">Main Image</label>
                            </div>
                        </div>
                        <div class="row mb35 justify-content-between">
                            @foreach ($images as $key => $image)
                                <div class="avatar-upload text-center">
                                    <div class="avatar-edit">
                                        <input type="file" id="imageUpload-{{ $key + 1 }}" name="image" accept=".png, .jpg, .jpeg" class="imageUpload-{{ $key + 1 }}" onclick="productImage{{ $key + 1 }}();" />
                                        <input type="hidden" id="base_image_data-{{ $key + 1 }}" name="base64image[]" />
                                        <label for="imageUpload-{{ $key + 1 }}" class="d-flex justify-content-center align-items-center"><i class="fas fa-pen"></i></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview-{{ $key + 1 }}" style="background-image: url('{{ asset('storage/products/' . $image->image) }}')"></div>
                                    </div>
                                    <label for="image" class="small">{{ ($loop->iteration == 1 ? 'Main Image' : '') . ($loop->iteration == 2 ? 'Second Image' : '') . ($loop->iteration == 3 ? 'Third Image' : '') }}</label>
                                </div>
                            @endforeach
                        </div>

                        <div class="mb35">
                            <input type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}" placeholder="Product Name" class="form-control @error('product_name') border-danger @enderror" />
                            @error('product_name')
                                <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <div class="mb35">
                            <input type="number" name="product_price" value="{{ old('product_price', intval($product->product_price)) }}" placeholder="Price In Doller" class="form-control @error('product_price') border-danger @enderror" />
                            @error('product_price')
                                <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <div class="mb35">
                            <select name="category_id" id="" class="form-control">
                                @foreach ($categories as $category)
                                    <option {{ $product->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <div class="mb35">
                            <select name="tags[]" id="" class="form-control tags" multiple aria-placeholder="tags">
                                @foreach ($tags as $tag)
                                    <option {{ $loop->first ? 'selected' : '' }} value="{{ $tag->name }}" @if ($product->tags()->pluck('name')->contains($tag->name)) selected @endif>{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            @error('tags')
                                <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <div class="mb35">
                            <textarea type="text" name="about_this_paint" placeholder="About this paint" class="form-control @error('about_this_paint') border-danger @enderror">{{ old('about_this_paint', $product->about_this_paint) }}</textarea>
                            @error('about_this_paint')
                                <span class="invalid-feedback" role="alert">
                                    <small>{{ $message }}</small>
                                </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="mb35 col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-12">
                                <textarea type="text" name="details_1" placeholder="Details Column 1" class="form-control @error('details_1') border-danger @enderror">{{ old('details_1', $product->details_1) }}</textarea>
                                @error('details_1')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb35 col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-12">
                                <textarea type="text" name="details_2" placeholder="Details Column 2" class="form-control @error('details_2') border-danger @enderror">{{ old('details_2', $product->details_2) }}</textarea>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(function() {
            $('.select2').select2()
            $(".tags").select2({
                tags: true,
                multiple: true,
            });
        });
        $(".sign-up-button").click(function() {
            if (!$("#imageUpload-1").val() || !$("#imageUpload-2").val() || !$("#imageUpload-3").val()) {
                return confirm('Update without new images?');
                if ($("#imageUpload-1").val() && !$("#imageUpload-2").val()) {
                    swal("Please select second image!", "", "warning");
                }
                if ($("#imageUpload-2").val() && !$("#imageUpload-3").val()) {
                    swal("Please select first image!", "", "warning");
                }
                if ($("#imageUpload-3").val() && !$("#imageUpload-2").val()) {
                    swal("Please select second image!", "", "warning");
                }
                if ($("#imageUpload-3").val() && $("#imageUpload-2").val() && !$("#imageUpload-1").val()) {
                    swal("Please select first image!", "", "warning");
                }
                if ($("#imageUpload-1").val() && $("#imageUpload-2").val() && !$("#imageUpload-3").val()) {
                    swal("Please select third image!", "", "warning");
                }
                if ($("#imageUpload-1").val() && $("#imageUpload-3").val() && !$("#imageUpload-2").val()) {
                    swal("Please select second image!", "", "warning");
                }
            }
        });

        function productImage0() {
            function readURL(input0) {
                if (input0.files && input0.files[0]) {
                    var reader0 = new FileReader();
                    reader0.onload = function(e) {
                        $('#imagePreview-0').css('background-image', 'url(' + e.target.result + ')');
                        $('#imagePreview-0').hide();
                        $('#imagePreview-0').fadeIn(650);

                        var base64data0 = reader0.result;
                        $('#base_image_data-0').val(base64data0);
                    }
                    reader0.readAsDataURL(input0.files[0]);
                }
            }
            $("#imageUpload-0").change(function() {
                readURL(this);
            });
        }

        function productImage1() {
            function readURL(input1) {
                if (input1.files && input1.files[0]) {
                    var reader1 = new FileReader();
                    reader1.onload = function(e) {
                        $('#imagePreview-1').css('background-image', 'url(' + e.target.result + ')');
                        $('#imagePreview-1').hide();
                        $('#imagePreview-1').fadeIn(650);

                        var base64data1 = reader1.result;
                        $('#base_image_data-1').val(base64data1);
                    }
                    reader1.readAsDataURL(input1.files[0]);
                }
            }
            $("#imageUpload-1").change(function() {
                readURL(this);
            });
        }

        function productImage2() {
            function readURL(input2) {
                if (input2.files && input2.files[0]) {
                    var reader2 = new FileReader();
                    reader2.onload = function(e) {
                        $('#imagePreview-2').css('background-image', 'url(' + e.target.result + ')');
                        $('#imagePreview-2').hide();
                        $('#imagePreview-2').fadeIn(650);

                        var base64data2 = reader2.result;
                        $('#base_image_data-2').val(base64data2);
                    }
                    reader2.readAsDataURL(input2.files[0]);
                }
            }
            $("#imageUpload-2").change(function() {
                readURL(this);
            });
        }

        function productImage3() {
            function readURL(input3) {
                if (input3.files && input3.files[0]) {
                    var reader3 = new FileReader();
                    reader3.onload = function(e) {
                        $('#imagePreview-3').css('background-image', 'url(' + e.target.result + ')');
                        $('#imagePreview-3').hide();
                        $('#imagePreview-3').fadeIn(650);

                        var base64data3 = reader3.result;
                        $('#base_image_data-3').val(base64data3);
                    }
                    reader3.readAsDataURL(input3.files[0]);
                }
            }
            $("#imageUpload-3").change(function() {
                readURL(this);
            });
        }
    </script>
    <script>
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>
@endpush
