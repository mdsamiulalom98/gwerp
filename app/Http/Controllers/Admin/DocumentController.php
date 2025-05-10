<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use Brian2694\Toastr\Facades\Toastr;
use Spatie\Permission\Models\Role;
use Image;
class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:document-list|document-create|document-edit|document-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:document-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:document-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:document-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request){
        $data = Document::orderBy('id', 'asc');
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('role', function ($row) {
                    return $row->role->name ?? 'N/A';
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
                    $editBtn = '<a class="edit_btn" href="' . route('documents.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';
                    $deleteBtn = '<form method="POST" action="' . route('documents.destroy') . '" class="delete_form" style="display:inline;">
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
        return view('backEnd.document.index');
    }

    public function create(){
        $roles = Role::get();
        return view('backEnd.document.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $file = $request->file('file');

        $fileUrl = NULL;
        if($file) {
            $file = $request->file('file');
            $name = time() . $file->getClientOriginalName();
            $uploadPath = 'public/uploads/document/';
            $file->move($uploadPath, $name);
            $fileUrl = $uploadPath . $name;
        }

        $input['file'] = $fileUrl;
        Document::create($input);
        $input['status'] = $request->status ?? 0;
        Toastr::success('Data created successfully', 'Success');
        return redirect()->route('documents.index');
    }

    public function edit($id){
        $edit_data = Document::findOrFail($id);
        $roles = Role::get();
        return view('backEnd.document.edit', compact('edit_data', 'roles'));
    }

    public function update(Request $request){
        $companypolicy = Document::findOrFail($request->id);
        $input = $request->all();

        // file upload
        $file = $request->file('file');
        if ($file) {
            $file = $request->file('file');
            $name = time() . $file->getClientOriginalName();
            $uploadPath = 'public/uploads/document/';
            $file->move($uploadPath, $name);
            $fileUrl = $uploadPath . $name;
        } else {
            $fileUrl = $companypolicy->file;
        }
        $input['file'] = $fileUrl;
        $input['status'] = $request->status ?? 0;
        $companypolicy->update($input);
        Toastr::success('Data updated successfully', 'Success');
        return redirect()->route('documents.index');
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
        $delete_data = Document::find($request->id);
        File::delete($delete_data->image);
        $delete_data->delete();
    }
}
