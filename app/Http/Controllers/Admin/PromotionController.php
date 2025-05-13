<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Promotion;
use App\Models\Designation;

class PromotionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:promotion-list|promotion-create|promotion-edit|promotion-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:promotion-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:promotion-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:promotion-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Promotion::orderBy('id', 'asc');
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('employee', function ($row) {
                    return $row->employee->name ?? 'N/A';
                })
                ->addColumn('designation', function ($row) {
                    return $row->designation->name ?? 'N/A';
                })
                ->addColumn('date', function ($row) {
                    return $row->promotion_date ? Carbon::parse($row->promotion_date)->format('Y-m-d') : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    $editBtn = '<a class="edit_btn" href="' . route('promotions.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';
                    $deleteBtn = '<form method="POST" action="' . route('promotions.destroy') . '" class="delete_form" style="display:inline;">
                                  ' . csrf_field() . '
                                  <input type="hidden" name="id" value="' . $row->id . '">
                                  <button type="button" class="delete_btn"><i class="ti ti-trash"></i></button>
                               </form>';
                    return '<div class="action-buttons">' . $editBtn . ' ' . $deleteBtn . '</div>';
                })

                ->rawColumns(['action'])
                ->toJson();
        }
        return view('backEnd.promotion.index');
    }

    public function create()
    {
        $employees = Employee::select('id', 'employee_id', 'name')->get();
        $designations = Designation::select('id', 'name')->get();
        return view('backEnd.promotion.create', compact('employees', 'designations'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Promotion::create($input);
        $input['status'] = $request->status ?? 0;
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('promotions.index');
    }

    public function edit($id)
    {
        $edit_data = Promotion::findOrFail($id);
        $employees = Employee::select('id', 'employee_id', 'name')->get();
        $designations = Designation::select('id', 'name')->get();
        return view('backEnd.promotion.edit', compact('edit_data', 'employees', 'designations'));
    }

    public function update(Request $request)
    {
        $companypolicy = Promotion::findOrFail($request->id);
        $input = $request->all();
        $companypolicy->update($input);
        Toastr::success('Success', 'Data updatetd successfully');
        return redirect()->route('promotions.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Promotion::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Promotion::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $delete_data = Promotion::find($request->id);
        File::delete($delete_data->image);
        Toastr::success('Success', 'Data delete successfully');
        $delete_data->delete();
    }

}
