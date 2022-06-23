@extends('layouts.seller.app', ['pageTitle' => $pageTitle])
@section('content')
    <div class="container-fluid px-0 bg-light">
        <div class="container px-lg-0 px-xl-0 px-xxl-0 pt96 pb96 vendor-section">
            <div class="row justify-content-between mx-auto">
                @include('layouts.seller.side-menu')
                <div class="col-md-12 col-lg-8 col-xl-8 col-xxl-8 col-12 vendor-content">
                    <button class="btn btn-light sideMenuButton d-lg-none d-xl-none d-xxl-none" onclick="sideBarToggle()"><i class="fas fa-arrow-right"></i></button>
                    <h3 class="my-0 d-flex align-items-center justify-content-between mb35-i">
                        Add New Product <a href="{{ route('seller.product.index') }}" class="text-decoration-none text-dark"><i class="fas fa-times"></i></a>
                    </h3>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="row mb35" data-type="imagesloader" data-errorformat="Accepted file formats" data-errorsize="Maximum size accepted" data-errorduplicate="File already loaded" data-errormaxfiles="Maximum number of images you can upload" data-errorminfiles="Minimum number of images to upload" data-modifyimagetext="Modify Image">
                            <!-- Progress bar -->
                            <div class="col-12 order-1 mt-2">
                                <div data-type="progress" class="progress" style="height: 25px; display: none">
                                    <div data-type="progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 100%">Load in progress...</div>
                                </div>
                            </div>

                            <!-- Model -->
                            <div data-type="image-model" class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-6" style="display: none">
                                <div class="ratio-box text-center" data-type="image-ratio-box">
                                    <img data-type="noimage" class="btn btn-light ratio-img img-fluid p-5 image border solid rounded" src="{{ asset('vendor/svg/plus.svg') }}" style="cursor: pointer" />
                                    <div data-type="loading" class="img-loading" style="color: #218838; display: none">
                                        <span class="fa fa-2x fa-spin fa-spinner"></span>
                                    </div>
                                    <img data-type="preview" name="image[]" class="btn btn-light ratio-img img-fluid p-0 image border solid rounded" src="" style="display: none; cursor: default" />
                                    <span class="badge badge-pill badge-success p-2 w-50 main-tag" style="display: none">Main</span>
                                </div>

                                <!-- Buttons -->
                                <div data-type="image-buttons" class="row d-grid justify-content-center mt-2">
                                    <button data-type="add" class="btn btn-sm btn-outline-danger" type="button"><span class="fa fa-camera mr-2"></span>Add</button>
                                    <button data-type="btn-modify" type="button" class="btn btn-sm btn-outline-success m-0" data-toggle="popover" data-placement="right" style="display: none"><span class="fa fa-pencil-alt mr-2"></span>Modify</button>
                                </div>
                            </div>

                            <!-- Popover operations -->
                            <div data-type="popover-model" style="display: none">
                                <div data-type="popover" class="ml-3 mr-3" style="min-width: 150px">
                                    <div class="row d-grid justify-content-center">
                                        <div class="col p-0">
                                            <button data-operation="main" class="btn btn-block btn-success btn-sm rounded-pill" type="button"><span class="fa fa-angle-double-up mr-2"></span>Main</button>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6 p-0 pr-1">
                                            <button data-operation="left" class="btn btn-block btn-outline-success btn-sm rounded-pill" type="button"><span class="fa fa-angle-left mr-2"></span>Left</button>
                                        </div>
                                        <div class="col-6 p-0 pl-1">
                                            <button data-operation="right" class="btn btn-block btn-outline-success btn-sm rounded-pill" type="button">Right<span class="fa fa-angle-right ml-2"></span></button>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <button data-operation="remove" class="btn btn-outline-danger btn-sm btn-block" type="button"><span class="fa fa-times mr-2"></span>Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="input-group">
                                <!--Hidden file input for images-->
                                <input id="files" type="file" name="files[]" data-button="" multiple="" accept="image/jpeg, image/png, image/gif," style="display: none" />
                            </div>
                        </div>

                        <div class="mb35">
                            <input type="text" name="product_name" placeholder="Product Name" class="form-control" />
                        </div>

                        <div class="mb35">
                            <input type="number" name="product_price" placeholder="Price In Doller" class="form-control" />
                        </div>

                        <div class="mb35">
                            <select name="category_id" id="" class="form-control">
                                <option selected>Select a category</option>
                                <option value="">Abstract</option>
                                <option value="">Vision</option>
                                <option value="">Others</option>
                            </select>
                        </div>

                        <div class="mb35">
                            <select name="tags[]" id="" class="form-control tags" aria-placeholder="tags">
                                <option value="">Abstract</option>
                                <option value="">Vision</option>
                                <option value="">Others</option>
                            </select>
                        </div>

                        <div class="mb35">
                            <textarea type="text" name="about_this_paint" placeholder="About this paint" class="form-control"></textarea>
                        </div>

                        <div class="row">
                            <div class="mb35 col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-12">
                                <textarea type="text" name="details_1" placeholder="Details Column 1" class="form-control"></textarea>
                            </div>
                            <div class="mb35 col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-12">
                                <textarea type="text" name="details_2" placeholder="Details Column 2" class="form-control"></textarea>
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

        // Ready
        $(document).ready(function() {
            //Image loader var to use when you need a function from object
            var auctionImages = null;

            // Create image loader plugin
            var imagesloader = $("[data-type=imagesloader]").imagesloader({
                maxFiles: 4,
                minSelect: 1,
                imagesToLoad: auctionImages,
            });

            //Form
            $frm = $("#frm");

            // Form submit
            $frm.submit(function(e) {
                var $form = $(this);

                var files = imagesloader.data("format.imagesloader").AttachmentArray;

                var il = imagesloader.data("format.imagesloader");

                if (il.CheckValidity()) alert("Upload " + files.length + " files");

                e.preventDefault();
                e.stopPropagation();
            });
        });
    </script>
@endpush
