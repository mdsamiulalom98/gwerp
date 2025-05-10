<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Event;
class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:event-list|event-create|event-edit|event-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:event-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:event-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:event-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request){
        $data = Event::orderBy('id', 'asc');
        if ($request->ajax()) {
            return datatables()->of($data)
                ->addColumn('action', function ($row) {
                    if($row->status == 1) {
                        $statusBtn = '<form method="POST" action="' . route('events.inactive') . '" class="status_form" style="display:inline;">
                                      ' . csrf_field() . '
                                      <input type="hidden" name="id" value="' . $row->id . '">
                                      <button type="button" class="thumb_down"><i class="ti ti-thumb-down"></i></button>
                                   </form>';
                    } else {
                        $statusBtn = '<form method="POST" action="' . route('events.active') . '" class="status_form" style="display:inline;">
                                      ' . csrf_field() . '
                                      <input type="hidden" name="id" value="' . $row->id . '">
                                      <button type="button" class="thumb_up"><i class="ti ti-thumb-up"></i></button>
                                   </form>';
                    }
                    $editBtn = '<a class="edit_btn" href="' . route('events.edit', $row->id) . '">
                               <i class="ti ti-pencil"></i>
                            </a>';
                    $deleteBtn = '<form method="POST" action="' . route('events.destroy') . '" class="delete_form" style="display:inline;">
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
                ->rawColumns(['status', 'action']) 
                ->toJson();
        }
        return view('backEnd.event.index');
    }

    public function create(){
        return view('backEnd.event.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Event::create($input);
        $input['status'] = $request->status ?? 0;
        Toastr::success('Success', 'Data insert successfully');
        return redirect()->route('events.index');
    }

    public function edit($id){
        $edit_data = Event::findOrFail($id);
        return view('backEnd.event.edit', compact('edit_data'));
    }

    public function update(Request $request){
        $companypolicy = Event::findOrFail($request->id);
        $input = $request->all();
        $input['status'] = $request->status ?? 0;
        $companypolicy->update($input);
        Toastr::success('Success', 'Data updatetd successfully');
        return redirect()->route('events.index');
    }

    public function inactive(Request $request)
    {
        $inactive = Event::find($request->id);
        $inactive->status = 0;
        $inactive->save();
        Toastr::success('Success', 'Data inactive successfully');
        return redirect()->back();
    }
    public function active(Request $request)
    {
        $active = Event::find($request->id);
        $active->status = 1;
        $active->save();
        Toastr::success('Success', 'Data active successfully');
        return redirect()->back();
    }

    public function destroy($id){
        $delete_data = Event::find($request->id);
        File::delete($delete_data->image);
        Toastr::success('Success', 'Data delete successfully');
        $delete_data->delete();
    }
}
