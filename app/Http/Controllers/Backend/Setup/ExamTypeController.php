<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    public function ViewExamType()
    {
        $data['allData'] = ExamType::all();
        return view('backend.setup.exam_type.view_exam_type',$data);
    }
    public function ExamTypeAdd()
    {
        return view('backend.setup.exam_type.add_exam_type');
    }
    public function ExamTypeStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required | unique:exam_types,name'
        ]);
        $data = new ExamType();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('exam.type.view');
    }
    public function ExamTypeEdit($id)
    {
        $editData = ExamType::find($id);
        return view('backend.setup.exam_type.edit_exam_type',compact('editData'));
    }
    public function ExamTypeUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required | unique:fee_categories,name'
        ]);
        $data = ExamType::find($id);
        $data->name = $request->name;
        $data->save();

        return redirect()->route('exam.type.view');
    }
    public function ExamTypeDelete($id)
    {
        $user = ExamType::find($id);
        $user->delete();
        
        return redirect()->route('exam.type.view');
    }
}
