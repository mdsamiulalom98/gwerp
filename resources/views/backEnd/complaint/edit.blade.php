@extends('backEnd.layouts.master')
@section('title', 'Complaint Edit')
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
                                <h4 class="m-b-10">Complaint Manage</h4>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Complaint Edit
                                </li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <div class="quick_btn">
                                <a href="{{ route('complaints.index') }}"><i class="ti ti-device-desktop-check"></i> Manage</a>
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
                                <h6>Complaint Edit</h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('complaints.update') }}" method="POST" class="row"
                                    data-parsley-validate="" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $edit_data->id }}" name="id">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="complaint_from" class="form-label">Complaint From <span>*</span></label>
                                            <select class="form-control form-select" id="complaint_from" name="complaint_from"
                                                required>
                                                <option value="">Select..</option>
                                                @foreach ($employees as $key => $value)
                                                    <option value="{{ $value->id }}" {{ $value->id == $edit_data->complaint_from ? 'selected' : '' }}>{{ $value->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('complaint_from')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col end -->
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="complaint_against" class="form-label">Complaint Against <span>*</span></label>
                                            <select class="form-control form-select" id="complaint_against" name="complaint_against"
                                                required>
                                                <option value="">Select..</option>
                                                @foreach ($employees as $key => $value)
                                                    <option value="{{ $value->id }}" {{ $value->id == $edit_data->complaint_against ? 'selected' : '' }}>{{ $value->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('complaint_against')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col end -->

                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="title" class="form-label">Title
                                                <span>*</span></label>
                                            <input type="text"
                                                class="form-control @error('title') is-invalid @enderror"
                                                name="title" value="{{ $edit_data->title ?? old('title') }}" id="title" required>
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
                                            <label for="date" class="form-label">Complaint Date <span>*</span></label>
                                            <input type="text"
                                                class="form-control @error('date') is-invalid @enderror flatpickr"
                                                name="date" value="{{ $edit_data->date ?? old('date') }}" id="date" required>
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
                                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{ $edit_data->description }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                    <div>
                                        <input type="submit" class="btn btn-submit" value="Save Change">
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
