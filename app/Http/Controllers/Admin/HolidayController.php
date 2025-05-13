<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Holiday;

class HolidayController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:holiday-list|holiday-create|holiday-edit|holiday-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:holiday-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:holiday-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:holiday-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Holiday::orderBy('id', 'asc');
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('start_date', function ($row) {
                    return $row->start_date ? Carbon::parse($row->start_date)->format('Y-m-d') : 'N/A';
                })
                ->addColumn('end_date', function ($row) {
                    return $row->end_date ? Carbon::parse($row->end_date)->format('Y-m-d') : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    $editBtn = '<a class="edit_btn" href="' . route('holidays.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';
                    $deleteBtn = '<form method="POST" action="' . route('holidays.destroy') . '" class="delete_form" style="display:inline;">
                                  ' . csrf_field() . '
                                  <input type="hidden" name="id" value="' . $row->id . '">
                                  <button type="button" class="delete_btn"><i class="ti ti-trash"></i></button>
                               </form>';
                    return '<div class="action-buttons">' . $editBtn . ' ' . $deleteBtn . '</div>';
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('backEnd.holiday.index');
    }

    public function create()
    {
        return view('backEnd.holiday.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Holiday::create($input);
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('holidays.index');
    }

    public function edit($id)
    {
        $edit_data = Holiday::findOrFail($id);
        return view('backEnd.holiday.edit', compact('edit_data'));
    }

    public function update(Request $request)
    {
        $companypolicy = Holiday::findOrFail($request->id);
        $input = $request->all();
        $companypolicy->update($input);
        Toastr::success('Success', 'Data updatetd successfully');
        return redirect()->route('holidays.index');
    }




    public function destroy(Request $request)
    {
        $delete_data = Holiday::find($request->id);
        File::delete($delete_data->image);
        Toastr::success('Success', 'Data delete successfully');
        $delete_data->delete();
    }

}
