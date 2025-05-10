@extends('backEnd.layouts.master')
@section('title', 'Employee Create')
@section('content')
    <section class="wsit-container">
        <div class="wsit-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="page-header-title">
                                <h4 class="m-b-10">Employee</h4>
                            </div>
                            <ul class="breadcrumb">

                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Employee Create
                                </li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <div class="quick_btn">
                                <a href="{{ route('employees.index') }}"><i class="ti ti-plus"></i> Manage</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content">
                <form action="{{ route('employees.store') }}" method="POST" class="row" data-parsley-validate=""
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card">

                        <div class="card-body">
                            <div class="row">

                                <div class="col-sm-6">
                                    <h5 class="title-2">Personal Details</h5>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="name" class="form-label">Name <span>*</span></label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                                    value="{{ old('name') }}" id="name" required="">
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
                                                <label for="phone" class="form-label">Phone <span>*</span></label>
                                                <input type="text"
                                                    class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                    value="{{ old('phone') }}" id="phone" required="">
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="email" class="form-label">Email <span>*</span></label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email') }}" id="email" required="">
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
                                                <label for="password" class="form-label">Password <span>*</span></label>
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" value="{{ old('password') }}" id="password"
                                                    required="">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->

                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="dob" class="form-label">Date of Birth
                                                    <span>*</span></label>
                                                <input type="date"
                                                    class="form-control @error('dob') is-invalid @enderror" name="dob"
                                                    value="{{ old('dob') }}" id="dob" required="">
                                                @error('dob')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="dob" class="form-label d-block">Gender
                                                    <span>*</span></label>
                                                <input type="radio" class="form-check-input" id="male" name="gender"
                                                    value="male">
                                                <label for="male">Male</label>
                                                <input type="radio" class="form-check-input" id="female"
                                                    name="gender" value="female">
                                                <label for="female">Female</label>
                                            </div>
                                        </div>
                                        <!-- col-end -->

                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="passport_country" class="form-label">Passport Country </label>
                                                <input type="text"
                                                    class="form-control @error('passport_country') is-invalid @enderror"
                                                    name="passport_country" value="{{ old('passport_country') }}"
                                                    id="passport_country">
                                                @error('passport_country')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="passport_no" class="form-label">Passport</label>
                                                <input type="text"
                                                    class="form-control @error('passport_no') is-invalid @enderror"
                                                    name="passport_no" value="{{ old('passport_no') }}"
                                                    id="passport_no">
                                                @error('passport_no')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                    </div>
                                </div>


                                <div class="col-sm-6">

                                    <h5 class="title-2">Location Details</h5>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="location_type" class="form-label">Location Type</label>

                                                <select class="form-control form-select" id="location_type"
                                                    name="location_type">
                                                    <option value="">Select Location Type</option>
                                                    <option value="residential" selected="selected">Residential
                                                    </option>
                                                    <option value="postal">Postal</option>
                                                    <option value="work_address">Work Address</option>
                                                </select>
                                                @error('location_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col end -->
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="country" class="form-label">Country</label>
                                                <input type="text"
                                                    class="form-control @error('country') is-invalid @enderror"
                                                    name="country" value="{{ old('country') }}" id="country">
                                                @error('country')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->

                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="passport_no" class="form-label">State</label>
                                                <input type="text"
                                                    class="form-control @error('passport_no') is-invalid @enderror"
                                                    name="passport_no" value="{{ old('passport_no') }}"
                                                    id="passport_no">
                                                @error('passport_no')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="city" class="form-label">City</label>
                                                <input type="text"
                                                    class="form-control @error('city') is-invalid @enderror"
                                                    name="city" value="{{ old('city') }}" id="city">
                                                @error('city')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="zip_code" class="form-label">Zip Code
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('zip_code') is-invalid @enderror"
                                                    name="zip_code" value="{{ old('zip_code') }}" id="zip_code">
                                                @error('zip_code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->

                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="address" class="form-label">Address <span>*</span></label>
                                                <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" required=""></textarea>
                                                @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->

                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-sm-6">

                                    <h5 class="title-2">Document</h5>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group mb-3 row">
                                                <div class="col-9">
                                                    <label for="certificate" class="form-label">Certificate </label>
                                                    <input type="file" id="certificate"
                                                        class="form-control @error('certificate') is-invalid @enderror"
                                                        name="certificate" value="{{ old('certificate') }}"
                                                        id="certificate">
                                                    @error('certificate')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-3">
                                                    <img id="blah1"
                                                        src="{{ asset('public/backEnd/assets/images/default.png') }}"
                                                        width="120" class="rounded" height="100" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                        <div class="col-sm-12">
                                            <div class="form-group mb-3 row">
                                                <div class="col-9">
                                                    <label for="cv" class="form-label">CV </label>
                                                    <input type="file"
                                                        class="form-control @error('cv') is-invalid @enderror"
                                                        name="cv" value="{{ old('cv') }}" id="cv">
                                                    @error('cv')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-3">
                                                    <img id="blah2"
                                                        src="{{ asset('public/backEnd/assets/images/default.png') }}"
                                                        width="120" class="rounded" height="100" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                        <div class="col-sm-12">
                                            <div class="form-group mb-3 row">
                                                <div class="col-9">
                                                    <label for="photo" class="form-label">Photos </label>
                                                    <input type="file"
                                                        class="form-control @error('photo') is-invalid @enderror"
                                                        name="photo" value="{{ old('photo') }}" id="photo">
                                                    @error('photo')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-3">
                                                    <img id="blah3"
                                                        src="{{ asset('public/backEnd/assets/images/default.png') }}"
                                                        width="120" class="rounded" height="100" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                        <div class="col-sm-12">
                                            <div class="form-group mb-3 row">
                                                <div class="col-9">
                                                    <label for="result" class="form-label">Results </label>
                                                    <input type="file"
                                                        class="form-control @error('result') is-invalid @enderror"
                                                        name="result" value="{{ old('result') }}" id="result">
                                                    @error('result')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-3">
                                                    <img id="blah4"
                                                        src="{{ asset('public/backEnd/assets/images/default.png') }}"
                                                        width="120" class="rounded" height="100" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                    </div>
                                </div>

                                <div class="col-sm-6">

                                    <h5 class="title-2">Bank Account Detail</h5>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="bank_holder" class="form-label">Account Holder Name</label>
                                                <input type="text"
                                                    class="form-control @error('bank_holder') is-invalid @enderror"
                                                    name="bank_holder" value="{{ old('bank_holder') }}"
                                                    id="bank_holder">
                                                @error('bank_holder')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->

                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="bank_account" class="form-label">Account Number</label>
                                                <input type="text"
                                                    class="form-control @error('bank_account') is-invalid @enderror"
                                                    name="bank_account" value="{{ old('bank_account') }}"
                                                    id="bank_account">
                                                @error('bank_account')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="bank_name" class="form-label">Bank Name</label>
                                                <input type="text"
                                                    class="form-control @error('bank_name') is-invalid @enderror"
                                                    name="bank_name" value="{{ old('bank_name') }}" id="bank_name">
                                                @error('bank_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="zip_code" class="form-label">Bank Identifier Code
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('zip_code') is-invalid @enderror"
                                                    name="zip_code" value="{{ old('zip_code') }}" id="zip_code">
                                                @error('zip_code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="bank_branch" class="form-label">Branch Location
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('bank_branch') is-invalid @enderror"
                                                    name="bank_branch" value="{{ old('bank_branch') }}"
                                                    id="bank_branch">
                                                @error('bank_branch')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="bank_routing" class="form-label">Tax Payer ID
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('bank_routing') is-invalid @enderror"
                                                    name="bank_routing" value="{{ old('bank_routing') }}"
                                                    id="bank_routing">
                                                @error('bank_routing')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->


                                    </div>

                                </div>
                            </div>
                            <!-- row end -->
                        </div>
                        <!-- card end -->

                    </div>
                    <!-- card end -->
                    <div class="card">

                        <div class="card-body">
                            <div class="row">

                                <div class="col-sm-6">
                                    <h5 class="title-2">Company Detail</h5>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group mb-3">
                                                <label for="employee_id" class="form-label">Employee ID </label>
                                                <input type="text"
                                                    class="form-control @error('employee_id') is-invalid @enderror"
                                                    name="employee_id" value="{{ $employeeId ?? old('employee_id') }}"
                                                    disabled="disabled" id="employee_id">
                                                @error('employee_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->
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
                                                <label for="department_id" class="form-label">Department
                                                    <span>*</span></label>
                                                <select class="form-control form-select" id="department_id"
                                                    required="required" name="department_id">
                                                    @foreach ($departments as $key => $value)
                                                        <option
                                                            {{ old('department_id') == $value->id ? 'selected' : '' }}
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
                                                <label for="designation_id" class="form-label d-block">Designation
                                                    <span>*</span></label>
                                                <select class="form-control form-select" id="designation_id"
                                                    required="required" name="designation_id">
                                                    @foreach ($designations as $key => $value)
                                                        <option
                                                            {{ old('designation_id') == $value->id ? 'selected' : '' }}
                                                            value="{{ $value->id }}">{{ $value->name }}</option>

                                                    @endforeach
                                                </select>
                                                @error('designation_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->

                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="joining_date" class="form-label">Company Date Of Joining
                                                    <span>*</span>
                                                </label>
                                                <input type="date"
                                                    class="form-control @error('joining_date') is-invalid @enderror"
                                                    name="joining_date" value="{{ old('joining_date') }}"
                                                    id="joining_date">
                                                @error('joining_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="role" class="form-label">Role <span>*</span></label>
                                                <select class="form-control form-select" required="required"
                                                    id="role" name="role">
                                                    <option selected="selected" value="">Select Role</option>
                                                    <option value="4">staff</option>
                                                    <option value="6">farmer</option>
                                                    <option value="8">driving student</option>
                                                    <option value="9">tenant</option>
                                                    <option value="11">contractor</option>
                                                    <option value="14">doctor</option>
                                                    <option value="15">patient</option>
                                                    <option value="19">student</option>
                                                    <option value="20">agent</option>
                                                    <option value="98">construction partner</option>
                                                    <option value="115">Manager</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="employee_code" class="form-label">Employee Code</label>
                                                <input type="text" placeholder="Enter Employee Code"
                                                    class="form-control @error('employee_code') is-invalid @enderror"
                                                    name="employee_code" value="{{ old('employee_code') }}"
                                                    id="employee_code">
                                                @error('employee_code')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                        <div class="col-sm-12">
                                            <div class="form-group mb-3">
                                                <label for="number" class="form-label">Number</label>
                                                <input type="text"
                                                    class="form-control @error('number') is-invalid @enderror"
                                                    name="number" value="{{ old('number') }}" id="number">
                                                @error('number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <h5 class="title-2">Hours and Rates Details</h5>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="hour_per_day" class="form-label">Hours Per day</label>
                                                <input type="number"
                                                    class="form-control @error('hour_per_day') is-invalid @enderror"
                                                    name="hour_per_day" value="{{ old('hour_per_day') }}"
                                                    id="hour_per_day">

                                                @error('hour_per_day')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col end -->
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="annual_salary" class="form-label">Annual salary</label>
                                                <input type="number"
                                                    class="form-control @error('annual_salary') is-invalid @enderror"
                                                    name="annual_salary" value="{{ old('annual_salary') }}"
                                                    id="annual_salary">
                                                @error('annual_salary')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->

                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="days_per_week" class="form-label">Days Per week</label>
                                                <input type="number"
                                                    class="form-control @error('days_per_week') is-invalid @enderror"
                                                    name="days_per_week" value="{{ old('days_per_week') }}"
                                                    id="days_per_week">
                                                @error('days_per_week')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="fixed_salary" class="form-label">Fixed Salary</label>
                                                <input type="number"
                                                    class="form-control @error('fixed_salary') is-invalid @enderror"
                                                    name="fixed_salary" value="{{ old('fixed_salary') }}"
                                                    id="fixed_salary">
                                                @error('fixed_salary')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="hour_per_month" class="form-label">Hours Per month
                                                </label>
                                                <input type="number"
                                                    class="form-control @error('hour_per_month') is-invalid @enderror"
                                                    name="hour_per_month" value="{{ old('hour_per_month') }}"
                                                    id="hour_per_month">
                                                @error('hour_per_month')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="rate_per_day" class="form-label">Rate per day
                                                </label>
                                                <input type="number"
                                                    class="form-control @error('rate_per_day') is-invalid @enderror"
                                                    name="rate_per_day" value="{{ old('rate_per_day') }}"
                                                    id="rate_per_day">
                                                @error('rate_per_day')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="days_per_month" class="form-label">Days per month
                                                </label>
                                                <input type="number"
                                                    class="form-control @error('days_per_month') is-invalid @enderror"
                                                    name="days_per_month" value="{{ old('days_per_month') }}"
                                                    id="days_per_month">
                                                @error('days_per_month')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="rate_per_hour" class="form-label">Rate per hour
                                                </label>
                                                <input type="number"
                                                    class="form-control @error('rate_per_hour') is-invalid @enderror"
                                                    name="rate_per_hour" value="{{ old('rate_per_hour') }}"
                                                    id="rate_per_hour">
                                                @error('rate_per_hour')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- col-end -->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <input type="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <!-- row end -->
                        </div>
                        <!-- card end -->

                    </div>
                    <!-- card end -->
                </form>
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

        $("#certificate").change(function() {
            previewImage(this, "#blah1");
        });
        $("#cv").change(function() {
            previewImage(this, "#blah2");
        });
        $("#photo").change(function() {
            previewImage(this, "#blah3");
        });
        $("#result").change(function() {
            previewImage(this, "#blah4");
        });

        $(document).ready(function() {
            $('#fixed_salary, #hour_per_month, #days_per_month, #rate_per_hour, #rate_per_day, #hour_per_day').on(
                'input',
                function() {
                    let fixed_salary = parseFloat($('#fixed_salary').val()) || 0;
                    let hour_per_day = parseFloat($('#hour_per_day').val()) || 0;
                    let hour_per_month = parseFloat($('#hour_per_month').val()) || 0;
                    let days_per_month = parseFloat($('#days_per_month').val()) || 0;

                    // Calculate hour_per_month if hour_per_day and days_per_month are valid
                    if (hour_per_day && days_per_month) {
                        let total_hours = hour_per_day * days_per_month;
                        $('#hour_per_month').val(total_hours);
                        hour_per_month = total_hours; // update for accurate hourly rate calc
                    }

                    // Calculate rate_per_day if days_per_month is valid
                    if (days_per_month > 0) {
                        let rate_per_day_total = Math.ceil(fixed_salary / days_per_month);
                        $('#rate_per_day').val(rate_per_day_total);
                    }

                    // Calculate rate_per_hour if hour_per_month is valid
                    if (hour_per_month > 0) {
                        let rate_per_hour_total = Math.ceil(fixed_salary / hour_per_month);
                        $('#rate_per_hour').val(rate_per_hour_total);
                    }

                    if (fixed_salary > 0) {
                        let annual_salary = fixed_salary * 12;
                        $('#annual_salary').val(annual_salary);
                    }
                });
        });
    </script>
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
