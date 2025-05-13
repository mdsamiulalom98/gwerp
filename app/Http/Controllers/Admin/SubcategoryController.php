<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Encoders\WebpEncoder;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Subcategory;
use App\Models\Category;
use Carbon\Carbon;
use Image;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:subcategory-list|subcategory-create|subcategory-edit|subcategory-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:subcategory-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:subcategory-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:subcategory-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Subcategory::orderBy('id', 'asc');
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('category', function ($row) {
                    return $row->category->name ?? 'N/A';
                })
                ->addColumn('image', function ($row) {
                    return $row->image ? asset($row->image) : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    if ($row->status == 1) {
                        $statusBtn = '<form method="POST" action="' . route('subcategories.inactive') . '" class="status_form" style="display:inline;">
                                      ' . csrf_field() . '
                                      <input type="hidden" name="id" value="' . $row->id . '">
                                      <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                                   </form>';
                    } else {
                        $statusBtn = '<form method="POST" action="' . route('subcategories.active') . '" class="status_form" style="display:inline;">
                                      ' . csrf_field() . '
                                      <input type="hidden" name="id" value="' . $row->id . '">
                                      <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                                   </form>';
                    }
                    $editBtn = '<a class="edit_btn" href="' . route('subcategories.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';

                    return '<div class="action-buttons">' . $statusBtn . ' ' . $editBtn . '</div>';
                })
                ->addColumn('status', function ($row) {
                    return $row->status == 1
                        ? '<span class="active_btn">Active</span>'
                        : '<span class="inactive_btn">Inactive</span>';
                })
                ->rawColumns(['action', 'status'])
                ->toJson();
        }
        return view('backEnd.subcategory.index');
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('backEnd.subcategory.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $image = $request->file('image');
        if ($image) {
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image = Image::read($image);
            $uploadpath = 'public/uploads/subcategory/';
            $imageUrl = $uploadpath . $filename;
            $image->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->encode(new WebpEncoder(quality: 80))
                ->save($imageUrl);
        }
        $input = $request->all();
        $input['slug'] = Str::slug($request->name);
        $input['image'] = $imageUrl ?? null;
        $input['status'] = $request->status ?? 0;
        Subcategory::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('subcategories.index');
    }

    public function edit($id)
    {
        $edit_data = Subcategory::findOrFail($id);
        $categories = Category::select('id', 'name')->get();
        return view('backEnd.subcategory.edit', compact('edit_data', 'categories'));
    }

    public function update(Request $request)
    {
        $subcategory = Subcategory::findOrFail($request->id);
        $input = $request->all();

        $image = $request->file('image');
        if ($image) {
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image = Image::read($image);
            $uploadpath = 'public/uploads/subcategory/';
            $imageUrl = $uploadpath . $filename;
            $image->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->encode(new WebpEncoder(quality: 80))
                ->save($imageUrl);
            $input['image'] = $imageUrl;
            File::delete($subcategory->image);
        } else {
            $imageUrl = $subcategory->image;
        }

        $input['slug'] = Str::slug($request->name);
        $input['status'] = $request->status ?? 0;
        $subcategory->update($input);
        Toastr::success('Success', 'Data updatetd successfully');
        return redirect()->route('subcategories.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Subcategory::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Subcategory::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $delete_data = Subcategory::find($request->id);
        File::delete($delete_data->image);
        Toastr::success('Success', 'Data delete successfully');
        $delete_data->delete();
    }
}
