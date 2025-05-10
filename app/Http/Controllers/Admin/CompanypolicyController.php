<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Encoders\WebpEncoder;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Company;
use App\Models\Department;
use App\Models\Designation;
use App\Models\CompanyPolicy;
use App\Models\Branch;
use Image;

class CompanypolicyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:companypolicy-list|companypolicy-create|companypolicy-edit|companypolicy-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:companypolicy-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:companypolicy-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:companypolicy-delete', ['only' => ['destroy']]);
    }
    public function getBranch(Request $request)
    {
        $branches = DB::table("branches")
            ->where("company_id", $request->company_id)
            ->pluck('name', 'id');
        return response()->json($branches);
    }
    public function index(Request $request){
        $data = CompanyPolicy::orderBy('id', 'asc');
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('company', function ($row) {
                    return $row->company->name ?? 'N/A';
                })
                ->addColumn('branch', function ($row) {
                    return $row->branch->name ?? 'N/A';
                })
                ->addColumn('file', function ($row) {
                    return '<a class="edit_btn" href="' . asset($row->file) . '" download> <i class="fa-solid fa-download"></i>
                    </a>';
                })
                ->addColumn('action', function ($row) {
                    if($row->status == 1) {
                        $statusBtn = '<form method="POST" action="' . route('companypolicies.inactive') . '" class="status_form" style="display:inline;">
                                      ' . csrf_field() . '
                                      <input type="hidden" name="id" value="' . $row->id . '">
                                      <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                                   </form>';
                    } else {
                        $statusBtn = '<form method="POST" action="' . route('companypolicies.active') . '" class="status_form" style="display:inline;">
                                      ' . csrf_field() . '
                                      <input type="hidden" name="id" value="' . $row->id . '">
                                      <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                                   </form>';
                    }
                    $editBtn = '<a class="edit_btn" href="' . route('companypolicies.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';
                    $deleteBtn = '<form method="POST" action="' . route('companypolicies.destroy') . '" class="delete_form" style="display:inline;">
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
                ->rawColumns(['file','status', 'action']) 
                ->toJson();
        }
        return view('backEnd.companypolicy.index');
    }

    public function create(){
        $companies = Company::where('status', 1)->get();
        $departments = Department::where('status', 1)->get();
        return view('backEnd.companypolicy.create', compact('companies', 'departments'));
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $file = $request->file('file');

        $fileUrl = NULL;
        if($file) {
            $file = $request->file('file');
            $name = time() . $file->getClientOriginalName();
            $uploadPath = 'public/uploads/companypolicy/';
            $file->move($uploadPath, $name);
            $fileUrl = $uploadPath . $name;
        }

        $input['file'] = $fileUrl;
        CompanyPolicy::create($input);
        Toastr::success('Employee created successfully', 'Success');
        return redirect()->route('companypolicies.index');
    }

    public function edit($id)
    {
        $edit_data = CompanyPolicy::findOrFail($id);
        $companies = Company::where('status', 1)->get();
        $branches = Branch::where('status', 1)
            ->where("company_id", $edit_data->company_id)
            ->get();
        return view('backEnd.companypolicy.edit', compact('edit_data', 'companies', 'branches'));
    }

    public function update(Request $request){
        $companypolicy = CompanyPolicy::findOrFail($request->id);
        $input = $request->all();

        // file upload
        $file = $request->file('file');
        if ($file) {
            $file = $request->file('file');
            $name = time() . $file->getClientOriginalName();
            $uploadPath = 'public/uploads/companypolicy/';
            $file->move($uploadPath, $name);
            $fileUrl = $uploadPath . $name;
        } else {
            $fileUrl = $companypolicy->file;
        }
        $input['file'] = $fileUrl;
        $companypolicy->update($input);
        Toastr::success('Employee updated successfully', 'Success');
        return redirect()->route('companypolicies.index');
    }

    public function inactive(Request $request)
    {
        $inactive = CompanyPolicy::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = CompanyPolicy::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }

    public function destroy($id){
        $delete_data = CompanyPolicy::find($request->id);
        File::delete($delete_data->image);
        $delete_data->delete();
    }
}
