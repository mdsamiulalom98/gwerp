@extends('backEnd.layouts.master')
@section('title', 'Leave Details')
@push('css')
@endpush
@section('content')
    <section class="wsit-container">
        <div class="wsit-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="page-header-title">
                                <h4 class="m-b-10">Leave Details</h4>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Leave Details
                                </li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <div class="quick_btn">
                                <a href="{{ route('leaves.index') }}"><i class="ti ti-settings-2"></i> Manage</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-content">
                <div class="row justify-content-center">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h6>Leave Details</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table modal-table">
                                        <tbody>
                                            <tr role="row">
                                                <th>Employee</th>
                                                <td>{{ $data->employee->name ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Leave Type </th>
                                                <td>{{ $data->leaveType->name ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Appplied On</th>
                                                <td>{{ $data->created_at->format('Y-m-d') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Start Date</th>
                                                <td>{{ $data->start_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>End Date</th>
                                                <td>{{ $data->end_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>Leave Reason</th>
                                                <td class="text-wrap text-break">{{ $data->reason }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td><div class="text-capitalize">{{ $data->status }}</div></td>
                                            </tr>
                                            <input type="hidden" value="6" name="leave_id">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
