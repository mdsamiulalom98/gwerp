@extends('backEnd.layouts.master')
@section('title','Transfer Edit')
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
                        <h4 class="m-b-10">Transfer Manage</h4>
                        </div>
                       <ul class="breadcrumb">
                          <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">Dashboard</a>
                          </li>
                          <li class="breadcrumb-item active">
                            Transfer Edit
                          </li>
                       </ul>
                    </div>
                    <div class="col-auto">
                        <div class="quick_btn">
                            <a href="{{route('transfers.index')}}"><i class="ti ti-device-desktop-check"></i> Manage</a>
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
                            <h6>Transfer Edit</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('transfers.update') }}" method="POST" class="row"
                                data-parsley-validate="" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $edit_data->id }}" name="id">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="employee_id" class="form-label">Employee <span>*</span></label>
                                        <select class="form-control form-select" id="employee_id"
                                            name="employee_id" required>
                                            <option value="">Select..</option>
                                            @foreach($employees as $key=>$value)
                                            <option value="{{$value->id}}" {{ $edit_data->employee_id === $value->id ? 'selected' : '' }}>{{$value->name}}
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
                                        <label for="company_id" class="form-label">Company <span>*</span></label>
                                        <select class="form-control form-select" required="required"
                                            id="company_id" name="company_id">
                                            <option value="">Select Company</option>
                                            @foreach ($companies as $key => $value)
                                                <option
                                                    {{ $edit_data->company_id === $value->id ? 'selected' : '' }}
                                                    value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('company_id')
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
                                        <select class="form-control form-select" required="required"
                                            id="branch_id" name="branch_id">
                                            <option value="">Select Branch</option>
                                            @foreach ($branches as $branch)
                                                <option
                                                    {{ $edit_data->branch_id == $branch->id ? 'selected' : '' }}
                                                    value="{{ $branch->id }}">{{ $branch->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('branch_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col-end -->

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="department_id" class="form-label">Department
                                            <span>*</span></label>
                                        <select class="form-control form-select" id="department_id"
                                            required="required" name="department_id">
                                            <option value="">Select Department</option>
                                            @foreach ($departments as $key => $value)
                                                <option
                                                    {{ $edit_data->department_id == $value->id ? 'selected' : '' }}
                                                    value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
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

@push('script')
<script>
    $("#company_id").on("change", function() {
        var ajaxId = $(this).val();
        if (ajaxId) {
            $.ajax({
                type: "GET",
                url: "{{ url('ajax-employee-branch') }}?company_id=" + ajaxId,
                success: function(res) {
                    if (res) {
                        $("#branch_id").empty();
                        $("#branch_id").append('<option value="0">Choose...</option>');
                        $.each(res, function(key, value) {
                            $("#branch_id").append('<option value="' + key + '">' +
                                value + "</option>");
                        });
                    } else {
                        $("#branch_id").empty();
                    }
                },
            });
        } else {
            $("#branch_id").empty();
        }
    });
</script>
@endpush
