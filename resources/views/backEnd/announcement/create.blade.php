@extends('backEnd.layouts.master')
@section('title', 'Announcement Create')
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
                                <h4 class="m-b-10">Announcement Create</h4>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Announcement Create
                                </li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <div class="quick_btn">
                                <a href="{{ route('announcements.index') }}"><i class="ti ti-device-desktop-check"></i>
                                    Manage</a>
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
                                <h6> Announcement Create</h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('announcements.store') }}" method="POST" class="row"
                                    data-parsley-validate="" enctype="multipart/form-data">
                                    @csrf

                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text"
                                                class="form-control @error('title') is-invalid @enderror"
                                                name="title" id="title"
                                                placeholder="Title">
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="branch_id" class="form-label">Branch <span>*</span></label>
                                            <select class="form-control form-select" id="branch_id" name="branch_id"
                                                required>
                                                <option value="">Select..</option>
                                                @foreach ($branchs as $key => $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('branch_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col end -->
                                    <div class="col-sm-12">
                                        <div class="form-group mb-3">
                                            <label for="department_id" class="form-label">Department <span>*</span></label>
                                            <select class="form-control select2 form-select" multiple id="department_id" name="department_id[]" data-select="select2"
                                                required>
                                                <option value="">Select..</option>
                                                <option value="0">All</option>
                                                @foreach ($departments as $key => $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('department_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col end -->


                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="start_date" class="form-label">Announcement Start Date
                                                <span>*</span></label>
                                            <input type="text"
                                                class="form-control @error('title') is-invalid @enderror flatpickr"
                                                name="start_date" value="{{ old('start_date') }}" id="start_date" required>
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
                                            <label for="end_date" class="form-label">Announcement End Date
                                                <span>*</span></label>
                                            <input type="text"
                                                class="form-control @error('title') is-invalid @enderror flatpickr"
                                                name="end_date" value="{{ old('end_date') }}" id="end_date" required>
                                            @error('end_date')
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
