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
                                <th>Product</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Tags</th>
                                <th>About Paint</th>
                                <th>Details 1</th>
                                <th>Details 2</th>
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
                        data: 'product_main_image',
                        name: 'product_main_image'
                    },
                    {
                        data: 'product_name',
                        name: 'product_name'
                    },
                    {
                        data: 'product_price',
                        name: 'product_price'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'tags',
                        name: 'tags'
                    },
                    {
                        data: 'about_this_paint',
                        name: 'about_this_paint'
                    },
                    {
                        data: 'details_1',
                        name: 'details_1'
                    },
                    {
                        data: 'details_2',
                        name: 'details_2'
                    },
                    {
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
