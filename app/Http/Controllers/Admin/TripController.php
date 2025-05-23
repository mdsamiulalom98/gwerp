<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Trip;

class TripController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:trip-list|trip-create|trip-edit|trip-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:trip-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:trip-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:trip-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $data = Trip::orderBy('id', 'asc');
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('employee', function ($row) {
                    return $row->employee->name ?? 'N/A';
                })
                ->addColumn('start_date', function ($row) {
                    return $row->start_date ? Carbon::parse($row->start_date)->format('Y-m-d') : 'N/A';
                })
                ->addColumn('end_date', function ($row) {
                    return $row->end_date ? Carbon::parse($row->end_date)->format('Y-m-d') : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    $editBtn = '<a class="edit_btn" href="' . route('trips.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';
                    $deleteBtn = '<form method="POST" action="' . route('trips.destroy') . '" class="delete_form" style="display:inline;">
                                  ' . csrf_field() . '
                                  <input type="hidden" name="id" value="' . $row->id . '">
                                  <button type="button" class="delete_btn"><i class="ti ti-trash"></i></button>
                               </form>';
                    return '<div class="action-buttons">' . $editBtn . ' ' . $deleteBtn . '</div>';
                })
                ->rawColumns(['status', 'action'])
                ->toJson();
        }
        return view('backEnd.trip.index');
    }

    public function create()
    {
        $employees = Employee::select('id', 'employee_id', 'name')->get();
        return view('backEnd.trip.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        // return $input;
        Trip::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('trips.index');
    }

    public function edit($id)
    {
        $edit_data = Trip::findOrFail($id);
        $employees = Employee::select('id', 'employee_id', 'name')->get();
        return view('backEnd.trip.edit', compact('edit_data', 'employees'));
    }

    public function update(Request $request)
    {
        $companypolicy = Trip::findOrFail($request->id);
        $input = $request->all();
        $companypolicy->update($input);
        Toastr::success('Success', 'Data updatetd successfully');
        return redirect()->route('trips.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Trip::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Trip::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $delete_data = Trip::find($request->id);
        File::delete($delete_data->image);
        Toastr::success('Success', 'Data delete successfully');
        $delete_data->delete();
    }
}
