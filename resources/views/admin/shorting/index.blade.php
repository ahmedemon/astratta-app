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
                <a href="#addNew" class="py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="addNew">
                    <h6 class="m-0 font-weight-bold text-primary">Add New</h6>
                </a>
            </div>
            <div class="card-body">
                <div class="collapse" id="addNew">
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <form action="{{ route('admin.short-range.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="title">Title</label>
                                    <input type="text" name="name" id="title" class="form-control" placeholder="Starting title">
                                </div>
                                <div class="mb-3">
                                    <label for="start">Starting Range</label>
                                    <input type="number" name="start" id="start" class="form-control" placeholder="Starting range">
                                </div>
                                <div class="mb-3">
                                    <label for="end">Ending Range</label>
                                    <input type="number" name="end" id="end" class="form-control" placeholder="Ending Range">
                                </div>
                                <button class="btn btn-success rounded-0 w-100">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Title</th>
                                <th>Start Range</th>
                                <th>Ending Range</th>
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
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'start',
                        name: 'start'
                    },
                    {
                        data: 'end',
                        name: 'end'
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
