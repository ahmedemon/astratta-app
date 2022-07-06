@extends('layouts.backend.app', ['pageTitle' => $pageTitle])
@push('css')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        td {
            vertical-align: middle !important;
            text-align: center;
        }
    </style>
@endpush
@section('content')
    <div class="container mt-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">{{ $pageTitle }}</h6>
            </div>
            <div class="card-body">
                <div class="collapse show" id="addNew">
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <form action="{{ route('admin.coupon.update', $coupon->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="code">Coupon Code</label>
                                    <input type="text" id="code" name="code" class="form-control" placeholder="Type Coupon Code Here!" value="{{ old('code', $coupon->code) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="percentage">Percentage / %</label>
                                    <input type="number" id="percentage" name="percentage" class="form-control" placeholder="20" value="{{ old('percentage', $coupon->percentage) }}">
                                </div>
                                <button class="btn btn-success rounded-0 w-100">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Code</th>
                                <th>Discount</th>
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
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'percentage',
                        name: 'percentage'
                    },
                    {
                        data: 'is_active',
                        name: 'is_active'
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
