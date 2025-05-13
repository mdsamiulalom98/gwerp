<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Warehouse;
use App\Models\Employee;
use App\Models\Designation;
use Carbon\Carbon;


class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:warehouse-list|warehouse-create|warehouse-edit|warehouse-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:warehouse-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:warehouse-edit', ['only' => ['edit', 'update']]);
    }

    public function index(Request $request)
    {
        $data = Warehouse::orderBy('id', 'asc');
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('stocks', function ($row) {
                    return ($row->capacity ?? 0) . ' / ' . ($row->current_stock ?? 0);
                })
                ->addColumn('designation', function ($row) {
                    return $row->designation->name ?? 'N/A';
                })
                ->addColumn('date', function ($row) {
                    return $row->warehouse_date ? Carbon::parse($row->warehouse_date)->format('Y-m-d') : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    if ($row->status == 1) {
                        $statusBtn = '<form method="POST" action="' . route('warehouses.inactive') . '" class="status_form" style="display:inline;">
                                      ' . csrf_field() . '
                                      <input type="hidden" name="id" value="' . $row->id . '">
                                      <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                                   </form>';
                    } else {
                        $statusBtn = '<form method="POST" action="' . route('warehouses.active') . '" class="status_form" style="display:inline;">
                                      ' . csrf_field() . '
                                      <input type="hidden" name="id" value="' . $row->id . '">
                                      <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                                   </form>';
                    }
                    $editBtn = '<a class="edit_btn" href="' . route('warehouses.edit', $row->id) . '">
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
        return view('backEnd.warehouse.index');
    }

    public function create()
    {
        return view('backEnd.warehouse.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['status'] = $request->status ?? 0;
        $input['slug'] = Str::slug($request->name);
        Warehouse::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('warehouses.index');
    }

    public function edit($id)
    {
        $edit_data = Warehouse::findOrFail($id);
        $employees = Employee::select('id', 'employee_id', 'name')->get();
        $designations = Designation::select('id', 'name')->get();
        return view('backEnd.warehouse.edit', compact('edit_data', 'employees', 'designations'));
    }

    public function update(Request $request)
    {
        $warehouse = Warehouse::findOrFail($request->id);
        $input = $request->all();
        $input['status'] = $request->status ?? 0;
        $input['slug'] = Str::slug($request->name);
        $warehouse->update($input);
        Toastr::success('Success', 'Data updatetd successfully');
        return redirect()->route('warehouses.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Warehouse::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Warehouse::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $delete_data = Warehouse::find($request->id);
        File::delete($delete_data->image);
        Toastr::success('Success', 'Data delete successfully');
        $delete_data->delete();
    }
}
