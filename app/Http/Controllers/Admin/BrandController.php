<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Encoders\WebpEncoder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Brand;
use Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:brand-list|brand-create|brand-edit|brand-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:brand-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:brand-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:brand-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Brand::orderBy('id', 'asc');
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('image', function ($row) {
                    return $row->image ? asset($row->image) : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    if ($row->status == 1) {
                        $statusBtn = '<form method="POST" action="' . route('brands.inactive') . '" class="status_form" style="display:inline;">
                                      ' . csrf_field() . '
                                      <input type="hidden" name="id" value="' . $row->id . '">
                                      <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                                   </form>';
                    } else {
                        $statusBtn = '<form method="POST" action="' . route('brands.active') . '" class="status_form" style="display:inline;">
                                      ' . csrf_field() . '
                                      <input type="hidden" name="id" value="' . $row->id . '">
                                      <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                                   </form>';
                    }
                    $editBtn = '<a class="edit_btn" href="' . route('brands.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';

                    return '<div class="action-buttons">' . $statusBtn . ' ' . $editBtn . ' ' . '</div>';
                })
                ->addColumn('status', function ($row) {
                    return $row->status == 1
                        ? '<span class="active_btn">Active</span>'
                        : '<span class="inactive_btn">Inactive</span>';
                })
                ->rawColumns(['action', 'status'])
                ->toJson();
        }
        return view('backEnd.brand.index');
    }

    public function create()
    {
        return view('backEnd.brand.create');
    }

    public function store(Request $request)
    {
        $image = $request->file('image');
        if ($image) {
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image = Image::read($image);
            $uploadpath = 'public/uploads/brand/';
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
        Brand::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('brands.index');
    }

    public function edit($id)
    {
        $edit_data = Brand::findOrFail($id);
        return view('backEnd.brand.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $brand = Brand::findOrFail($request->id);
        $input = $request->all();
        $image = $request->file('image');
        if ($image) {
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image = Image::read($image);
            $uploadpath = 'public/uploads/brand/';
            $imageUrl = $uploadpath . $filename;
            $image->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->encode(new WebpEncoder(quality: 80))
                ->save($imageUrl);
            $input['image'] = $imageUrl;
        } else {
            $imageUrl = $brand->image;
        }

        $input['slug'] = Str::slug($request->name);
        $input['status'] = $request->status ?? 0;
        $brand->update($input);
        Toastr::success('Success', 'Data updatetd successfully');
        return redirect()->route('brands.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Brand::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Brand::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $delete_data = Brand::find($request->id);
        File::delete($delete_data->image);
        Toastr::success('Success', 'Data delete successfully');
        $delete_data->delete();
    }
}
