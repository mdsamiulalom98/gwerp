@extends('backEnd.layouts.master')
@section('title','Company Create')
@section('content')
<section class="wsit-container">
	<div class="wsit-content">
		<div class="page-header">
			<div class="page-block">
			    <div class="row align-items-center justify-content-between">
			    	<div class="col-auto">
				    	<div class="page-header-title">
	             		<h4 class="m-b-10">Company</h4>
	            		</div>
						   <ul class="breadcrumb">

							  <li class="breadcrumb-item">
							  	<a href="{{route('dashboard')}}">Dashboard</a>
							  </li>
							  <li class="breadcrumb-item active">
							    Company Create
							  </li>
						   </ul>
				    </div>
			    	<div class="col-auto">
			    		<div class="quick_btn">
                            <a href="{{route('companies.index')}}"><i class="ti ti-plus"></i> Manage</a>
                        </div>
			    	</div>
			    </div>
			</div>
		</div>

		<div class="page-content">
		    <div class="row">
    			<div class="col-sm-3">
					<div class="card quick-sidebar">
						@include('backEnd.partials.hrm_sidebar')
					</div>
    			</div>
    			<div class="col-sm-9">
    				<div class="card">

    					<div class="card-body">
    						<h5 class="title-2">Comapny Create</h5>
    						<form action="{{ route('companies.store') }}" method="POST" class="row"
                                data-parsley-validate="" enctype="multipart/form-data">
                                @csrf
	                                <div class="col-sm-12">
	                                    <div class="form-group mb-3">
	                                        <label for="name" class="form-label">Name *</label>
	                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
	                                            name="name" value="{{old('name') }}" id="name" required="">
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
	                                        <label for="address" class="form-label">Address *</label>
	                                        <textarea  class="form-control @error('address') is-invalid @enderror"
	                                            name="address"  id="address" required=""></textarea>
	                                        @error('address')
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
							 	<div class="col-sm-12">
							 		<input type="submit" class="btn btn-success" value="Submit">
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