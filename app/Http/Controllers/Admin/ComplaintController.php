<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Complaint;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class ComplaintController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:complaint-list|complaint-create|complaint-edit|complaint-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:complaint-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:complaint-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:complaint-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Complaint::orderBy('id', 'asc');
        // return $data->get();
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('from', function ($row) {
                    return $row->from->name ?? 'N/A';
                })
                ->addColumn('against', function ($row) {
                    return $row->against->name ?? 'N/A';
                })
                ->addColumn('date', function ($row) {
                    return $row->date ? Carbon::parse($row->date)->format('Y-m-d') : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    $editBtn = '<a class="edit_btn" href="' . route('complaints.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';
                    $deleteBtn = '<form method="POST" action="' . route('complaints.destroy') . '" class="delete_form" style="display:inline;">
                                  ' . csrf_field() . '
                                  <input type="hidden" name="id" value="' . $row->id . '">
                                  <button type="button" class="delete_btn"><i class="ti ti-trash"></i></button>
                               </form>';
                    return '<div class="action-buttons">' . $editBtn . ' ' . $deleteBtn . '</div>';
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('backEnd.complaint.index');
    }

    public function create()
    {
        $employees = Employee::select('id', 'employee_id', 'name')->get();
        return view('backEnd.complaint.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Complaint::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('complaints.index');
    }

    public function edit($id)
    {
        $edit_data = Complaint::findOrFail($id);
        $employees = Employee::select('id', 'employee_id', 'name')->get();
        return view('backEnd.complaint.edit', compact('edit_data', 'employees'));
    }

    public function update(Request $request)
    {
        $companypolicy = Complaint::findOrFail($request->id);
        $input = $request->all();
        $companypolicy->update($input);
        Toastr::success('Success', 'Data updatetd successfully');
        return redirect()->route('complaints.index');
    }



    public function destroy(Request $request)
    {
        $delete_data = Complaint::find($request->id);
        File::delete($delete_data->image);
        Toastr::success('Success', 'Data delete successfully');
        $delete_data->delete();
    }

}
