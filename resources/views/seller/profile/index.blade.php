@extends('layouts.seller.app', ['pageTitle' => $pageTitle])
@section('content')
    <div class="container-fluid px-0 bg-light">
        <div class="container px-lg-0 px-xl-0 px-xxl-0 pt96 pb96 vendor-section">
            <div class="row justify-content-between mx-auto">
                @include('layouts.seller.side-menu')
                <div class="col-md-12 col-lg-8 col-xl-8 col-xxl-8 col-12 vendor-content">
                    <button class="btn btn-light sideMenuButton d-lg-none d-xl-none d-xxl-none" onclick="sideBarToggle()"><i class="fas fa-arrow-right"></i></button>
                    <h3 class="my-0 mb20-i">Change Profile Picture</h3>
                    <form action="{{ route('seller.profile.update', Auth::guard('seller')->user()->id) }}}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="d-grid mb30 d-grid justify-content-center">
                            <div class="avatar-upload text-center">
                                <div class="avatar-edit">
                                    <input type="file" id="imageUpload" name="image" accept=".png, .jpg, .jpeg" class="imageUpload" />
                                    <input type="hidden" name="base64image" id="base64image" />
                                    <label for="imageUpload" class="d-flex justify-content-center align-items-center"><i class="fas fa-pen"></i></label>
                                </div>
                                <div class="avatar-preview">
                                    <div id="imagePreview" style="background-image: url('{{ Auth::guard('seller')->user()->image ? asset('storage/seller/' . Auth::guard('seller')->user()->image) : asset('vendor/images/artist/avatar.svg') }}')"></div>
                                </div>
                                <label for="image" class="small">Maximum file size 128 MB</label>
                            </div>
                        </div>
                        <div class="mb30">
                            <label for="name">
                                <h3 class="my-0 mb15-i">Name</h3>
                            </label>
                            <input type="text" name="name" class="form-control rounded-0" placeholder="Etel Fresko" value="{{ old('name', Auth::guard('seller')->user()->name) }}" />
                        </div>
                        <div class="mb30">
                            <label for="name">
                                <h3 class="my-0 mb15-i">Designation</h3>
                            </label>
                            <input type="text" name="designation" class="form-control rounded-0" placeholder="Abstract Painter" value="{{ old('designation', Auth::guard('seller')->user()->designation) }}" />
                        </div>
                        <div class="mb30">
                            <label for="description">
                                <h3 class="my-0 mb15-i">Description</h3>
                            </label>
                            <textarea type="text" name="description" class="form-control rounded-0" placeholder="Etel Fresko">{{ old('description', Auth::guard('seller')->user()->description) }}</textarea>
                        </div>
                        <button type="submit" class="btn rounded-0 sign-in-button">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg imagecrop" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-11">
                                <img id="image" src="" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary crop" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        var $modal = $(".imagecrop");
        var image = document.getElementById("image");
        var cropper;
        $("body").on("change", ".imageUpload", function(e) {
            var files = e.target.files;
            var done = function(url) {
                image.src = url;
                $modal.modal("show");
            };
            var reader;
            var file;
            var url;
            if (files && files.length > 0) {
                file = files[0];
                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
        $modal
            .on("shown.bs.modal", function() {
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 1,
                });
            })
            .on("hidden.bs.modal", function() {
                cropper.destroy();
                cropper = null;
            });
        $("body").on("click", "#crop", function() {
            canvas = cropper.getCroppedCanvas({
                width: 160,
                height: 160,
            });
            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $("#base64image").val(base64data);
                    document.getElementById("imagePreview").style.backgroundImage = "url(" + base64data + ")";
                    $modal.modal("hide");
                };
            });
        });
    </script>
@endpush
