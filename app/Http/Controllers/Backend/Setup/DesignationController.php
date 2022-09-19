<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function ViewDesignation()
    {
        $data['allData'] = Designation::all();
        return view('backend.setup.designation.view_designation', $data);
    }
    public function DesignationAdd()
    {
        return view('backend.setup.designation.add_designation');
    }
    public function DesignationStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required | unique:designations,name'
        ]);
        $data = new Designation();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('designation.view');
    }
    public function DesignationEdit($id)
    {
        $editData = Designation::find($id);
        return view('backend.setup.designation.edit_designation', compact('editData'));
    }
    public function DesignationUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required | unique:designations,name'
        ]);
        $data = Designation::find($id);
        $data->name = $request->name;
        $data->save();

        return redirect()->route('designation.view');
    }
    public function DesignationDelete($id)
    {
        $user = Designation::find($id);
        $user->delete();

        return redirect()->route('designation.view');
    }
}
