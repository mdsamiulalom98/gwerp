<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TerminationType;
use Toastr;
class TerminationTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:terminationtype-list|terminationtype-create|terminationtype-edit|terminationtype-delete', ['only' => ['index','store']]);
        $this->middleware('permission:terminationtype-create', ['only' => ['create','store']]);
        $this->middleware('permission:terminationtype-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:terminationtype-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = TerminationType::orderBy('id','DESC')->get();
        if($request->ajax()){
            return datatables()->of($data)
            ->addColumn('action', function($row) {
                $statusBtn = $row->status == 1 ?
                    '<form method="POST" action="'.route('terminationtypes.inactive').'" class="status_form" style="display:inline;">
                        '.csrf_field().'
                        <input type="hidden" name="id" value="'.$row->id.'">
                        <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                    </form>'
                    :
                    '<form method="POST" action="'.route('terminationtypes.active').'" class="status_form" style="display:inline;">
                        '.csrf_field().'
                        <input type="hidden" name="id" value="'.$row->id.'">
                        <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                    </form>';
                $editBtn = '<a class="edit_btn" href="' . route('terminationtypes.edit', $row->id) . '">
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

        return view('backEnd.terminationtype.index');
    }

    public function create(){
        return view('backEnd.terminationtype.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required']);
        $input = $request->all();
        $input['status'] = $request->has('status') ? 1 : 0;
        TerminationType::create($input);
        Toastr::success('Success','Data store successfully');
        return redirect()->route('terminationtypes.index');
    }

    public function edit($id)
    {
        $edit_data = TerminationType::find($id);
        return view('backEnd.terminationtype.edit',compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, ['name' => 'required']);
        $input = $request->all();
        $input['status'] = $request->has('status') ? 1 : 0;
        $update_data = TerminationType::find($request->id);
        $update_data->update($input);
        Toastr::success('Success','Data update successfully');
        return redirect()->route('terminationtypes.index');
    }

    public function inactive(Request $request)
    {
        $inactive = TerminationType::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }

    public function active(Request $request)
    {
        $active = TerminationType::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
}
