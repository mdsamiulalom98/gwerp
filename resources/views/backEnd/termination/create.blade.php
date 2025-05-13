@extends('backEnd.layouts.master')
@section('title', 'Termination Create')
@push('css')
    <!-- DataTables JS -->
    <link href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css">
@endpush
@section('content')
    <section class="wsit-container">
        <div class="wsit-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="page-header-title">
                                <h4 class="m-b-10">Termination Manage</h4>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Termination Create
                                </li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <div class="quick_btn">
                                <a href="{{ route('terminations.index') }}"><i class="ti ti-device-desktop-check"></i> Manage</a>
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
                                <h6> Termination Create</h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('terminations.store') }}" method="POST" class="row"
                                    data-parsley-validate="" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="employee_id" class="form-label">Employee <span>*</span></label>
                                            <select class="form-control form-select" id="employee_id" name="employee_id"
                                                required>
                                                <option value="">Select..</option>
                                                @foreach ($employees as $key => $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}
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
                                    <!-- col end -->
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="termination_type" class="form-label">Termination Type <span>*</span></label>
                                            <select class="form-control form-select" id="termination_type" name="termination_type"
                                                required>
                                                <option value="">Select..</option>
                                                @foreach ($termination_types as $key => $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('termination_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col end -->

                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="notice_date" class="form-label">Notice Date
                                                <span>*</span></label>
                                            <input type="text"
                                                class="form-control @error('title') is-invalid @enderror flatpickr"
                                                name="notice_date" value="{{ old('notice_date') }}" id="notice_date" required>
                                            @error('notice_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="termination_date" class="form-label">Termination Date <span>*</span></label>
                                            <input type="text"
                                                class="form-control @error('title') is-invalid @enderror flatpickr"
                                                name="termination_date" value="{{ old('termination_date') }}" id="termination_date" required>
                                            @error('termination_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->

                                    <div class="col-sm-12">
                                        <div class="form-group mb-3">
                                            <label for="description" class="form-label">Description </label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"></textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                    <div>
                                        <input type="submit" class="btn btn-submit" value="Submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
