<?php

namespace App\Http\Controllers\Backend\Student;

use App\Models\StudentYear;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Http\Controllers\Controller;
use App\Models\feeCategoryAmount;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class MonthlyFeeController extends Controller
{
	public function MonthlyFeeView()
	{
		$data['years'] = StudentYear::all();
		$data['classes'] = StudentClass::all();
		return view('backend.student.monthly_fee.monthly_fee_view', $data);
	}
	public function MonthlyFeeClassData(Request $request)
	{
		$data['month'] = $request->month;
		$data['years'] = StudentYear::all();
		$data['classes'] = StudentClass::all();
		$data['year_id'] = $request->year_id;
		$data['class_id'] = $request->class_id;
		$data['monthly_fee'] = feeCategoryAmount::where('class_id', $data['class_id'])->where('fee_category_id', '2')->first();
		$data['allData'] = AssignStudent::where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
		return view('backend.student.monthly_fee.monthly_fee_view', $data);
	} // end method 
	public function MonthlyFeePayslip($id, $month)
	{
		$allStudent['month'] = $month;
		$student_id = $id;
		$allStudent['details'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();/*name,id,father name,class,registration fee,discount*/
		$pdf = Pdf::loadView('backend.student.monthly_fee.monthly_fee_pdf', $allStudent);
		$pdf->SetProtection(['copy', 'print'], '', 'pass');
		return $pdf->stream('document.pdf');
	}
}
