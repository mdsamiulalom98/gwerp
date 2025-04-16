<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoanOption;
use Toastr;

class LoanOptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:loanoption-list|loanoption-create|loanoption-edit|loanoption-delete', ['only' => ['index','store']]);
        $this->middleware('permission:loanoption-create', ['only' => ['create','store']]);
        $this->middleware('permission:loanoption-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:loanoption-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = LoanOption::orderBy('id','DESC')->get();
        if($request->ajax()){
            return datatables()->of($data)
            ->addColumn('action', function($row) {
                $statusBtn = $row->status == 1 ?
                    '<form method="POST" action="'.route('loanoptions.inactive').'" class="status_form" style="display:inline;">
                        '.csrf_field().'
                        <input type="hidden" name="id" value="'.$row->id.'">
                        <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                    </form>'
                    :
                    '<form method="POST" action="'.route('loanoptions.active').'" class="status_form" style="display:inline;">
                        '.csrf_field().'
                        <input type="hidden" name="id" value="'.$row->id.'">
                        <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                    </form>';
                $editBtn = '<a class="edit_btn" href="' . route('loanoptions.edit', $row->id) . '">
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

        return view('backEnd.loanoption.index');
    }

    public function create(){
        return view('backEnd.loanoption.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required']);
        $input = $request->all();
        $input['status'] = $request->has('status') ? 1 : 0;
        LoanOption::create($input);
        Toastr::success('Success','Data store successfully');
        return redirect()->route('loanoptions.index');
    }

    public function edit($id)
    {
        $edit_data = LoanOption::find($id);
        return view('backEnd.loanoption.edit',compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, ['name' => 'required']);
        $input = $request->all();
        $input['status'] = $request->has('status') ? 1 : 0;
        $update_data = LoanOption::find($request->id);
        $update_data->update($input);
        Toastr::success('Success','Data update successfully');
        return redirect()->route('loanoptions.index');
    }

    public function inactive(Request $request)
    {
        $inactive = LoanOption::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }

    public function active(Request $request)
    {
        $active = LoanOption::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
}
