<?php

namespace App\Http\Controllers\Admin;

use App\Models\Branch;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Encoders\WebpEncoder;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Employee;
use App\Models\Company;
use App\Models\Department;
use App\Models\Designation;
use Image;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:employee-list|employee-create|employee-edit|employee-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:employee-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:employee-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:employee-delete', ['only' => ['destroy']]);
    }
    public function getBranch(Request $request)
    {
        $branches = DB::table("branches")
            ->where("company_id", $request->company_id)
            ->pluck('name', 'id');
        return response()->json($branches);
    }
    public function index(Request $request)
    {
        // Your logic to fetch and display employees
        $data = Employee::orderBy('id', 'asc');
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('employee_id', function ($row) {
                    $employee_id = '<a class="btn btn-outline-primary" href="' . route('employees.show', $row->id) .
                        '">' . $row->employee_id . '</a>';

                    return $employee_id;
                })
                ->addColumn('designation', function ($row) {
                    return $row->designation->name ?? 'N/A';
                })
                ->addColumn('department', function ($row) {
                    return $row->department->name ?? 'N/A';
                })
                ->addColumn('branch', function ($row) {
                    return $row->branch->name ?? 'N/A';
                })
                ->addColumn('joining_date', function ($row) {
                    return $row->joining_date ? date('d-m-Y', strtotime($row->joining_date)) : '';
                })
                ->addColumn('action', function ($row) {
                    $viewBtn = '<a class="view_btn" href="' . route('employees.show', $row->id) . '">
                               <i class="ti ti-eye"></i>
                            </a>';
                    $editBtn = '<a class="edit_btn" href="' . route('employees.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';
                    $deleteBtn = '<form method="POST" action="' . route('employees.destroy') . '" class="delete_form" style="display:inline;">
                                  ' . csrf_field() . '
                                  <input type="hidden" name="id" value="' . $row->id . '">
                                  <button type="button" class="delete_btn"><i class="ti ti-trash"></i></button>
                               </form>';
                    return '<div class="action-buttons">' . $viewBtn . ' ' . $editBtn . ' ' . $deleteBtn . '</div>';
                })
                ->rawColumns(['employee_id', 'status', 'action'])
                ->toJson();
        }
        return view('backEnd.employee.index');
    }

    public function create()
    {
        // Your logic to show the employee creation form
        $employeeId = $this->generateEmployeeId();
        $companies = Company::where('status', 1)->get();
        $departments = Department::where('status', 1)->get();
        $designations = Designation::where('status', 1)->get();
        return view('backEnd.employee.create', compact('employeeId', 'companies', 'departments', 'designations'));
    }

    public function store(Request $request)
    {
        // Your logic to store a new employee
        $input = $request->all();
        // certificate upload
        $certificate = $request->file('certificate');
        if ($certificate) {
            $filename = time() . '.' . $certificate->getClientOriginalExtension();
            $image = Image::read($certificate);
            $uploadpath = 'public/uploads/employee/';
            $imageUrl = $uploadpath . $filename;
            $image->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->encode(new WebpEncoder(quality: 80))
                ->save($imageUrl);
        }

        // certificate upload
        $photo = $request->file('photo');
        if ($photo) {
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $image = Image::read($photo);
            $uploadpath = 'public/uploads/employee/';
            $imageUrl2 = $uploadpath . $filename;
            $image->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->encode(new WebpEncoder(quality: 80))
                ->save($imageUrl2);
        }

        // certificate upload
        $result = $request->file('result');
        if ($result) {
            $filename = time() . '.' . $result->getClientOriginalExtension();
            $image = Image::read($result);
            $uploadpath = 'public/uploads/employee/';
            $imageUrl3 = $uploadpath . $filename;
            $image->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->encode(new WebpEncoder(quality: 80))
                ->save($imageUrl3);
        }

        // certificate upload
        $cv = $request->file('cv');
        if ($cv) {
            $filename = time() . '.' . $cv->getClientOriginalExtension();
            $image = Image::read($cv);
            $uploadpath = 'public/uploads/employee/';
            $imageUrl4 = $uploadpath . $filename;
            $image->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->encode(new WebpEncoder(quality: 80))
                ->save($imageUrl4);
        }
        $input['employee_id'] = $this->generateEmployeeId();
        $input['password'] = Hash::make($input['password']);
        $input['certificate'] = $imageUrl;
        $input['photo'] = $imageUrl2;
        $input['result'] = $imageUrl3;
        $input['cv'] = $imageUrl4;
        Employee::create($input);
        Toastr::success('Employee created successfully', 'Success');
        return redirect()->route('employees.index');
    }

    public function edit($id)
    {
        // Your logic to show the employee edit form
        $edit_data = Employee::findOrFail($id);
        $employeeId = $this->generateEmployeeId();
        $companies = Company::where('status', 1)->get();
        $departments = Department::where('status', 1)->get();
        $designations = Designation::where('status', 1)->get();
        $branches = Branch::where('status', 1)
            ->where("company_id", $edit_data->company_id)
            ->get();
        return view('backEnd.employee.edit', compact('edit_data', 'employeeId', 'companies', 'departments', 'designations', 'branches'));
    }

    public function update(Request $request)
    {
        // Your logic to update an existing employee
        $employee = Employee::findOrFail($request->hidden_id);
        $input = $request->except('hidden_id');

        // certificate upload
        $certificate = $request->file('certificate');
        if ($certificate) {
            $filename = time() . '.' . $certificate->getClientOriginalExtension();
            $image = Image::read($certificate);
            $uploadpath = 'public/uploads/employee/';
            $imageUrl = $uploadpath . $filename;
            $image->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->encode(new WebpEncoder(quality: 80))
                ->save($imageUrl);
            $input['certificate'] = $imageUrl;
        } else {
            $imageUrl = $employee->certificate;
        }

        // certificate upload
        $photo = $request->file('photo');
        if ($photo) {
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $image = Image::read($photo);
            $uploadpath = 'public/uploads/employee/';
            $imageUrl2 = $uploadpath . $filename;
            $image->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->encode(new WebpEncoder(quality: 80))
                ->save($imageUrl2);
            $input['photo'] = $imageUrl2;
        } else {
            $imageUrl2 = $employee->photo;
        }

        // certificate upload
        $result = $request->file('result');
        if ($result) {
            $filename = time() . '.' . $result->getClientOriginalExtension();
            $image = Image::read($result);
            $uploadpath = 'public/uploads/employee/';
            $imageUrl3 = $uploadpath . $filename;
            $image->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->encode(new WebpEncoder(quality: 80))
                ->save($imageUrl3);
            $input['result'] = $imageUrl3;
        } else {
            $imageUrl3 = $employee->result;
        }

        // certificate upload
        $cv = $request->file('cv');
        if ($cv) {
            $filename = time() . '.' . $cv->getClientOriginalExtension();
            $image = Image::read($cv);
            $uploadpath = 'public/uploads/employee/';
            $imageUrl4 = $uploadpath . $filename;
            $image->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->encode(new WebpEncoder(quality: 80))
                ->save($imageUrl4);
            $input['cv'] = $imageUrl4;
        } else {
            $imageUrl4 = $employee->cv;
        }
        $employee->update($input);
        Toastr::success('Employee updated successfully', 'Success');
        return redirect()->route('employees.index');
    }

    public function destroy($id)
    {
        // Your logic to delete an employee
    }

    function generateEmployeeId()
    {
        $last = Employee::orderByDesc('id')->first();
        if ($last && preg_match('/EMP(\d+)/', $last->employee_id, $matches)) {
            $next = (int) $matches[1] + 1;
        } else {
            $next = 1;
        }

        return '#EMP' . str_pad($next, 5, '0', STR_PAD_LEFT);
    }

}
