@extends('backEnd.layouts.master')
@section('title', 'Leave Create')
@section('content')
    <section class="wsit-container">
        <div class="wsit-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="page-header-title">
                                <h4 class="m-b-10">Leave</h4>
                            </div>
                            <ul class="breadcrumb">

                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Leave Create
                                </li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <div class="quick_btn">
                                <a href="{{ route('leaves.index') }}"><i class="ti ti-plus"></i> Manage</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content">
                <form action="{{ route('leaves.store') }}" method="POST" class="row" data-parsley-validate=""
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card">

                        <div class="card-body">
                            <div class="row justify-content-center">

                                <div class="col-sm-8">
                                    <h5 class="title-2">Leave Details</h5>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="employee_id" class="form-label">Employee <span>*</span></label>

                                                <select class="form-control form-select" id="employee_id"
                                                    name="employee_id">
                                                    <option value="">Select Employee</option>
                                                    @foreach ($employees as $employee)
                                                        <option value="{{ $employee->id }}"
                                                            {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                                            {{ $employee->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('employee_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="leave_type" class="form-label">Leave Type <span>*</span></label>

                                                <select class="form-control form-select" id="leave_type" name="leave_type">
                                                    <option value="">Select Leave Type</option>
                                                    @foreach ($leave_types as $type)
                                                        <option value="{{ $type->id }}"
                                                            {{ old('leave_type') == $type->id ? 'selected' : '' }}>
                                                            {{ $type->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('leave_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col end -->

                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="start_date" class="form-label">Start Date
                                                    <span>*</span></label>
                                                <input type="date"
                                                    class="form-control @error('start_date') is-invalid @enderror" name="start_date"
                                                    value="{{ old('start_date') }}" id="start_date" required="">
                                                @error('start_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="end_date" class="form-label">End Date
                                                    <span>*</span></label>
                                                <input type="date"
                                                    class="form-control @error('end_date') is-invalid @enderror" name="end_date"
                                                    value="{{ old('end_date') }}" id="end_date" required="">
                                                @error('end_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->

                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="reason" class="form-label">Leave Reason <span>*</span></label>
                                                <textarea class="form-control @error('reason') is-invalid @enderror" name="reason" id="reason" required=""></textarea>
                                                @error('reason')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="remarks" class="form-label">Remark <span>*</span></label>
                                                <textarea class="form-control @error('remarks') is-invalid @enderror" name="remarks" id="remarks" required=""></textarea>
                                                @error('remarks')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->

                                    </div>

                                    <input type="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <!-- row end -->
                        </div>
                        <!-- card end -->

                    </div>
                    <!-- card end -->
                </form>
            </div>
    </section>
@endsection

