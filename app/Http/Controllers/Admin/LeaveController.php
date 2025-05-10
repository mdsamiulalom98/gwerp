<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use App\Models\Leave;
use Carbon\Carbon;
use Toastr;

class LeaveController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:leave-list|leave-create|leave-edit|leave-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:leave-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:leave-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:leave-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $data = Leave::orderBy('id', 'DESC')->get();
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('employee', function ($row) {
                    return '<div class="no-wrap text-truncate">' . $row->employee->name ?? '' . '</div>';
                })
                ->addColumn('leave_type', function ($row) {
                    return '<div class="no-wrap text-truncate">' . $row->leaveType->name ?? '' . '</div>';
                })
                ->addColumn('start_date', function ($row) {
                    return date('d-m-Y', strtotime($row->start_date));
                })
                ->addColumn('end_date', function ($row) {
                    return '<div class="no-wrap text-truncate">' . date('d-m-Y', strtotime($row->end_date)) . '</div>';
                })
                ->addColumn('reason', function ($row) {
                    return $row->reason;
                })
                ->addColumn('total_days', function ($row) {
                    $start = Carbon::parse($row->start_date);
                    $end = Carbon::parse($row->end_date);
                    return $start->diffInDays($end) + 1; // +1 to include both start and end dates
                })
                ->addColumn('remarks', function ($row) {
                    return $row->remarks;
                })
                ->addColumn('created_at', function ($row) {
                    return date('d-m-Y', strtotime($row->created_at));
                })
                ->addColumn('action', function ($row) {
                    $showBtn = '<a class="btn btn-warning d-inline-block" href="' . route('leaves.show', $row->id) . '">
                               <i class="ti ti-eye"></i>
                            </a>';
                    $editBtn = $row->status == 'pending' ? '<a class="btn btn-success d-inline-block" href="' . route('leaves.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>' : '';
                    $deleteBtn = $row->status == 'pending' ? '<form method="POST" action="' . route('leaves.destroy') . '" class="delete_form" style="display:inline;">
                                  ' . csrf_field() . '
                                  <input type="hidden" name="id" value="' . $row->id . '">
                                  <button type="button" class="btn btn-danger d-inline-block py-2"><i class="ti ti-trash"></i></button>
                               </form>' : '';
                    return '<div class="action-buttons">' . $showBtn . ' ' . $editBtn . ' ' . $deleteBtn . '</div>';
                })
                ->addColumn('status', function ($row) {
                    return match ($row->status) {
                        'pending' => '<div class="badge bg-warning p-2 px-3 status-badge5">Pending</div>',
                        'approve' => '<div class="badge bg-success p-2 px-3 status-badge5">Approved</div>',
                        'reject' => '<div class="badge bg-danger p-2 px-3 status-badge5">Rejected</div>',
                        default => '<div class="badge bg-secondary p-2 px-3 status-badge5">Unknown</div>',
                    };
                })
                ->rawColumns(['employee', 'leave_type', 'end_date', 'status', 'action'])
                ->toJson();
        }

        return view('backEnd.leave.index');
    }

    public function create()
    {
        $employees = Employee::all();
        $leave_types = LeaveType::all();
        return view('backEnd.leave.create', compact('employees', 'leave_types'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'employee_id' => 'required',
            'leave_type' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required',
            'remarks' => 'required',
        ]);
        $input = $request->all();
        $input['status'] = 'pending';
        Leave::create($input);
        Toastr::success('Success', 'Data store successfully');
        return redirect()->route('leaves.index');
    }

    public function edit($id)
    {
        $edit_data = Leave::find($id);
        $employees = Employee::all();
        $leave_types = LeaveType::all();
        if (empty($edit_data)) {
            Toastr::error('Error', 'Data not found');
            return redirect()->route('leaves.index');
        }
        return view('backEnd.leave.edit', compact('edit_data', 'employees', 'leave_types'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'employee_id' => 'required',
            'leave_type' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required',
            'remarks' => 'required',
        ]);
        $input = $request->except('hidden_id');
        $update_data = Leave::find($request->hidden_id);
        $update_data->update($input);
        Toastr::success('Success', 'Data update successfully');
        return redirect()->route('leaves.index');
    }

    public function show($id){
        $data = Leave::where('id', $id)->first();
        return view('backEnd.leave.show', compact('data'));
    }

    public function destroy(Request $request)
    {
        $delete_data = Leave::find($request->id);
        $delete_data->delete();
        Toastr::success('Success', 'Data delete successfully');
        return redirect()->back();
    }
}
