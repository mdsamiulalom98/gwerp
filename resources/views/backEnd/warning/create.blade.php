@extends('backEnd.layouts.master')
@section('title', 'Warning Create')
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
                                <h4 class="m-b-10">Warning Manage</h4>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Warning Create
                                </li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <div class="quick_btn">
                                <a href="{{ route('warnings.index') }}"><i class="ti ti-device-desktop-check"></i> Manage</a>
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
                                <h6> Warning Create</h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('warnings.store') }}" method="POST" class="row"
                                    data-parsley-validate="" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="warning_by" class="form-label">Warning By <span>*</span></label>
                                            <select class="form-control form-select" id="warning_by" name="warning_by"
                                                required>
                                                <option value="">Select..</option>
                                                @foreach ($employees as $key => $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('warning_by')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col end -->
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="warning_to" class="form-label">Warning To <span>*</span></label>
                                            <select class="form-control form-select" id="warning_to" name="warning_to"
                                                required>
                                                <option value="">Select..</option>
                                                @foreach ($employees as $key => $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('warning_to')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col end -->

                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="subject" class="form-label">Subject
                                                <span>*</span></label>
                                            <input type="text"
                                                class="form-control @error('title') is-invalid @enderror "
                                                name="subject" value="{{ old('subject') }}" id="subject" required>
                                            @error('subject')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="date" class="form-label">Warning Date <span>*</span></label>
                                            <input type="text"
                                                class="form-control @error('title') is-invalid @enderror flatpickr"
                                                name="date" value="{{ old('date') }}" id="date" required>
                                            @error('date')
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
