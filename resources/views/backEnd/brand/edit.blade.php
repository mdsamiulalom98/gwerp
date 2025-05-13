@extends('backEnd.layouts.master')
@section('title', 'Brand Edit')
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
                                <h4 class="m-b-10">Brand Manage</h4>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Brand Edit
                                </li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <div class="quick_btn">
                                <a href="{{ route('brands.index') }}"><i class="ti ti-device-desktop-check"></i>
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
                                <h6>Brand Edit</h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('brands.update') }}" method="POST" class="row"
                                    data-parsley-validate="" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $edit_data->id }}" name="id">
                                    <div class="col-sm-12">
                                        <div class="form-group mb-3">
                                            <label for="name" class="form-label">Brand Name
                                                <span>*</span></label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror "
                                                name="name" value="{{ $edit_data->name ?? old('name') }}" id="name"
                                                required>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                    <div class="col-sm-12">
                                        <div class="form-group mb-3">
                                            <label for="website" class="form-label">Website <span>*</span></label>
                                            <input type="text"
                                                class="form-control @error('title') is-invalid @enderror"
                                                name="website" value="{{ $edit_data->website ?? old('website') }}" id="website" required>
                                            @error('website')
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
                                    <div class="col-sm-12">
                                        <div class="form-group mb-3 row">
                                            <div class="col-9">
                                                <label for="image" class="form-label">Image </label>
                                                <input type="file" id="image"
                                                    class="form-control @error('image') is-invalid @enderror" name="image"
                                                    value="{{ old('image') }}" id="image">
                                                @error('image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-3">
                                                <img id="blah1" src="{{ asset($edit_data->image) }}" width="120"
                                                    class="rounded" height="100" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                    <div class="col-sm-12 mb-3">
                                        <div class="form-group">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" name="status" value="1"
                                                    type="checkbox" id="id"
                                                    {{ $edit_data->status == 1 ? 'checked' : '' }}>
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
        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                let file = input.files[0];
                // Check file size (2MB = 2 * 1024 * 1024 bytes)
                if (file.size > 2 * 1024 * 1024) {
                    alert("File size should not exceed 2MB!");
                    input.value = ""; // Clear the file input
                    $(previewId).attr('src', "").hide(); // Hide the preview
                    return;
                }

                let reader = new FileReader();
                reader.onload = function(e) {
                    $(previewId).attr('src', e.target.result).show();
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image").change(function() {
            previewImage(this, "#blah1");
        });
    </script>
@endpush
