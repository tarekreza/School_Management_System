<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\StudentShift;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentshiftController extends Controller
{
    public function ViewShift()
    {
        $data['allData'] = StudentShift::all();
        return view('backend.setup.shift.view_shift',$data);
    }
    public function StudentShiftAdd()
    {
        return view('backend.setup.shift.add_shift');
    }
    public function StudentShiftStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required | unique:student_shifts,name'
        ]);
        $data = new StudentShift();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('student.shift.view');
    }
    public function StudentShiftEdit($id)
    {
        $editData = StudentShift::find($id);
        return view('backend.setup.shift.edit_shift',compact('editData'));
    }
    public function StudentShiftUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required | unique:student_shifts,name'
        ]);
        $data = StudentShift::find($id);
        $data->name = $request->name;
        $data->save();

        return redirect()->route('student.shift.view');
    }
    public function StudentShiftDelete($id)
    {
        $user = StudentShift::find($id);
        $user->delete();
        
        return redirect()->route('student.shift.view');
    }
}
