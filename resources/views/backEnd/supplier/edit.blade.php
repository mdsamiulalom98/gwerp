@extends('backEnd.layouts.master')
@section('title', 'Supplier Edit')
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
                                <h4 class="m-b-10">Supplier Manage</h4>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Supplier Edit
                                </li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <div class="quick_btn">
                                <a href="{{ route('suppliers.index') }}"><i class="ti ti-device-desktop-check"></i>
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
                                <h6>Supplier Edit</h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('suppliers.update') }}" method="POST" class="row"
                                    data-parsley-validate="" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $edit_data->id }}" name="id">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">Name
                                                <span>*</span></label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                name="name" value="{{ $edit_data->name ?? old('name') }}" id="name" required>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->

                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="email" class="form-label">Email
                                                <span>*</span></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror "
                                                name="email" value="{{ $edit_data->email ?? old('email') }}" id="email" required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="contact_number" class="form-label">Contact Number
                                                <span>*</span></label>
                                            <input type="text"
                                                class="form-control @error('contact_number') is-invalid @enderror "
                                                name="contact_number" value="{{ $edit_data->contact_number ?? old('contact_number') }}"
                                                id="contact_number" required>
                                            @error('contact_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="contact_person" class="form-label">Contact Person
                                                <span>*</span></label>
                                            <input type="text"
                                                class="form-control @error('contact_person') is-invalid @enderror "
                                                name="contact_person" value="{{ $edit_data->contact_person ?? old('contact_person') }}"
                                                id="contact_person" required>
                                            @error('contact_person')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->

                                    <div class="col-sm-12">
                                        <div class="form-group mb-3">
                                            <label for="address" class="form-label">Address </label>
                                            <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address">{{ $edit_data->address }}</textarea>
                                            @error('address')
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
                                    <div class="col-sm-12 mb-3">
                                        <div class="form-group">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" name="status" value="1"
                                                    type="checkbox" id="id" {{ $edit_data->status == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="id">Status</label>
                                            </div>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col end -->
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
