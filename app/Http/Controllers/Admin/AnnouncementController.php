<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Announcement;
use App\Models\AnnouncementDepartment;
use App\Models\Employee;
use App\Models\Branch;
use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class AnnouncementController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:announcement-list|announcement-create|announcement-edit|announcement-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:announcement-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:announcement-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:announcement-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $data = Announcement::orderBy('id', 'asc');
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('start_date', function ($row) {
                    return $row->start_date ? Carbon::parse($row->start_date)->format('Y-m-d') : 'N/A';
                })
                ->addColumn('end_date', function ($row) {
                    return $row->end_date ? Carbon::parse($row->end_date)->format('Y-m-d') : 'N/A';
                })
                ->addColumn('action', function ($row) {

                    $editBtn = '<a class="edit_btn" href="' . route('announcements.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';
                    $deleteBtn = '<form method="POST" action="' . route('announcements.destroy') . '" class="delete_form" style="display:inline;">
                                  ' . csrf_field() . '
                                  <input type="hidden" name="id" value="' . $row->id . '">
                                  <button type="button" class="delete_btn"><i class="ti ti-trash"></i></button>
                               </form>';
                    return '<div class="action-buttons">' . $editBtn . ' ' . $deleteBtn . '</div>';
                })
                ->rawColumns(['status', 'action'])
                ->toJson();
        }
        return view('backEnd.announcement.index');
    }

    public function create()
    {
        $branchs = Branch::where('status', 1)->get();
        $departments = Department::where('status', 1)->get();
        $employees = Employee::get();
        return view('backEnd.announcement.create', compact('branchs', 'departments', 'employees'));
    }

    public function store(Request $request)
    {
        $input = $request->except('department_id');
        $store = Announcement::create($input);
        $store->departments()->attach($request->department_id);

        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('announcements.index');
    }

    public function edit($id)
    {
        $edit_data = Announcement::findOrFail($id);
        $branchs = Branch::where('status', 1)->get();
        $departments = Department::where('status', 1)->get();
        $selectedDepartments = AnnouncementDepartment::where('announcement_id', $id)->get();
        return view('backEnd.announcement.edit', compact('edit_data', 'branchs', 'departments', 'selectedDepartments'));
    }

    public function update(Request $request)
    {
        $companypolicy = Announcement::findOrFail($request->id);
        $input = $request->except('department_id');
        $companypolicy->update($input);
        $companypolicy->departments()->sync($request->department_id);
        Toastr::success('Success', 'Data updatetd successfully');
        return redirect()->route('announcements.index');
    }

    public function destroy(Request $request)
    {
        $delete_data = Announcement::find($request->id);
        File::delete($delete_data->image);
        Toastr::success('Success', 'Data delete successfully');
        $delete_data->delete();
    }

}
