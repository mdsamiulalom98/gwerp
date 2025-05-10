@extends('backEnd.layouts.master')
@section('title','Company Policy Create')
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
                        <h4 class="m-b-10">Company Policy Manage</h4>
                        </div>
                       <ul class="breadcrumb">
                          <li class="breadcrumb-item">
                            <a href="{{route('dashboard')}}">Dashboard</a>
                          </li>
                          <li class="breadcrumb-item active">
                            Company Policy Create
                          </li>
                       </ul>
                    </div>
                   
                    <div class="col-auto">
                        <div class="quick_btn">
                            <a href="{{route('companypolicies.index')}}"><i class="ti ti-device-desktop-check"></i> Manage</a>
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
                            <h6> Company Policy Create</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('companypolicies.store') }}" method="POST" class="row"
                                data-parsley-validate="" enctype="multipart/form-data">
                                @csrf

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="company_id" class="form-label">Company <span>*</span></label>
                                        <select class="form-control form-select" required="required"
                                            id="company_id" name="company_id">
                                            <option value="">Select Company</option>
                                            @foreach ($companies as $key => $value)
                                                <option
                                                    {{ old('company_id') === $value->id ? 'selected' : '' }}
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
                                        <label for="title" class="form-label">Title *</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            name="title" value="{{ old('title') }}" id="title" required="">
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
                                        <label for="file" class="form-label">File</label>
                                        <input type="file" accept="docs/pdf*" class="form-control @error('file') is-invalid @enderror"
                                            name="file" value="{{old('file') }}" id="file">
                                        @error('file')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- col end -->
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

@push('script')
<script>
    // category to sub
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
