<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PayslipType;
use Toastr;
class PayslipTypeController extends Controller
{
     public function __construct()
    {
        $this->middleware('permission:paysliptype-list|paysliptype-create|paysliptype-edit|paysliptype-delete', ['only' => ['index','store']]);
        $this->middleware('permission:paysliptype-create', ['only' => ['create','store']]);
        $this->middleware('permission:paysliptype-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:paysliptype-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = PayslipType::orderBy('id','DESC')->get();
        if($request->ajax()){
            return datatables()->of($data)
            ->addColumn('action', function($row) {
                $statusBtn = $row->status == 1 ?
                    '<form method="POST" action="'.route('paysliptypes.inactive').'" class="status_form" style="display:inline;">
                        '.csrf_field().'
                        <input type="hidden" name="id" value="'.$row->id.'">
                        <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                    </form>'
                    :
                    '<form method="POST" action="'.route('paysliptypes.active').'" class="status_form" style="display:inline;">
                        '.csrf_field().'
                        <input type="hidden" name="id" value="'.$row->id.'">
                        <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                    </form>';
                $editBtn = '<a class="edit_btn" href="' . route('paysliptypes.edit', $row->id) . '">
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

        return view('backEnd.paysliptype.index');
    }

    public function create(){
        return view('backEnd.paysliptype.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required']);
        $input = $request->all();
        $input['status'] = $request->has('status') ? 1 : 0;
        PayslipType::create($input);
        Toastr::success('Success','Data store successfully');
        return redirect()->route('paysliptypes.index');
    }

    public function edit($id)
    {
        $edit_data = PayslipType::find($id);
        return view('backEnd.paysliptype.edit',compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, ['name' => 'required']);
        $input = $request->all();
        $input['status'] = $request->has('status') ? 1 : 0;
        $update_data = PayslipType::find($request->id);
        $update_data->update($input);
        Toastr::success('Success','Data update successfully');
        return redirect()->route('paysliptypes.index');
    }

    public function inactive(Request $request)
    {
        $inactive = PayslipType::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }

    public function active(Request $request)
    {
        $active = PayslipType::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
}
