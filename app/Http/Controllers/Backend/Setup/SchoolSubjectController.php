<?php

namespace App\Http\Controllers\Backend\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SchoolSubject;

class SchoolSubjectController extends Controller
{
    public function ViewSchoolSubject()
    {
        $data['allData'] = SchoolSubject::all();
        return view('backend.setup.school_subject.view_school_subject', $data);
    }
    public function SchoolSubjectAdd()
    {
        return view('backend.setup.school_subject.add_school_subject');
    }
    public function SchoolSubjectStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required | unique:school_subjects,name'
        ]);
        $data = new SchoolSubject();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('school.subject.view');
    }
    public function SchoolSubjectEdit($id)
    {
        $editData = SchoolSubject::find($id);
        return view('backend.setup.school_subject.edit_school_subject', compact('editData'));
    }
    public function SchoolSubjectUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required | unique:school_subjects,name'
        ]);
        $data = SchoolSubject::find($id);
        $data->name = $request->name;
        $data->save();

        return redirect()->route('school.subject.view');
    }
    public function SchoolSubjectDelete($id)
    {
        $user = SchoolSubject::find($id);
        $user->delete();

        return redirect()->route('school.subject.view');
    }
}
