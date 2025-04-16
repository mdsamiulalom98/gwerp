<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoalType;
use Toastr;
class GoalTypeController extends Controller
{
     public function __construct()
    {
        $this->middleware('permission:goaltype-list|goaltype-create|goaltype-edit|goaltype-delete', ['only' => ['index','store']]);
        $this->middleware('permission:goaltype-create', ['only' => ['create','store']]);
        $this->middleware('permission:goaltype-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:goaltype-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = GoalType::orderBy('id','DESC')->get();
        if($request->ajax()){
            return datatables()->of($data)
            ->addColumn('action', function($row) {
                $statusBtn = $row->status == 1 ?
                    '<form method="POST" action="'.route('goaltypes.inactive').'" class="status_form" style="display:inline;">
                        '.csrf_field().'
                        <input type="hidden" name="id" value="'.$row->id.'">
                        <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                    </form>'
                    :
                    '<form method="POST" action="'.route('goaltypes.active').'" class="status_form" style="display:inline;">
                        '.csrf_field().'
                        <input type="hidden" name="id" value="'.$row->id.'">
                        <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                    </form>';
                $editBtn = '<a class="edit_btn" href="' . route('goaltypes.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';
                return $statusBtn . ' ' . $editBtn;
            })
            ->addColumn('status', function($row) {
                return $row->status == 1
                    ? '<span class="active_btn">Active</span>'
                    : '<span class="inactive_btn">Inactive</span>';
            })
            ->rawColumns(['status','action'])
            ->toJson();
        }

        return view('backEnd.goaltype.index');
    }

    public function create(){
        return view('backEnd.goaltype.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required']);
        $input = $request->all();
        $input['status'] = $request->has('status') ? 1 : 0;
        GoalType::create($input);
        Toastr::success('Success','Data store successfully');
        return redirect()->route('goaltypes.index');
    }

    public function edit($id)
    {
        $edit_data = GoalType::find($id);
        return view('backEnd.goaltype.edit',compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, ['name' => 'required']);
        $input = $request->all();
        $input['status'] = $request->has('status') ? 1 : 0;
        $update_data = GoalType::find($request->id);
        $update_data->update($input);
        Toastr::success('Success','Data update successfully');
        return redirect()->route('goaltypes.index');
    }

    public function inactive(Request $request)
    {
        $inactive = GoalType::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }

    public function active(Request $request)
    {
        $active = GoalType::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
}
