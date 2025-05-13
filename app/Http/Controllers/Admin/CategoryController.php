<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Encoders\WebpEncoder;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Category;
use Image;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Category::orderBy('id', 'asc');
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('image', function ($row) {
                    return $row->image ? asset($row->image) : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    if ($row->status == 1) {
                        $statusBtn = '<form method="POST" action="' . route('categories.inactive') . '" class="status_form" style="display:inline;">
                                      ' . csrf_field() . '
                                      <input type="hidden" name="id" value="' . $row->id . '">
                                      <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                                   </form>';
                    } else {
                        $statusBtn = '<form method="POST" action="' . route('categories.active') . '" class="status_form" style="display:inline;">
                                      ' . csrf_field() . '
                                      <input type="hidden" name="id" value="' . $row->id . '">
                                      <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                                   </form>';
                    }
                    $editBtn = '<a class="edit_btn" href="' . route('categories.edit', $row->id) . '">
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
        return view('backEnd.category.index');
    }

    public function create()
    {
        return view('backEnd.category.create');
    }

    public function store(Request $request)
    {
        $image = $request->file('image');
        if ($image) {
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image = Image::read($image);
            $uploadpath = 'public/uploads/category/';
            $imageUrl = $uploadpath . $filename;
            $image->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->encode(new WebpEncoder(quality: 80))
                ->save($imageUrl);
        }
        $input = $request->all();
        $input['slug'] = Str::slug($request->name);
        $input['status'] = $request->status ?? 0;
        $input['image'] = $imageUrl ?? null;
        Category::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $edit_data = Category::findOrFail($id);
        return view('backEnd.category.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $input = $request->all();
        $image = $request->file('image');
        if ($image) {
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image = Image::read($image);
            $uploadpath = 'public/uploads/category/';
            $imageUrl = $uploadpath . $filename;
            $image->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->encode(new WebpEncoder(quality: 80))
                ->save($imageUrl);
            $input['image'] = $imageUrl;
        } else {
            $imageUrl = $category->image;
        }
        $input['slug'] = Str::slug($request->name);
        $category->update($input);
        Toastr::success('Success', 'Data updatetd successfully');
        return redirect()->route('categories.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Category::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Category::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $delete_data = Category::find($request->id);
        File::delete($delete_data->image);
        Toastr::success('Success', 'Data delete successfully');
        $delete_data->delete();
    }
}
