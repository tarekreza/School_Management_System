<?php

namespace App\Http\Controllers\Backend\Student;

use App\Models\ExamType;
use App\Models\StudentYear;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\feeCategoryAmount;
use App\Http\Controllers\Controller;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class ExamFeeController extends Controller
{
    public function ExamFeeView()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['exam_types'] = ExamType::all();
        return view('backend.student.exam_fee.exam_fee_view', $data);
    }
    public function ExamFeeClassData(Request $request)
	{
        $data['exam_types'] = ExamType::all();
		$data['years'] = StudentYear::all();
		$data['classes'] = StudentClass::all();
		$data['year_id'] = $request->year_id;
		$data['class_id'] = $request->class_id;
		$data['exam_type'] = ExamType::where('id', $request->exam_type)->get();
		$data['exam_fee'] = feeCategoryAmount::where('class_id', $data['class_id'])->where('fee_category_id', '3')->first();
		$data['allData'] = AssignStudent::where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
		return view('backend.student.exam_fee.exam_fee_view', $data);
	} // end method 
    public function ExamFeePayslip($id, $exam_type)
	{
		$student_id = $id;
        $allStudent['exam_type'] = $exam_type;
		$allStudent['details'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();/*name,id,father name,class,registration fee,discount*/
		$pdf = Pdf::loadView('backend.student.exam_fee.exam_fee_pdf', $allStudent);
		$pdf->SetProtection(['copy', 'print'], '', 'pass');
		return $pdf->stream('document.pdf');
	}
}
