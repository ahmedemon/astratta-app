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
                            <h3 class="my-0">Products</h3>
                            <a href="{{ route('seller.product.create') }}" class="btn btn-sm rounded-0 pb-0 sign-in-button mx-0 h-50">Add New</a>
                        </div>
                    </div>
                    <table id="productTable" class="table table-borderless" style="width: 100%">
                        <thead class="mb30-i">
                            <tr>
                                <th class="align-middle active">Product</th>
                                <th class="align-middle active text-center">Date</th>
                                <th class="align-middle active text-center">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-middle">
                                    <div class="py15 d-flex align-items-center">
                                        <img src="{{ asset('vendor/images/footer1.png') }}" alt="" />
                                        <a href="javascript:void();" class="ml20">La Réunion Acryilic</a>
                                    </div>
                                </td>
                                <td class="align-middle text-center">3.6.2022</td>
                                <td class="align-middle text-center">$500</td>
                            </tr>
                            <tr>
                                <td class="align-middle">
                                    <div class="py15 d-flex align-items-center">
                                        <img src="{{ asset('vendor/images/footer1.png') }}" alt="" />
                                        <a href="javascript:void();" class="ml20">La Réunion Acryilic</a>
                                    </div>
                                </td>
                                <td class="align-middle text-center">3.6.2022</td>
                                <td class="align-middle text-center">$500</td>
                            </tr>
                            <tr>
                                <td class="align-middle">
                                    <div class="py15 d-flex align-items-center">
                                        <img src="{{ asset('vendor/images/footer1.png') }}" alt="" />
                                        <a href="javascript:void();" class="ml20">La Réunion Acryilic</a>
                                    </div>
                                </td>
                                <td class="align-middle text-center">3.6.2022</td>
                                <td class="align-middle text-center">$500</td>
                            </tr>
                            <tr>
                                <td class="align-middle">
                                    <div class="py15 d-flex align-items-center">
                                        <img src="{{ asset('vendor/images/footer1.png') }}" alt="" />
                                        <a href="javascript:void();" class="ml20">La Réunion Acryilic</a>
                                    </div>
                                </td>
                                <td class="align-middle text-center">3.6.2022</td>
                                <td class="align-middle text-center">$500</td>
                            </tr>
                            <tr>
                                <td class="align-middle">
                                    <div class="py15 d-flex align-items-center">
                                        <img src="{{ asset('vendor/images/footer1.png') }}" alt="" />
                                        <a href="javascript:void();" class="ml20">La Réunion Acryilic</a>
                                    </div>
                                </td>
                                <td class="align-middle text-center">3.6.2022</td>
                                <td class="align-middle text-center">$500</td>
                            </tr>
                            <tr>
                                <td class="align-middle">
                                    <div class="py15 d-flex align-items-center">
                                        <img src="{{ asset('vendor/images/footer1.png') }}" alt="" />
                                        <a href="javascript:void();" class="ml20">La Réunion Acryilic</a>
                                    </div>
                                </td>
                                <td class="align-middle text-center">3.6.2022</td>
                                <td class="align-middle text-center">$500</td>
                            </tr>
                            <tr>
                                <td class="align-middle">
                                    <div class="py15 d-flex align-items-center">
                                        <img src="{{ asset('vendor/images/footer1.png') }}" alt="" />
                                        <a href="javascript:void();" class="ml20">La Réunion Acryilic</a>
                                    </div>
                                </td>
                                <td class="align-middle text-center">3.6.2022</td>
                                <td class="align-middle text-center">$500</td>
                            </tr>
                            <tr>
                                <td class="align-middle">
                                    <div class="py15 d-flex align-items-center">
                                        <img src="{{ asset('vendor/images/footer1.png') }}" alt="" />
                                        <a href="javascript:void();" class="ml20">La Réunion Acryilic</a>
                                    </div>
                                </td>
                                <td class="align-middle text-center">3.6.2022</td>
                                <td class="align-middle text-center">$500</td>
                            </tr>
                            <tr>
                                <td class="align-middle">
                                    <div class="py15 d-flex align-items-center">
                                        <img src="{{ asset('vendor/images/footer1.png') }}" alt="" />
                                        <a href="javascript:void();" class="ml20">La Réunion Acryilic</a>
                                    </div>
                                </td>
                                <td class="align-middle text-center">3.6.2022</td>
                                <td class="align-middle text-center">$500</td>
                            </tr>
                            <tr>
                                <td class="align-middle">
                                    <div class="py15 d-flex align-items-center">
                                        <img src="{{ asset('vendor/images/footer1.png') }}" alt="" />
                                        <a href="javascript:void();" class="ml20">La Réunion Acryilic</a>
                                    </div>
                                </td>
                                <td class="align-middle text-center">3.6.2022</td>
                                <td class="align-middle text-center">$500</td>
                            </tr>
                            <tr>
                                <td class="align-middle">
                                    <div class="py15 d-flex align-items-center">
                                        <img src="{{ asset('vendor/images/footer1.png') }}" alt="" />
                                        <a href="javascript:void();" class="ml20">La Réunion Acryilic</a>
                                    </div>
                                </td>
                                <td class="align-middle text-center">3.6.2023</td>
                                <td class="align-middle text-center">$500</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $("#productTable").DataTable({
            dom: "Bfrtip",
            lengthMenu: [
                [4, 10, 50, -1]
            ],
        });
    </script>

    <script type="text/javascript">
        $(function() {
            var table = $(".yajra-datatable").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url()->current() }}",
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: "name",
                        name: "name",
                    },
                    {
                        data: "email",
                        name: "email",
                    },
                    {
                        data: "action",
                        name: "action",
                        orderable: true,
                        searchable: true,
                    },
                ],
            });
        });
    </script>
@endpush
