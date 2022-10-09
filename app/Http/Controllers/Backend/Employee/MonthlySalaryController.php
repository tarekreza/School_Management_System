<?php

namespace App\Http\Controllers\Backend\Employee;

use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use App\Http\Controllers\Controller;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class MonthlySalaryController extends Controller
{
    public function MonthlySalaryView()
    {
        return view('backend.employee.monthly_salary.monthly_salary_view');
    }
    public function MonthlySalaryGet(Request $request)
    {
        // get data from FORM input field date and take separately year and month
        $date['y'] = date('Y', strtotime($request->date));
        $date['m'] = date('m', strtotime($request->date));
        $getdate = $request->date;
        // get groupby  data from EmployeeAttendance table where requested year and month are same
        $data = EmployeeAttendance::whereYear('date', $date['y'])->whereMonth('date', $date['m'])->groupBy('employee_id')->get();
        $allData = [];
        foreach ($data as $key => $value) {
            // get single employee total data in requested month
            $employeeData = EmployeeAttendance::whereYear('date', $date['y'])->whereMonth('date', $date['m'])->where('employee_id', $value->employee_id)->get();
            // count total absent
            $totalAbsent = count($employeeData->where('attend_status', 'Absent'));
            $basicSalary = $value->user->salary;
            $salaryPerDay = $basicSalary / 30;
            $minus = $salaryPerDay * $totalAbsent;
            $ThisMonthSalary = $basicSalary - $minus;
            // create an Associative array with all information
            $add = array("employee_id" => $value->employee_id,"employee_name" => $value->user->name, "basic_salary" => $value->user->salary, "this_month_salary" => $ThisMonthSalary,"totalAbsent"=>$totalAbsent);
            // push $add array in $allData array
            array_push($allData, $add);
        }

        return view('backend.employee.monthly_salary.monthly_salary_view', compact('allData','getdate'));
    }
    public function MonthlySalaryPayslip(Request $request,$id,$d,$absent,$salaryofThisMonth)
    {
        // separate date with explode and take it's value in variable with list
        list($year,$month,$date) = explode("-",$d);
// take EmployeeAttendance first row where requested date and employee id match
        $data['details'] = EmployeeAttendance::whereYear('date', $year)->whereMonth('date', $month)->where('employee_id', $id)->first();
        $data['absent'] = $absent;
        $data['salaryofThisMonth'] = $salaryofThisMonth;
        $data['year'] = $year;
        $data['month'] = $month;
        // make a PDF
        $pdf = Pdf::loadView('backend.employee.monthly_salary.monthly_salary_pdf',$data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
