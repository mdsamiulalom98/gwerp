<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TripController extends Controller
{
     public function __construct()
    {
        $this->middleware('permission:trip-list|trip-create|trip-edit|trip-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:trip-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:trip-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:trip-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request){
        $data = Trip::orderBy('id', 'asc');
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('employee', function ($row) {
                    return $row->employee->name ?? 'N/A';
                })
                ->addColumn('awardtype', function ($row) {
                    return $row->awardtype->name ?? 'N/A';
                })
                ->addColumn('action', function ($row) {
                    if($row->status == 1) {
                        $statusBtn = '<form method="POST" action="' . route('atripsinactive') . '" class="status_form" style="display:inline;">
                                      ' . csrf_field() . '
                                      <input type="hidden" name="id" value="' . $row->id . '">
                                      <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                                   </form>';
                    } else {
                        $statusBtn = '<form method="POST" action="' . route('trips.active') . '" class="status_form" style="display:inline;">
                                      ' . csrf_field() . '
                                      <input type="hidden" name="id" value="' . $row->id . '">
                                      <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                                   </form>';
                    }
                    $editBtn = '<a class="edit_btn" href="' . route('trips.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';
                    $deleteBtn = '<form method="POST" action="' . route('trips.destroy') . '" class="delete_form" style="display:inline;">
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
        return view('backEnd.trip.index');
    }

    public function create(){
        $employees = Employee::select('id','employee_id','name')->get();
        return view('backEnd.trip.create',compact('employees'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Trip::create($input);
        $input['status'] = $request->status ?? 0;
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('trips.index');
    }

    public function edit($id){
        $edit_data = Trip::findOrFail($id);
        $employees = Employee::select('id','employee_id','name')->get();
        return view('backEnd.trip.edit', compact('edit_data','employees'));
    }

    public function update(Request $request){
        $companypolicy = Trip::findOrFail($request->id);
        $input = $request->all();
        $input['status'] = $request->status ?? 0;
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

    public function destroy($id){
        $delete_data = Trip::find($request->id);
        File::delete($delete_data->image);
        Toastr::success('Success', 'Data delete successfully');
        $delete_data->delete();
    }
}
