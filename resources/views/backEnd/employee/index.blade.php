@extends('backEnd.layouts.master')
@section('title', 'Employee Manage')
@push('css')
    <!-- DataTables JS -->
    <link href="{{ asset('public/backEnd/assets/') }}/css/dataTables.dataTables.css">
    <style>
        span.dt-column-title {
            text-transform: uppercase;
            white-space: nowrap;
            font-size: 13px;
        }
        .action-buttons {
            display: flex;
            align-items: center;
            gap: 5px;
        }
    </style>
@endpush
@section('content')
    <section class="wsit-container">
        <div class="wsit-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="page-header-title">
                                <h4 class="m-b-10">Employee Manage</h4>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Employee Manage
                                </li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <div class="quick_btn">
                                <a href="{{ route('employees.create') }}"><i class="ti ti-plus"></i> New</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h6>Employee Manage</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="data-table" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Branch</th>
                                            <th>Department</th>
                                            <th>Designation</th>
                                            <th>Joining Date</th>
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
            </div>
        </div>
    </section>
    @push('script')
        <!-- DataTables JS -->
        <script src="{{ asset('public/backEnd/assets/') }}/js/dataTables.js"></script>
        <script src="{{ asset('public/backEnd/assets/') }}/js/dataTables.bootstrap5.js"></script>
        <script>
            $(function() {
                var table = $('#data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('employees.index') }}",
                    pageLength: 50,
                    lengthMenu: [50, 100, 200, 500],
                    columns: [{
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            },
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'employee_id',
                            name: 'employee_id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'branch',
                            name: 'branch'
                        },
                        {
                            data: 'department',
                            name: 'department   '
                        },
                        {
                            data: 'designation',
                            name: 'designation'
                        },
                        {
                            data: 'joining_date',
                            name: 'joining_date'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ]
                });
            })
        </script>
    @endpush
@endsection
