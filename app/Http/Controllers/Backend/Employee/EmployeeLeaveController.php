<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeLeave;
use App\Models\LeavePurpose;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeLeaveController extends Controller
{
    public function LeaveView()
    {
        $data['allData'] = EmployeeLeave::orderBy('id','desc')->get();
        return view('backend.employee.employee_leave.employee_leave_view',$data);
    }
    public function LeaveAdd()
    {
        $data['employees'] = User::where('usertype','Employee')->get();
        $data['leave_purpose'] = LeavePurpose::all();
        return view('backend.employee.employee_leave.employee_leave_add',$data);
    }
    public function LeaveStore(Request $request)
    {
        if ($request->leave_purpose_id == "0") {
            $leavepurpose = new LeavePurpose();
            $leavepurpose->name = $request->name;
            $leavepurpose->save();
            $leave_purpose_id = $leavepurpose->id;
        }
        else{
            $leave_purpose_id = $request->leave_purpose_id;
        }
        $data = new EmployeeLeave();
        $data->employee_id = $request->employee_id;
        $data->leave_purpose_id = $leave_purpose_id;
        $data->start_date = date('Y-m-d',strtotime($request->start_date));
        $data->end_date = date('Y-m-d',strtotime($request->end_date));
        $data->save();
        return redirect()->route('employee.leave.view');
    }
    public function LeaveEdit($id)
    {
        $data['editData'] = EmployeeLeave::find($id);
        $data['employees'] = User::where('usertype','Employee')->get();
        $data['leave_purpose'] = LeavePurpose::all();
        return view('backend.employee.employee_leave.employee_leave_edit',$data);
    }
    public function LeaveUpdate(Request $request ,$id)
    {
        if ($request->leave_purpose_id == "0") {
            $leavepurpose = new LeavePurpose();
            $leavepurpose->name = $request->name;
            $leavepurpose->save();
            $leave_purpose_id = $leavepurpose->id;
        }
        else{
            $leave_purpose_id = $request->leave_purpose_id;
        }
        $data = EmployeeLeave::find($id);
        $data->employee_id = $request->employee_id;
        $data->leave_purpose_id = $leave_purpose_id;
        $data->start_date = date('Y-m-d',strtotime($request->start_date));
        $data->end_date = date('Y-m-d',strtotime($request->end_date));
        $data->save();
        return redirect()->route('employee.leave.view');
    }
    public function LeaveDelete($id)
    {
        $leave = EmployeeLeave::find($id);
        $leave->delete();
        return redirect()->route('employee.leave.view');
    }
}
 