<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeductionOption;
use Toastr;
class DeductionOptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:deductionoption-list|deductionoption-create|deductionoption-edit|deductionoption-delete', ['only' => ['index','store']]);
        $this->middleware('permission:deductionoption-create', ['only' => ['create','store']]);
        $this->middleware('permission:deductionoption-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:deductionoption-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = DeductionOption::orderBy('id','DESC')->get();
        if($request->ajax()){
            return datatables()->of($data)
            ->addColumn('action', function($row) {
                $statusBtn = $row->status == 1 ?
                    '<form method="POST" action="'.route('deductionoptions.inactive').'" class="status_form" style="display:inline;">
                        '.csrf_field().'
                        <input type="hidden" name="id" value="'.$row->id.'">
                        <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                    </form>'
                    :
                    '<form method="POST" action="'.route('deductionoptions.active').'" class="status_form" style="display:inline;">
                        '.csrf_field().'
                        <input type="hidden" name="id" value="'.$row->id.'">
                        <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                    </form>';
                $editBtn = '<a class="edit_btn" href="' . route('deductionoptions.edit', $row->id) . '">
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

        return view('backEnd.deductionoption.index');
    }

    public function create(){
        return view('backEnd.deductionoption.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required']);
        $input = $request->all();
        $input['status'] = $request->has('status') ? 1 : 0;
        DeductionOption::create($input);
        Toastr::success('Success','Data store successfully');
        return redirect()->route('deductionoptions.index');
    }

    public function edit($id)
    {
        $edit_data = DeductionOption::find($id);
        return view('backEnd.deductionoption.edit',compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, ['name' => 'required']);
        $input = $request->all();
        $input['status'] = $request->has('status') ? 1 : 0;
        $update_data = DeductionOption::find($request->id);
        $update_data->update($input);
        Toastr::success('Success','Data update successfully');
        return redirect()->route('deductionoptions.index');
    }

    public function inactive(Request $request)
    {
        $inactive = DeductionOption::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }

    public function active(Request $request)
    {
        $active = DeductionOption::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
}
