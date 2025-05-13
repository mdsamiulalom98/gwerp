@extends('backEnd.layouts.master')
@section('title', 'Holiday Edit')
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
                                <h4 class="m-b-10">Holiday Manage</h4>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Holiday Edit
                                </li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <div class="quick_btn">
                                <a href="{{ route('holidays.index') }}"><i class="ti ti-device-desktop-check"></i> Manage</a>
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
                                <h6>Holiday Edit</h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('holidays.update') }}" method="POST" class="row"
                                    data-parsley-validate="" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $edit_data->id }}" name="id">
                                    <div class="col-sm-12">
                                        <div class="form-group mb-3">
                                            <label for="occasion" class="form-label">Occasion</label>
                                            <input type="text"
                                                class="form-control @error('occasion') is-invalid @enderror" name="occasion"
                                                id="occasion" placeholder="Occasion" value="{{ $edit_data->occasion ?? old('occasion') }}"
                                                required>
                                            @error('occasion')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->

                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="start_date" class="form-label">Holiday Start Date
                                                <span>*</span></label>
                                            <input type="text"
                                                class="form-control @error('title') is-invalid @enderror flatpickr"
                                                name="start_date" value="{{ $edit_data->start_date ?? old('start_date') }}" id="start_date" required>
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
                                            <label for="end_date" class="form-label">Holiday End Date <span>*</span></label>
                                            <input type="text"
                                                class="form-control @error('title') is-invalid @enderror flatpickr"
                                                name="end_date" value="{{ $edit_data->end_date ?? old('end_date') }}" id="end_date" required>
                                            @error('end_date')
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
