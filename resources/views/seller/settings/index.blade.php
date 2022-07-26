@extends('layouts.seller.app', ['pageTitle' => $pageTitle])
@section('content')
    <div class="container-fluid px-0 bg-light">
        <div class="container px-lg-0 px-xl-0 px-xxl-0 pt96 pb96 vendor-section">
            <div class="row justify-content-between mx-auto">
                @include('layouts.seller.side-menu')
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-12 vendor-content">
                    {{-- <button class="btn btn-light sideMenuButton d-lg-none d-xl-none d-xxl-none" onclick="sideBarToggle()"><i class="fas fa-arrow-right"></i></button> --}}
                    <h1 class="my-0 text-center border-bottom mb35-i">{{ $pageTitle }}</h1>
                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                    <form action="{{ route('seller.setting.update', Auth::guard('seller')->user()->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb20">
                                    <label for="account_number">
                                        <h3 class="my-0">Account Number</h3>
                                    </label>
                                    <div class="input-group">
                                        <input type="hidden" id="account_number_hidden" name="account_number" class="form-control rounded-0" placeholder="XXXX-XXXX-XXXXX" value="{{ old('account_number', Auth::guard('seller')->user()->account_number) }}" {{ Auth::guard('seller')->user()->account_number ? '' : 'disabled' }} />
                                        <input type="number" id="account_number" name="account_number" class="form-control rounded-0" placeholder="XXXX-XXXX-XXXXX" value="{{ old('account_number', Auth::guard('seller')->user()->account_number) }}" {{ Auth::guard('seller')->user()->account_number ? 'disabled' : '' }} />
                                        <button class="btn border-secondary btn-sm px-3" type="button" id="accountEditButton">Edit</button>
                                    </div>
                                    @error('account_number')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb30">
                                    <div class="input-group">
                                        <input type="password" id="current_password" name="current_password" class="form-control rounded-0" placeholder="Enter password to save changes" required />
                                        <button class="btn border-secondary btn-sm px-3" disabled id="accountEditButton"><i class="fas fa-pen"></i></button>
                                    </div>
                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <small>Note: If you don't want to change your password! Leave this fields blank.</small>
                            <div class="col-md-12">
                                <div class="mb30">
                                    <div class="input-group">
                                        <input type="password" id="new_password" name="new_password" class="form-control rounded-0" placeholder="New password" />
                                        <button class="btn border-secondary btn-sm px-3" disabled id="accountEditButton"><i class="fas fa-pen"></i></button>
                                    </div>
                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb30">
                                    <div class="input-group">
                                        <input type="password" id="confirm_password" name="confirm_password" class="form-control rounded-0" placeholder="Re type password" />
                                        <button class="btn border-secondary btn-sm px-3" disabled id="accountEditButton"><i class="fas fa-pen"></i></button>
                                    </div>
                                    @error('confirm_password')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn rounded-0 sign-in-button">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $("#accountEditButton").click(function() {
            swal('Notice!', 'Please be carefull with updating your account number!', 'info');
            (function($) {
                $.fn.toggleDisabled = function() {
                    return this.each(function() {
                        this.disabled = !this.disabled;
                    });
                };
            })(jQuery);
            $('#account_number').toggleDisabled();
            $('#account_number_hidden').toggleDisabled();
        });
    </script>
@endpush
