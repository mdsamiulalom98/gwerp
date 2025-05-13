<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Supplier;
use Carbon\Carbon;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:supplier-list|supplier-create|supplier-edit|supplier-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:supplier-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:supplier-edit', ['only' => ['edit', 'update']]);
    }

    public function index(Request $request)
    {
        $data = Supplier::orderBy('id', 'asc');
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('action', function ($row) {
                    if ($row->status == 1) {
                        $statusBtn = '<form method="POST" action="' . route('suppliers.inactive') . '" class="status_form" style="display:inline;">
                                      ' . csrf_field() . '
                                      <input type="hidden" name="id" value="' . $row->id . '">
                                      <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                                   </form>';
                    } else {
                        $statusBtn = '<form method="POST" action="' . route('suppliers.active') . '" class="status_form" style="display:inline;">
                                      ' . csrf_field() . '
                                      <input type="hidden" name="id" value="' . $row->id . '">
                                      <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                                   </form>';
                    }
                    $editBtn = '<a class="edit_btn" href="' . route('suppliers.edit', $row->id) . '">
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
        return view('backEnd.supplier.index');
    }

    public function create()
    {
        return view('backEnd.supplier.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['status'] = $request->status ?? 0;
        $input['slug'] = Str::slug($request->name);
        Supplier::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('suppliers.index');
    }

    public function edit($id)
    {
        $edit_data = Supplier::findOrFail($id);
        return view('backEnd.supplier.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $supplier = Supplier::findOrFail($request->id);
        $input = $request->all();
        $input['status'] = $request->status ?? 0;
        $input['slug'] = Str::slug($request->name);
        $supplier->update($input);
        Toastr::success('Success', 'Data updatetd successfully');
        return redirect()->route('suppliers.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Supplier::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Supplier::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $delete_data = Supplier::find($request->id);
        Toastr::success('Success', 'Data delete successfully');
        $delete_data->delete();
    }
}
