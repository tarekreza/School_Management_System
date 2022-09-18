<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\feeCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeeCategoryController extends Controller
{
    public function ViewFeeCat()
    {
        $data['allData'] = feeCategory::all();
        return view('backend.setup.fee_category.view_fee_cat',$data);
    }
    public function FeeCatAdd()
    {
        return view('backend.setup.fee_category.add_fee_cat');
    }
    public function FeeCatStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required | unique:fee_categories,name'
        ]);
        $data = new feeCategory();
        $data->name = $request->name;
        $data->save();

        return redirect()->route('fee.category.view');
    }
    public function FeeCatEdit($id)
    {
        $editData = feeCategory::find($id);
        return view('backend.setup.fee_category.edit_fee_cat',compact('editData'));
    }
    public function FeeCatUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required | unique:fee_categories,name'
        ]);
        $data = feeCategory::find($id);
        $data->name = $request->name;
        $data->save();

        return redirect()->route('fee.category.view');
    }
    public function FeeCatDelete($id)
    {
        $user = feeCategory::find($id);
        $user->delete();
        
        return redirect()->route('fee.category.view');
    }
}
