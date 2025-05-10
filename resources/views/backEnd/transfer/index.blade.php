@extends('backEnd.layouts.master')
@section('title','Transfer Manage')
@push('css')
<!-- DataTables JS -->
<link href="{{asset('public/backEnd/assets/')}}/css/dataTables.dataTables.css">
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
                            Transfer Manage
                          </li>
                       </ul>
                    </div>
                    <div class="col-auto">
                        <div class="quick_btn">
                            <a href="{{route('transfers.create')}}"><i class="ti ti-plus"></i> New</a>
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
                            <h6>Transfer Manage</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="data-table" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Employee</th>
                                        <th>Company</th>
                                        <th>Branch</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="quickview_modal" tabindex="-1" aria-labelledby="quickview_modal"
            aria-hidden="true">
<div class="modal-dialog  modal-dialog-scrollable">
    <div class="modal-content" id="modal_content">

    </div>
</div>
</div>
@push('script')
<!-- DataTables JS -->
<script src="{{asset('public/backEnd/assets/')}}/js/dataTables.js"></script>
<script src="{{asset('public/backEnd/assets/')}}/js/dataTables.bootstrap5.js"></script>
<script>
   $(function(){
    var table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax:"{{route('transfers.index')}}",
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
            {data: 'employee', name:'employee'},
            {data: 'company', name:'company'},
            {data: 'branch', name:'branch'},
            {data: 'date', name:'date'},
            {data: 'status', name:'status'},
            {data: 'action', name:'action'},
        ]
    });
   })
</script>
@endpush
@endsection