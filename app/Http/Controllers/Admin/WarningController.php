<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use App\Models\Warning;
use App\Models\Employee;

class WarningController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:warning-list|warning-create|warning-edit|warning-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:warning-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:warning-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:warning-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $data = Warning::orderBy('id', 'asc');
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('warningTo', function ($row) {
                    return $row->warningTo->name ?? 'N/A';
                })
                ->addColumn('warningBy', function ($row) {
                    return $row->warningBy->name ?? 'N/A';
                })
                ->addColumn('date', function ($row) {
                    return $row->date ? Carbon::parse($row->date)->format('Y-m-d') : 'N/A';
                })
                ->addColumn('action', function ($row) {

                    $editBtn = '<a class="edit_btn" href="' . route('warnings.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';
                    $deleteBtn = '<form method="POST" action="' . route('warnings.destroy') . '" class="delete_form" style="display:inline;">
                                  ' . csrf_field() . '
                                  <input type="hidden" name="id" value="' . $row->id . '">
                                  <button type="button" class="delete_btn"><i class="ti ti-trash"></i></button>
                               </form>';
                    return '<div class="action-buttons">' . $editBtn . ' ' . $deleteBtn . '</div>';
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
        return view('backEnd.warning.index');
    }

    public function create()
    {
        $employees = Employee::select('id', 'employee_id', 'name')->get();
        return view('backEnd.warning.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Warning::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('warnings.index');
    }

    public function edit($id)
    {
        $edit_data = Warning::findOrFail($id);
        $employees = Employee::select('id', 'employee_id', 'name')->get();
        return view('backEnd.warning.edit', compact('edit_data', 'employees'));
    }

    public function update(Request $request)
    {
        $companypolicy = Warning::findOrFail($request->id);
        $input = $request->all();
        $companypolicy->update($input);
        Toastr::success('Success', 'Data updatetd successfully');
        return redirect()->route('warnings.index');
    }


    public function destroy(Request $request)
    {
        $delete_data = Warning::find($request->id);
        File::delete($delete_data->image);
        Toastr::success('Success', 'Data delete successfully');
        $delete_data->delete();
    }

}
