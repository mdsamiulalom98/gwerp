<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Employee;
use App\Models\AwardType;
use App\Models\Award;
class AwardController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:award-list|award-create|award-edit|award-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:award-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:award-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:award-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request){
        $data = Award::orderBy('id', 'asc');
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
                        $statusBtn = '<form method="POST" action="' . route('awards.inactive') . '" class="status_form" style="display:inline;">
                                      ' . csrf_field() . '
                                      <input type="hidden" name="id" value="' . $row->id . '">
                                      <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                                   </form>';
                    } else {
                        $statusBtn = '<form method="POST" action="' . route('awards.active') . '" class="status_form" style="display:inline;">
                                      ' . csrf_field() . '
                                      <input type="hidden" name="id" value="' . $row->id . '">
                                      <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                                   </form>';
                    }
                    $editBtn = '<a class="edit_btn" href="' . route('awards.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';
                    $deleteBtn = '<form method="POST" action="' . route('awards.destroy') . '" class="delete_form" style="display:inline;">
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
        return view('backEnd.award.index');
    }

    public function create(){
        $employees = Employee::select('id','employee_id','name')->get();
        $awardtypes = AwardType::where('status',1)->get();
        return view('backEnd.award.create',compact('employees','awardtypes'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Award::create($input);
        $input['status'] = $request->status ?? 0;
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('awards.index');
    }

    public function edit($id){
        $edit_data = Award::findOrFail($id);
        $employees = Employee::select('id','employee_id','name')->get();
        $awardtypes = AwardType::where('status',1)->get();
        return view('backEnd.award.edit', compact('edit_data','employees','awardtypes'));
    }

    public function update(Request $request){
        $companypolicy = Award::findOrFail($request->id);
        $input = $request->all();
        $input['status'] = $request->status ?? 0;
        $companypolicy->update($input);
        Toastr::success('Success', 'Data updatetd successfully');
        return redirect()->route('awards.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Award::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Award::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }

    public function destroy($id){
        $delete_data = Award::find($request->id);
        File::delete($delete_data->image);
        Toastr::success('Success', 'Data delete successfully');
        $delete_data->delete();
    }
}
