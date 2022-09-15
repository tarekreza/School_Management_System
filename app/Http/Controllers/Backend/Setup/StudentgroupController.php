<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentGroup;
use Illuminate\Http\Request;

class StudentgroupController extends Controller
{
    public function ViewGroup()
    {
        $data['allData'] = StudentGroup::all();
        return view('backend.setup.group.view_group',$data);
    }
    public function StudentGroupAdd()
    {
        return view('backend.setup.group.add_group');
    }
    public function StudentGroupStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required | unique:student_groups,name'
        ]);
        $data = new StudentGroup();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('student.group.view');
    }
    public function StudentGroupEdit($id)
    {
        $editData = StudentGroup::find($id);
        return view('backend.setup.group.edit_group',compact('editData'));
    }
    public function StudentGroupUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required | unique:student_groups,name'
        ]);
        $data = StudentGroup::find($id);
        $data->name = $request->name;
        $data->save();

        return redirect()->route('student.group.view');
    }
    public function StudentGroupDelete($id)
    {
        $user = StudentGroup::find($id);
        $user->delete();
        
        return redirect()->route('student.group.view');
    }
}
