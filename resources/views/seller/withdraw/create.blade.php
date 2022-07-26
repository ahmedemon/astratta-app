@extends('layouts.seller.app', ['pageTitle' => $pageTitle])
@section('content')
    <div class="container-fluid px-0 bg-light">
        <div class="container px-lg-0 px-xl-0 px-xxl-0 pt96 pb96 vendor-section">
            <div class="row justify-content-between mx-auto">
                @include('layouts.seller.side-menu')
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-12 vendor-content">
                    {{-- <button class="btn btn-light sideMenuButton d-lg-none d-xl-none d-xxl-none" onclick="sideBarToggle()"><i class="fas fa-arrow-right"></i></button> --}}
                    <div class="card-body d-flex align-items-center justify-content-between mb30 pb10 border-bottom">
                        <h3 class="my-0">{{ $pageTitle }}</h3>
                        <div class="">
                            <a href="{{ route('seller.withdraw.index') }}" class="btn btn-sm rounded-0 pb-0 sign-in-button mx-0 h-50">Go Back</a>
                            <a href="{{ route('seller.withdraw.set.method') }}" class="btn btn-sm rounded-0 pb-0 sign-in-button mx-0 h-50">Method</a>
                        </div>
                    </div>
                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                    <form action="{{ route('seller.withdraw.store') }}" method="POST">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <h3 class="my-0">{{ $wallet_name['current_balance'] }} - ${{ $wallets['current_balance'] }}</h3>
                                <br>
                                <div class="mb20">
                                    <label for="amount">Payment Method</label>
                                    <div class="input-group">
                                        <select name="method_id" class="form-control form-select" id="selector" onchange="yesnoCheck(this);">
                                            @if ($seller->stripe_id == !null && $seller->paypal_id == !null)
                                                @foreach ($methods as $method)
                                                    <option value="{{ $method->id }}">{{ $method->name }}</option>
                                                @endforeach
                                            @else
                                                @if ($seller->paypal_id == !null)
                                                    @foreach ($methods as $method)
                                                        @if ($method->id == 1)
                                                            <option value="{{ $method->id }}">{{ $method->name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                @if ($seller->stripe_id == !null)
                                                    @foreach ($methods as $method)
                                                        @if ($method->id == 2)
                                                            <option value="{{ $method->id }}">{{ $method->name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endif
                                        </select>
                                    </div>
                                    @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb20">
                                    <label for="amount"> Withdrawal Amount </label>
                                    <div class="input-group">
                                        <input type="number" min="0" id="amount" name="amount" class="form-control" placeholder="Amount" />
                                        <button class="btn btn-outline-secondary btn-sm px-3" type="submit">Submit</button>
                                    </div>
                                    @error('amount')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function yesnoCheck(that) {
            if (that.value == "1") {
                document.getElementById("1").className = "mb20 d-block";
            } else {
                document.getElementById("1").className = "mb20 d-none";
            }
            if (that.value == "2") {
                document.getElementById("2").className = "mb20 d-block";
            } else {
                document.getElementById("2").className = "mb20 d-none";
            }
        }
    </script>
@endpush
