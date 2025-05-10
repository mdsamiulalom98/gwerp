@extends('backEnd.layouts.master')
@section('title', 'Leave Manage')
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
                                <h4 class="m-b-10">Leave Manage</h4>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Leave Manage
                                </li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <div class="quick_btn">
                                <a href="{{ route('leaves.create') }}"><i class="ti ti-plus"></i> New</a>
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
                                <h6>Leave Manage</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="data-table" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Employee</th>
                                            <th>Leave Type</th>
                                            <th>Applied On</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Total Days</th>
                                            <th>Leave Reason</th>
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
                    ajax: "{{ route('leaves.index') }}",
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
                            data: 'employee',
                            name: 'employee'
                        },
                        {
                            data: 'leave_type',
                            name: 'leave_type'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'start_date',
                            name: 'start_date'
                        },
                        {
                            data: 'end_date',
                            name: 'end_date'
                        },
                        {
                            data: 'total_days',
                            name: 'total_days'
                        },
                        {
                            data: 'reason',
                            name: 'reason'
                        },
                        {
                            data: 'status',
                            name: 'status'
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
