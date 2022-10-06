<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeAttendanceController extends Controller
{
    public function AttendanceView()
    {
        $data['allData'] = EmployeeAttendance::select('date')->groupBy('date')->orderBy('id','DESC')->get();
        // $data['allData'] = EmployeeAttendance::orderBy('id','DESC')->get();
           return view('backend.employee.employee_attendance.employee_attendance_view',$data);
    }
    public function AttendanceAdd()
    {
        $data['employees'] = User::where('usertype', 'Employee')->get();
        return view('backend.employee.employee_attendance.employee_attendance_add',$data);
    }
    public function AttendanceStore(Request $request)
    {
        EmployeeAttendance::where('date',date('Y-m-d', strtotime($request->date)))->delete();

        $countemployee = count($request->employee_id);

        for ($i=0; $i < $countemployee; $i++) { 
            $attend_status = 'attend_status'.$i;
            $attend = new EmployeeAttendance();
            $attend->date = date('Y-m-d',strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request-> $attend_status;
            $attend->save();
        }
        return redirect()->route('employee.attendance.view');
    }
    public function AttendanceEdit($id)
    {
        $data['editData'] = EmployeeAttendance::where('date',$id)->get();
        $data['employees'] = User::where('usertype', 'Employee')->get();
        return view('backend.employee.employee_attendance.employee_attendance_edit',$data);
    }
    public function AttendanceDetails($id)
    {
        $data['details'] = EmployeeAttendance::where('date',$id)->get();
        return view('backend.employee.employee_attendance.employee_attendance_details',$data);
    }
}
