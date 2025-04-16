<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainingType;
use Toastr;
class TrainingTypeController extends Controller
{
     public function __construct()
    {
        $this->middleware('permission:trainingtype-list|trainingtype-create|trainingtype-edit|trainingtype-delete', ['only' => ['index','store']]);
        $this->middleware('permission:trainingtype-create', ['only' => ['create','store']]);
        $this->middleware('permission:trainingtype-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:trainingtype-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = TrainingType::orderBy('id','DESC')->get();
        if($request->ajax()){
            return datatables()->of($data)
            ->addColumn('action', function($row) {
                $statusBtn = $row->status == 1 ?
                    '<form method="POST" action="'.route('trainingtypes.inactive').'" class="status_form" style="display:inline;">
                        '.csrf_field().'
                        <input type="hidden" name="id" value="'.$row->id.'">
                        <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                    </form>'
                    :
                    '<form method="POST" action="'.route('trainingtypes.active').'" class="status_form" style="display:inline;">
                        '.csrf_field().'
                        <input type="hidden" name="id" value="'.$row->id.'">
                        <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                    </form>';
                $editBtn = '<a class="edit_btn" href="' . route('trainingtypes.edit', $row->id) . '">
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

        return view('backEnd.trainingtype.index');
    }

    public function create(){
        return view('backEnd.trainingtype.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required']);
        $input = $request->all();
        $input['status'] = $request->has('status') ? 1 : 0;
        TrainingType::create($input);
        Toastr::success('Success','Data store successfully');
        return redirect()->route('trainingtypes.index');
    }

    public function edit($id)
    {
        $edit_data = TrainingType::find($id);
        return view('backEnd.trainingtype.edit',compact('edit_data'));
    }

    public function update(Request $request)
    {
        $this->validate($request, ['name' => 'required']);
        $input = $request->all();
        $input['status'] = $request->has('status') ? 1 : 0;
        $update_data = TrainingType::find($request->id);
        $update_data->update($input);
        Toastr::success('Success','Data update successfully');
        return redirect()->route('trainingtypes.index');
    }

    public function inactive(Request $request)
    {
        $inactive = TrainingType::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success','Data inactive successfully');
        return redirect()->back();
    }

    public function active(Request $request)
    {
        $active = TrainingType::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success','Data active successfully');
        return redirect()->back();
    }
}
