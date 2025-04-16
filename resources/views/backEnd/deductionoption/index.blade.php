@extends('backEnd.layouts.master')
@section('title','Deduction Option Manage')
@section('content')
<section class="wsit-container">
	<div class="wsit-content">
		<div class="page-header">
			<div class="page-block">
			    <div class="row align-items-center justify-content-between">
			    	<div class="col-auto">
				    	<div class="page-header-title">
	             		<h4 class="m-b-10">Deduction Option</h4>
	            		</div>
						   <ul class="breadcrumb">

							  <li class="breadcrumb-item">
							  	<a href="{{route('dashboard')}}">Dashboard</a>
							  </li>
							  <li class="breadcrumb-item active">
							    Deduction Option Manage
							  </li>
						   </ul>
				    </div>
			    	<div class="col-auto">
			    		<div class="quick_btn">
                            <a href="{{route('deductionoptions.create')}}"><i class="ti ti-plus"></i> New</a>
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
    						<h5 class="title-2">Deduction Option Manage</h5>
    						<table class="table table-striped" id="data-table" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
    					</div>
    				</div>
    			</div>
    		</div>
		</div>
	</div>
</section>
@push('script')
<!-- DataTables JS -->
<script src="{{asset('public/backEnd/assets/')}}/js/dataTables.js"></script>
<script src="{{asset('public/backEnd/assets/')}}/js/dataTables.bootstrap5.js"></script>
<script>
   $(function(){
    var table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax:"{{route('deductionoptions.index')}}",
        pageLength: 50,
        lengthMenu: [50, 100, 200, 500],
        columns:[
             { 
                data: null, 
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                orderable: false, 
                searchable: false
            },
            {data: 'name', name:'name'},
            {data: 'status', name:'status'},
            {data: 'action', name:'action'},
        ]
    });
   })
</script>
@endpush
@endsection