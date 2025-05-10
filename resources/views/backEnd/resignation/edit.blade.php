@extends('backEnd.layouts.master')
@section('title','Resignation Edit')
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
                        <h4 class="m-b-10">Resignation Manage</h4>
                        </div>
                       <ul class="breadcrumb">
                          <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">Dashboard</a>
                          </li>
                          <li class="breadcrumb-item active">
                            Resignation Edit
                          </li>
                       </ul>
                    </div>
                    <div class="col-auto">
                        <div class="quick_btn">
                            <a href="{{route('resignations.index')}}"><i class="ti ti-device-desktop-check"></i> Manage</a>
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
                            <h6>Resignation Edit</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('resignations.update') }}" method="POST" class="row"
                                data-parsley-validate="" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $edit_data->id }}" name="id">
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label for="employee_id" class="form-label">Employee <span>*</span></label>
                                        <select class="form-control form-select" id="employee_id"
                                            name="employee_id" required>
                                            <option value="">Select..</option>
                                            @foreach($employees as $key=>$value)
                                            <option value="{{$value->id}}" {{$value->id == $edit_data->employee_id ? 'selected' : ''}}>{{$value->name}}
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
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label for="resign_date" class="form-label">Resignation Date <span>*</span></label>
                                        <input type="text" class="form-control @error('resign_date') is-invalid @enderror flatpickr"
                                            name="resign_date" value="{{ $edit_data->resign_date }}" id="resign_date" required>
                                        @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col-end -->
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label for="last_date" class="form-label">Last Working Date <span>*</span></label>
                                        <input type="text" class="form-control @error('last_date') is-invalid @enderror flatpickr"
                                            name="last_date" value="{{ $edit_data->last_date }}" id="last_date" required>
                                        @error('last_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col-end -->
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="description" class="form-label">Description </label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description">{{$edit_data->description}}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col-end -->
                                <div class="col-sm-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-check form-switch">
                                          <input class="form-check-input" type="checkbox" id="id" checked>
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
