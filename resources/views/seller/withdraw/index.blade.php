@extends('layouts.seller.app', ['pageTitle' => $pageTitle])
@section('content')
    <div class="container-fluid px-0 bg-light">
        <div class="container px-lg-0 px-xl-0 px-xxl-0 pt96 pb96 vendor-section">
            <div class="row justify-content-between mx-auto">
                @include('layouts.seller.side-menu')
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-12 vendor-content">
                    <button class="btn btn-light sideMenuButton d-lg-none d-xl-none d-xxl-none" onclick="sideBarToggle()"><i class="fas fa-arrow-right"></i></button>
                    <div class="card mb30 border-0">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <h3 class="my-0">{{ $pageTitle }}</h3>
                            <a href="{{ route('seller.withdraw.create') }}" class="btn btn-sm rounded-0 pb-0 sign-in-button mx-0 h-50">Add New</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-borderless" style="width: 100%">
                                <thead class="mb30-i">
                                    <tr>
                                        <th class="align-middle active">Amount</th>
                                        <th class="align-middle active text-center">Method</th>
                                        <th class="align-middle active text-center">Status</th>
                                        <th class="align-middle active text-center">Date</th>
                                        <th class="align-middle active text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($withdraws as $withdraw)
                                        <tr class="data-row">
                                            <td class="align-middle">{{ '$' . str_replace('.00', '', $withdraw->amount) }}</td>
                                            <td class="align-middle text-center">{{ $withdraw->withdrawMethod->name ?? '--' }}</td>
                                            <td class="align-middle text-center">
                                                {{ ($withdraw->status == 0 ? 'Processing' : '') . ($withdraw->status == 1 ? 'Processing' : '') . ($withdraw->status == 2 ? 'Complete' : '') . ($withdraw->status == 3 ? 'Rejected' : '') }}
                                            </td>
                                            <td class="align-middle text-center">{{ $withdraw->created_at->format('M:d:Y') }}</td>
                                            <td class="align-middle text-center">
                                                <a href="javascript:void();" class="text-success"><i class="fas fa-check"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $withdraws->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
