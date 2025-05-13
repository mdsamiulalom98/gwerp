@extends('backEnd.layouts.master')
@section('title','Award Create')
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
                        <h4 class="m-b-10">Award Create</h4>
                        </div>
                       <ul class="breadcrumb">
                          <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">Dashboard</a>
                          </li>
                          <li class="breadcrumb-item active">
                            Award Create
                          </li>
                       </ul>
                    </div>
                    <div class="col-auto">
                        <div class="quick_btn">
                            <a href="{{route('awards.index')}}"><i class="ti ti-device-desktop-check"></i> Manage</a>
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
                            <h6> Award Create</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('awards.store') }}" method="POST" class="row"
                                data-parsley-validate="" enctype="multipart/form-data">
                                @csrf
                                 <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="employee_id" class="form-label">Employee <span>*</span></label>
                                        <select class="form-control form-select" id="employee_id"
                                            name="employee_id" required>
                                            <option value="">Select..</option>
                                            @foreach($employees as $key=>$value)
                                            <option value="{{$value->id}}">{{$value->name}}
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
                                        <label for="award_type" class="form-label">Award Type <span>*</span></label>
                                        <select class="form-control form-select" id="award_type"
                                            name="award_type">
                                            <option value="">Select..</option>
                                            @foreach($awardtypes as $key=>$value)
                                            <option value="{{$value->id}}">{{$value->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('award_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col end -->
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="gift" class="form-label">Gift <span>*</span></label>
                                        <input type="text" class="form-control @error('gift') is-invalid @enderror"
                                            name="gift" value="{{ old('gift') }}" id="gift" required>
                                        @error('gift')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col-end -->
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="date" class="form-label">Date <span>*</span></label>
                                        <input type="text" class="form-control @error('date') is-invalid @enderror flatpickr"
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
                                <div class="col-sm-6 mb-3">
                                    <div class="form-group">
                                        <div class="form-check form-switch">
                                          <input class="form-check-input" name="status" value="1" type="checkbox" id="id" checked>
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
