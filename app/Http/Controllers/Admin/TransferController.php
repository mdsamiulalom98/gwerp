<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Employee;
use App\Models\Company;
use App\Models\Department;
use App\Models\Transfer;
use App\Models\Branch;
class TransferController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:transfer-list|transfer-create|transfer-edit|transfer-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:transfer-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:transfer-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:transfer-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request){
        $data = Transfer::orderBy('id', 'asc');
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('employee', function ($row) {
                    return $row->employee->name ?? 'N/A';
                })
                ->addColumn('company', function ($row) {
                    return $row->company->name ?? 'N/A';
                })
                ->addColumn('branch', function ($row) {
                    return $row->branch->name ?? 'N/A';
                })
                ->addColumn('action', function ($row) {
                    if($row->status == 1) {
                        $statusBtn = '<form method="POST" action="' . route('transfers.inactive') . '" class="status_form" style="display:inline;">
                                      ' . csrf_field() . '
                                      <input type="hidden" name="id" value="' . $row->id . '">
                                      <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                                   </form>';
                    } else {
                        $statusBtn = '<form method="POST" action="' . route('transfers.active') . '" class="status_form" style="display:inline;">
                                      ' . csrf_field() . '
                                      <input type="hidden" name="id" value="' . $row->id . '">
                                      <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                                   </form>';
                    }
                    $editBtn = '<a class="edit_btn" href="' . route('transfers.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';
                    $deleteBtn = '<form method="POST" action="' . route('transfers.destroy') . '" class="delete_form" style="display:inline;">
                                  ' . csrf_field() . '
                                  <input type="hidden" name="id" value="' . $row->id . '">
                                  <button type="button" class="delete_btn"><i class="ti ti-trash"></i></button>
                               </form>';
                    return '<div class="action-buttons">' . $statusBtn . ' ' . $editBtn . ' ' . $deleteBtn . '</div>';
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        $statusBtn = '<span class="active_btn">Active</span>';
                    } else {
                        $statusBtn = '<span class="inactive_btn">Inactive</span>';
                    }
                    return $statusBtn;
                })
                ->rawColumns(['status', 'action']) 
                ->toJson();
        }
        return view('backEnd.transfer.index');
    }

    public function create(){
        $employees = Employee::select('id','employee_id','name')->get();
        $companies = Company::where('status', 1)->get();
        $departments = Department::where('status', 1)->get();
        return view('backEnd.transfer.create',compact('employees','companies','departments'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Transfer::create($input);
        $input['status'] = $request->status ?? 0;
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('transfers.index');
    }

    public function edit($id){
        $edit_data = Transfer::findOrFail($id);
        $employees = Employee::select('id','employee_id','name')->get();
        $companies = Company::where('status', 1)->get();
        $departments = Department::where('status', 1)->get();
        $branches = Branch::where(['status'=>1,'company_id'=>$edit_data->company_id])->get();
        return view('backEnd.transfer.edit', compact('edit_data','employees','companies','departments','branches'));
    }

    public function update(Request $request){
        $companypolicy = Transfer::findOrFail($request->id);
        $input = $request->all();
        $input['status'] = $request->status ?? 0;
        $companypolicy->update($input);
        Toastr::success('Success', 'Data updatetd successfully');
        return redirect()->route('transfers.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Transfer::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Transfer::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }

    public function destroy($id){
        $delete_data = Transfer::find($request->id);
        File::delete($delete_data->image);
        Toastr::success('Success', 'Data delete successfully');
        $delete_data->delete();
    }
}
