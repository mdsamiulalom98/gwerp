<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\AllowanceTypeController;
use App\Http\Controllers\Admin\LoanOptionController;
use App\Http\Controllers\Admin\DeductionOptionController;
use App\Http\Controllers\Admin\DocumentTypeController;
use App\Http\Controllers\Admin\PayslipTypeController;
use App\Http\Controllers\Admin\LeaveTypeController;
use App\Http\Controllers\Admin\AwardTypeController;
use App\Http\Controllers\Admin\TerminationTypeController;
use App\Http\Controllers\Admin\PerformanceTypeController;
use App\Http\Controllers\Admin\CompetenceController;
use App\Http\Controllers\Admin\GoalTypeController;
use App\Http\Controllers\Admin\TrainingTypeController;

Auth::routes();

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
});
