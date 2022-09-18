<?php

namespace App\Http\Controllers\Backend\Setup;

use Illuminate\Http\Request;
use App\Models\feeCategoryAmount;
use App\Http\Controllers\Controller;
use App\Models\feeCategory;
use App\Models\StudentClass;

class FeeAmountController extends Controller
{
    public function ViewFeeAmount()
    {
        // $data['allData'] = feeCategoryAmount::all();
        $data['allData'] = feeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.setup.fee_amount.view_fee_amount', $data);
    }
    public function AddFeeAmount()
    {
        $data['fee_categories'] = feeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.add_fee_amount', $data);
    }
    public function StoreFeeAmount(Request $request)
    {
        $countClass = count($request->class_id);
        if ($countClass != NULL) {
            for ($i = 0; $i < $countClass; $i++) {
                $fee_amount = new feeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            }
        }
        return redirect()->route('fee.amount.view');
    }
    public function EditFeeAmount($id)
    {
        $data['editData'] = feeCategoryAmount::where('fee_category_id', $id)->orderBy('class_id', 'asc')->get();
        // dd($data['editData']->toArray()); 
        $data['fee_categories'] = feeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.edit_fee_amount', $data);
    }
    public function UpdateFeeAmount(Request $request, $id)
    {
        if ($request->class_id == NULL) {
            // TODO: add a error message
            return redirect()->back();
        } else {
            $countClass = count($request->class_id);
            if ($countClass != NULL) {
                feeCategoryAmount::where('fee_category_id', $id)->delete();
                for ($i = 0; $i < $countClass; $i++) {
                    $fee_amount = new feeCategoryAmount();
                    $fee_amount->fee_category_id = $request->fee_category_id;
                    $fee_amount->class_id = $request->class_id[$i];
                    $fee_amount->amount = $request->amount[$i];
                    $fee_amount->save();
                }
            }
            return redirect()->route('fee.amount.view');
        }
    }
    public function DetailsFeeAmount($id)
    {
        $data['detailsData'] = feeCategoryAmount::where('fee_category_id', $id)->orderBy('class_id', 'asc')->get();
        return view('backend.setup.fee_amount.details_fee_amount',$data);
    }
}
