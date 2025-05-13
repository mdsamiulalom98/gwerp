<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use App\Models\Termination;
use App\Models\Employee;
use App\Models\TerminationType;

class TerminationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:termination-list|termination-create|termination-edit|termination-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:termination-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:termination-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:termination-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Termination::orderBy('id', 'asc');
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('employee', function ($row) {
                    return $row->employee->name ?? 'N/A';
                })
                ->addColumn('termination', function ($row) {
                    return $row->terminationType->name ?? 'N/A';
                })
                ->addColumn('notice_date', function ($row) {
                    return $row->notice_date ? Carbon::parse($row->notice_date)->format('Y-m-d') : 'N/A';
                })
                ->addColumn('termination_date', function ($row) {
                    return $row->termination_date ? Carbon::parse($row->termination_date)->format('Y-m-d') : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    $editBtn = '<a class="edit_btn" href="' . route('terminations.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';
                    $deleteBtn = '<form method="POST" action="' . route('terminations.destroy') . '" class="delete_form" style="display:inline;">
                                  ' . csrf_field() . '
                                  <input type="hidden" name="id" value="' . $row->id . '">
                                  <button type="button" class="delete_btn"><i class="ti ti-trash"></i></button>
                               </form>';
                    return '<div class="action-buttons">' . $editBtn . ' ' . $deleteBtn . '</div>';
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('backEnd.termination.index');
    }

    public function create()
    {
        $employees = Employee::select('id', 'employee_id', 'name')->get();
        $termination_types = TerminationType::where('status', 1)->get();
        return view('backEnd.termination.create', compact('employees', 'termination_types'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Termination::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('terminations.index');
    }

    public function edit($id)
    {
        $edit_data = Termination::findOrFail($id);
        $employees = Employee::select('id', 'employee_id', 'name')->get();
        $termination_types = TerminationType::where('status', 1)->get();
        return view('backEnd.termination.edit', compact('edit_data', 'employees', 'termination_types'));
    }

    public function update(Request $request)
    {
        $companypolicy = Termination::findOrFail($request->id);
        $input = $request->all();
        $companypolicy->update($input);
        Toastr::success('Success', 'Data updatetd successfully');
        return redirect()->route('terminations.index');
    }




    public function destroy(Request $request)
    {
        $delete_data = Termination::find($request->id);
        File::delete($delete_data->image);
        Toastr::success('Success', 'Data delete successfully');
        $delete_data->delete();
    }

}
