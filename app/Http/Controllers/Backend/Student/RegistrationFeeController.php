<?php

namespace App\Http\Controllers\Backend\Student;

use App\Models\StudentYear;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Http\Controllers\Controller;
use App\Models\feeCategoryAmount;
use App\Models\User;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class RegistrationFeeController extends Controller
{
    public function RegFeeView()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['year_id'] = StudentYear::orderBy('id', 'desc')->first()->id;
        $data['class_id'] = StudentClass::orderBy('id', 'desc')->first()->id;
        $data['registration_fee'] = feeCategoryAmount::where('class_id', $data['class_id'])->where('fee_category_id', '1')->first();
        $data['allData'] = AssignStudent::where('year_id', $data['year_id'])->where('class_id', $data['class_id'])->get();
        return view('backend.student.registration_fee.registration_fee_view', $data);
    }


    public function RegFeeClassData(Request $request)
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['year_id'] = $request->year_id;
        $data['class_id'] = $request->class_id;
        $data['registration_fee'] = feeCategoryAmount::where('class_id', $data['class_id'])->where('fee_category_id', '1')->first();
        $data['allData'] = AssignStudent::where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
        return view('backend.student.registration_fee.registration_fee_view', $data);
    } // end method 
    public function RegFeePayslip($id)
    {
        $student_id = $id;
        $allStudent['details'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();/*name,id,father name,class,registration fee,discount*/

        $pdf = Pdf::loadView('backend.student.registration_fee.registration_fee_pdf', $allStudent);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
