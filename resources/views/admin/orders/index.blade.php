@extends('layouts.backend.app', ['pageTitle' => $pageTitle])
@push('css')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        td {
            vertical-align: middle !important;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid mt-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Seller</th>
                                <th>Buyer</th>
                                <th>Product</th>
                                <th>Track ID</th>
                                <th>Total Cost</th>
                                <th>Method</th>
                                <th>Coupon</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('dtjs')
    <script>
        $(function() {
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url()->current() }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'seller',
                        name: 'seller'
                    },
                    {
                        data: 'buyer',
                        name: 'buyer'
                    },
                    {
                        data: 'product_main_image',
                        name: 'product_main_image'
                    },
                    {
                        data: 'order_track_id',
                        name: 'order_track_id'
                    },
                    {
                        data: 'total_cost',
                        name: 'total_cost'
                    },
                    {
                        data: 'method_id',
                        name: 'method_id'
                    },
                    {
                        data: 'coupon_code',
                        name: 'coupon_code'
                    },
                    {
                        data: 'order_date',
                        name: 'order_date'
                    },
                    d {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endpush
