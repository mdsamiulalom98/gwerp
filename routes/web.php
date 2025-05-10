<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\AllowanceTypeController;
use App\Http\Controllers\Admin\AwardTypeController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CompetenceController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\DeductionOptionController;
use App\Http\Controllers\Admin\DocumentTypeController;
use App\Http\Controllers\Admin\GoalTypeController;
use App\Http\Controllers\Admin\LoanOptionController;
use App\Http\Controllers\Admin\LeaveController;
use App\Http\Controllers\Admin\LeaveTypeController;
use App\Http\Controllers\Admin\PayslipTypeController;
use App\Http\Controllers\Admin\PerformanceTypeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TerminationTypeController;
use App\Http\Controllers\Admin\TrainingTypeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\CompanyPolicyController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\AwardController;
use App\Http\Controllers\Admin\TransferController;
use App\Http\Controllers\Admin\ResignationController;
use App\Http\Controllers\Admin\TripController;

Auth::routes();

Route::get('ajax-employee-branch', [EmployeeController::class, 'getBranch']);
// auth route
Route::group(['namespace' => 'Admin', 'middleware' => ['auth'], 'prefix' => 'admin'], function () {

    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('profile', [UserController::class, 'profile'])->name('admin.profile');

    Route::get('users/manage', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users/save', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('users/update', [UserController::class, 'update'])->name('users.update');
    Route::post('users/inactive', [UserController::class, 'inactive'])->name('users.inactive');
    Route::post('users/active', [UserController::class, 'active'])->name('users.active');
    Route::post('users/destroy', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('users/change-password', [UserController::class, 'change_password'])->name('users.change_password');

    // roles
    Route::get('roles/manage', [RoleController::class, 'index'])->name('roles.index');
    Route::get('roles/{id}/show', [RoleController::class, 'show'])->name('roles.show');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('roles/save', [RoleController::class, 'store'])->name('roles.store');
    Route::get('roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('roles/update', [RoleController::class, 'update'])->name('roles.update');
    Route::post('roles/destroy', [RoleController::class, 'destroy'])->name('roles.destroy');

    // permissions
    Route::get('permissions/manage', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('permissions/{id}/show', [PermissionController::class, 'show'])->name('permissions.show');
    Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('permissions/save', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('permissions/update', [PermissionController::class, 'update'])->name('permissions.update');
    Route::post('permissions/destroy', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    Route::get('company/manage', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('company/create', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('company/save', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('company/{id}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
    Route::post('company/update', [CompanyController::class, 'update'])->name('companies.update');
    Route::post('company/inactive', [CompanyController::class, 'inactive'])->name('companies.inactive');
    Route::post('company/active', [CompanyController::class, 'active'])->name('companies.active');

    Route::get('branch/manage', [BranchController::class, 'index'])->name('branches.index');
    Route::get('branch/create', [BranchController::class, 'create'])->name('branches.create');
    Route::post('branch/save', [BranchController::class, 'store'])->name('branches.store');
    Route::get('branch/{id}/edit', [BranchController::class, 'edit'])->name('branches.edit');
    Route::post('branch/update', [BranchController::class, 'update'])->name('branches.update');
    Route::post('branch/inactive', [BranchController::class, 'inactive'])->name('branches.inactive');
    Route::post('branch/active', [BranchController::class, 'active'])->name('branches.active');

    Route::get('department/manage', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('department/create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('department/save', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('department/{id}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::post('department/update', [DepartmentController::class, 'update'])->name('departments.update');
    Route::post('department/inactive', [DepartmentController::class, 'inactive'])->name('departments.inactive');
    Route::post('department/active', [DepartmentController::class, 'active'])->name('departments.active');

    Route::get('designation/manage', [DesignationController::class, 'index'])->name('designations.index');
    Route::get('designation/create', [DesignationController::class, 'create'])->name('designations.create');
    Route::post('designation/save', [DesignationController::class, 'store'])->name('designations.store');
    Route::get('designation/{id}/edit', [DesignationController::class, 'edit'])->name('designations.edit');
    Route::post('designation/update', [DesignationController::class, 'update'])->name('designations.update');
    Route::post('designation/inactive', [DesignationController::class, 'inactive'])->name('designations.inactive');
    Route::post('designation/active', [DesignationController::class, 'active'])->name('designations.active');

    Route::get('allowancetype/manage', [AllowanceTypeController::class, 'index'])->name('allowancetypes.index');
    Route::get('allowancetype/create', [AllowanceTypeController::class, 'create'])->name('allowancetypes.create');
    Route::post('allowancetype/save', [AllowanceTypeController::class, 'store'])->name('allowancetypes.store');
    Route::get('allowancetype/{id}/edit', [AllowanceTypeController::class, 'edit'])->name('allowancetypes.edit');
    Route::post('allowancetype/update', [AllowanceTypeController::class, 'update'])->name('allowancetypes.update');
    Route::post('allowancetype/inactive', [AllowanceTypeController::class, 'inactive'])->name('allowancetypes.inactive');
    Route::post('allowancetype/active', [AllowanceTypeController::class, 'active'])->name('allowancetypes.active');

    Route::get('loanoption/manage', [LoanOptionController::class, 'index'])->name('loanoptions.index');
    Route::get('loanoption/create', [LoanOptionController::class, 'create'])->name('loanoptions.create');
    Route::post('loanoption/save', [LoanOptionController::class, 'store'])->name('loanoptions.store');
    Route::get('loanoption/{id}/edit', [LoanOptionController::class, 'edit'])->name('loanoptions.edit');
    Route::post('loanoption/update', [LoanOptionController::class, 'update'])->name('loanoptions.update');
    Route::post('loanoption/inactive', [LoanOptionController::class, 'inactive'])->name('loanoptions.inactive');
    Route::post('loanoption/active', [LoanOptionController::class, 'active'])->name('loanoptions.active');

    Route::get('deductionoption/manage', [DeductionOptionController::class, 'index'])->name('deductionoptions.index');
    Route::get('deductionoption/create', [DeductionOptionController::class, 'create'])->name('deductionoptions.create');
    Route::post('deductionoption/save', [DeductionOptionController::class, 'store'])->name('deductionoptions.store');
    Route::get('deductionoption/{id}/edit', [DeductionOptionController::class, 'edit'])->name('deductionoptions.edit');
    Route::post('deductionoption/update', [DeductionOptionController::class, 'update'])->name('deductionoptions.update');
    Route::post('deductionoption/inactive', [DeductionOptionController::class, 'inactive'])->name('deductionoptions.inactive');
    Route::post('deductionoption/active', [DeductionOptionController::class, 'active'])->name('deductionoptions.active');

    Route::get('documenttype/manage', [DocumentTypeController::class, 'index'])->name('documenttypes.index');
    Route::get('documenttype/create', [DocumentTypeController::class, 'create'])->name('documenttypes.create');
    Route::post('documenttype/save', [DocumentTypeController::class, 'store'])->name('documenttypes.store');
    Route::get('documenttype/{id}/edit', [DocumentTypeController::class, 'edit'])->name('documenttypes.edit');
    Route::post('documenttype/update', [DocumentTypeController::class, 'update'])->name('documenttypes.update');
    Route::post('documenttype/inactive', [DocumentTypeController::class, 'inactive'])->name('documenttypes.inactive');
    Route::post('documenttype/active', [DocumentTypeController::class, 'active'])->name('documenttypes.active');

    Route::get('paysliptype/manage', [PayslipTypeController::class, 'index'])->name('paysliptypes.index');
    Route::get('paysliptype/create', [PayslipTypeController::class, 'create'])->name('paysliptypes.create');
    Route::post('paysliptype/save', [PayslipTypeController::class, 'store'])->name('paysliptypes.store');
    Route::get('paysliptype/{id}/edit', [PayslipTypeController::class, 'edit'])->name('paysliptypes.edit');
    Route::post('paysliptype/update', [PayslipTypeController::class, 'update'])->name('paysliptypes.update');
    Route::post('paysliptype/inactive', [PayslipTypeController::class, 'inactive'])->name('paysliptypes.inactive');
    Route::post('paysliptype/active', [PayslipTypeController::class, 'active'])->name('paysliptypes.active');

    Route::get('leavetype/manage', [LeaveTypeController::class, 'index'])->name('leavetypes.index');
    Route::get('leavetype/create', [LeaveTypeController::class, 'create'])->name('leavetypes.create');
    Route::post('leavetype/save', [LeaveTypeController::class, 'store'])->name('leavetypes.store');
    Route::get('leavetype/{id}/edit', [LeaveTypeController::class, 'edit'])->name('leavetypes.edit');
    Route::post('leavetype/update', [LeaveTypeController::class, 'update'])->name('leavetypes.update');
    Route::post('leavetype/inactive', [LeaveTypeController::class, 'inactive'])->name('leavetypes.inactive');
    Route::post('leavetype/active', [LeaveTypeController::class, 'active'])->name('leavetypes.active');

    // leave
    Route::get('leave/manage', [LeaveController::class, 'index'])->name('leaves.index');
    Route::get('leave/create', [LeaveController::class, 'create'])->name('leaves.create');
    Route::post('leave/save', [LeaveController::class, 'store'])->name('leaves.store');
    Route::get('leave/{id}/edit', [LeaveController::class, 'edit'])->name('leaves.edit');
    Route::get('leave/{id}/show', [LeaveController::class, 'show'])->name('leaves.show');
    Route::post('leave/update', [LeaveController::class, 'update'])->name('leaves.update');
    Route::post('leave/destroy', [LeaveController::class, 'destroy'])->name('leaves.destroy');

    Route::get('awardtype/manage', [AwardTypeController::class, 'index'])->name('awardtypes.index');
    Route::get('awardtype/create', [AwardTypeController::class, 'create'])->name('awardtypes.create');
    Route::post('awardtype/save', [AwardTypeController::class, 'store'])->name('awardtypes.store');
    Route::get('awardtype/{id}/edit', [AwardTypeController::class, 'edit'])->name('awardtypes.edit');
    Route::post('awardtype/update', [AwardTypeController::class, 'update'])->name('awardtypes.update');
    Route::post('awardtype/inactive', [AwardTypeController::class, 'inactive'])->name('awardtypes.inactive');
    Route::post('awardtype/active', [AwardTypeController::class, 'active'])->name('awardtypes.active');


    Route::get('terminationtype/manage', [TerminationTypeController::class, 'index'])->name('terminationtypes.index');
    Route::get('terminationtype/create', [TerminationTypeController::class, 'create'])->name('terminationtypes.create');
    Route::post('terminationtype/save', [TerminationTypeController::class, 'store'])->name('terminationtypes.store');
    Route::get('terminationtype/{id}/edit', [TerminationTypeController::class, 'edit'])->name('terminationtypes.edit');
    Route::post('terminationtype/update', [TerminationTypeController::class, 'update'])->name('terminationtypes.update');
    Route::post('terminationtype/inactive', [TerminationTypeController::class, 'inactive'])->name('terminationtypes.inactive');
    Route::post('terminationtype/active', [TerminationTypeController::class, 'active'])->name('terminationtypes.active');

    Route::get('performancetype/manage', [PerformanceTypeController::class, 'index'])->name('performancetypes.index');
    Route::get('performancetype/create', [PerformanceTypeController::class, 'create'])->name('performancetypes.create');
    Route::post('performancetype/save', [PerformanceTypeController::class, 'store'])->name('performancetypes.store');
    Route::get('performancetype/{id}/edit', [PerformanceTypeController::class, 'edit'])->name('performancetypes.edit');
    Route::post('performancetype/update', [PerformanceTypeController::class, 'update'])->name('performancetypes.update');
    Route::post('performancetype/inactive', [PerformanceTypeController::class, 'inactive'])->name('performancetypes.inactive');
    Route::post('performancetype/active', [PerformanceTypeController::class, 'active'])->name('performancetypes.active');

    Route::get('competence/manage', [CompetenceController::class, 'index'])->name('competencies.index');
    Route::get('competence/create', [CompetenceController::class, 'create'])->name('competencies.create');
    Route::post('competence/save', [CompetenceController::class, 'store'])->name('competencies.store');
    Route::get('competence/{id}/edit', [CompetenceController::class, 'edit'])->name('competencies.edit');
    Route::post('competence/update', [CompetenceController::class, 'update'])->name('competencies.update');
    Route::post('competence/inactive', [CompetenceController::class, 'inactive'])->name('competencies.inactive');
    Route::post('competence/active', [CompetenceController::class, 'active'])->name('competencies.active');

    Route::get('goaltype/manage', [GoalTypeController::class, 'index'])->name('goaltypes.index');
    Route::get('goaltype/create', [GoalTypeController::class, 'create'])->name('goaltypes.create');
    Route::post('goaltype/save', [GoalTypeController::class, 'store'])->name('goaltypes.store');
    Route::get('goaltype/{id}/edit', [GoalTypeController::class, 'edit'])->name('goaltypes.edit');
    Route::post('goaltype/update', [GoalTypeController::class, 'update'])->name('goaltypes.update');
    Route::post('goaltype/inactive', [GoalTypeController::class, 'inactive'])->name('goaltypes.inactive');
    Route::post('goaltype/active', [GoalTypeController::class, 'active'])->name('goaltypes.active');

    Route::get('trainingtype/manage', [TrainingTypeController::class, 'index'])->name('trainingtypes.index');
    Route::get('trainingtype/create', [TrainingTypeController::class, 'create'])->name('trainingtypes.create');
    Route::post('trainingtype/save', [TrainingTypeController::class, 'store'])->name('trainingtypes.store');
    Route::get('trainingtype/{id}/edit', [TrainingTypeController::class, 'edit'])->name('trainingtypes.edit');
    Route::post('trainingtype/update', [TrainingTypeController::class, 'update'])->name('trainingtypes.update');
    Route::post('trainingtype/inactive', [TrainingTypeController::class, 'inactive'])->name('trainingtypes.inactive');
    Route::post('trainingtype/active', [TrainingTypeController::class, 'active'])->name('trainingtypes.active');

    // setting
    Route::get('general-setting/manage', [SettingController::class, 'edit'])->name('settings.edit');
    Route::post('general-setting/update', [SettingController::class, 'update'])->name('settings.update');

    // employee
    Route::get('employee/manage', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('employee/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('employee/save', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('employee/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::post('employee/update', [EmployeeController::class, 'update'])->name('employees.update');
    Route::get('employee/{id}/show', [EmployeeController::class, 'show'])->name('employees.show');
    Route::post('employee/inactive', [EmployeeController::class, 'inactive'])->name('employees.inactive');
    Route::post('employee/active', [EmployeeController::class, 'active'])->name('employees.active');
    Route::post('employee/destroy', [EmployeeController::class, 'destroy'])->name('employees.destroy');

    // company policies
    Route::get('company-policy/manage', [CompanyPolicyController::class, 'index'])->name('companypolicies.index');
    Route::get('company-policy/create', [CompanyPolicyController::class, 'create'])->name('companypolicies.create');
    Route::post('company-policy/save', [CompanyPolicyController::class, 'store'])->name('companypolicies.store');
    Route::get('company-policy/{id}/edit', [CompanyPolicyController::class, 'edit'])->name('companypolicies.edit');
    Route::post('company-policy/update', [CompanyPolicyController::class, 'update'])->name('companypolicies.update');
    Route::post('company-policy/inactive', [CompanyPolicyController::class, 'inactive'])->name('companypolicies.inactive');
    Route::post('company-policy/active', [CompanyPolicyController::class, 'active'])->name('companypolicies.active');
    Route::post('company-policy/destroy', [CompanyPolicyController::class, 'destroy'])->name('companypolicies.destroy');

    // document
    Route::get('document/manage', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('document/create', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('document/save', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('document/{id}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
    Route::post('document/update', [DocumentController::class, 'update'])->name('documents.update');
    Route::post('document/inactive', [DocumentController::class, 'inactive'])->name('documents.inactive');
    Route::post('document/active', [DocumentController::class, 'active'])->name('documents.active');
    Route::post('document/destroy', [DocumentController::class, 'destroy'])->name('documents.destroy');

    // event
    Route::get('event/manage', [EventController::class, 'index'])->name('events.index');
    Route::get('event/create', [EventController::class, 'create'])->name('events.create');
    Route::post('event/save', [EventController::class, 'store'])->name('events.store');
    Route::get('event/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::post('event/update', [EventController::class, 'update'])->name('events.update');
    Route::post('event/inactive', [EventController::class, 'inactive'])->name('events.inactive');
    Route::post('event/active', [EventController::class, 'active'])->name('events.active');
    Route::post('event/destroy', [EventController::class, 'destroy'])->name('events.destroy');

    // award
    Route::get('award/manage', [AwardController::class, 'index'])->name('awards.index');
    Route::get('award/create', [AwardController::class, 'create'])->name('awards.create');
    Route::post('award/save', [AwardController::class, 'store'])->name('awards.store');
    Route::get('award/{id}/edit', [AwardController::class, 'edit'])->name('awards.edit');
    Route::post('award/update', [AwardController::class, 'update'])->name('awards.update');
    Route::post('award/inactive', [AwardController::class, 'inactive'])->name('awards.inactive');
    Route::post('award/active', [AwardController::class, 'active'])->name('awards.active');
    Route::post('award/destroy', [AwardController::class, 'destroy'])->name('awards.destroy');

    // transfer
    Route::get('transfer/manage', [TransferController::class, 'index'])->name('transfers.index');
    Route::get('transfer/create', [TransferController::class, 'create'])->name('transfers.create');
    Route::post('transfer/save', [TransferController::class, 'store'])->name('transfers.store');
    Route::get('transfer/{id}/edit', [TransferController::class, 'edit'])->name('transfers.edit');
    Route::post('transfer/update', [TransferController::class, 'update'])->name('transfers.update');
    Route::post('transfer/inactive', [TransferController::class, 'inactive'])->name('transfers.inactive');
    Route::post('transfer/active', [TransferController::class, 'active'])->name('transfers.active');
    Route::post('transfer/destroy', [TransferController::class, 'destroy'])->name('transfers.destroy');
    
    // resignation
    Route::get('resignation/manage', [ResignationController::class, 'index'])->name('resignations.index');
    Route::get('resignation/create', [ResignationController::class, 'create'])->name('resignations.create');
    Route::post('resignation/save', [ResignationController::class, 'store'])->name('resignations.store');
    Route::get('resignation/{id}/edit', [ResignationController::class, 'edit'])->name('resignations.edit');
    Route::post('resignation/update', [ResignationController::class, 'update'])->name('resignations.update');
    Route::post('resignation/inactive', [ResignationController::class, 'inactive'])->name('resignations.inactive');
    Route::post('resignation/active', [ResignationController::class, 'active'])->name('resignations.active');
    Route::post('resignation/destroy', [ResignationController::class, 'destroy'])->name('resignations.destroy');
    
    // trip
    Route::get('trip/manage', [TripController::class, 'index'])->name('trips.index');
    Route::get('trip/create', [TripController::class, 'create'])->name('trips.create');
    Route::post('trip/save', [TripController::class, 'store'])->name('trips.store');
    Route::get('trip/{id}/edit', [TripController::class, 'edit'])->name('trips.edit');
    Route::post('trip/update', [TripController::class, 'update'])->name('trips.update');
    Route::post('trip/inactive', [TripController::class, 'inactive'])->name('trips.inactive');
    Route::post('trip/active', [TripController::class, 'active'])->name('trips.active');
    Route::post('trip/destroy', [TripController::class, 'destroy'])->name('trips.destroy');

});
