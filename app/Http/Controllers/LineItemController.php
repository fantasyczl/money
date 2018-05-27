<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LineItem;

class LineItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ajaxAddLineItem(Request $request)
    {
        $request->validate([
            'product_id' => 'required|int',
            'amount' => 'required|int',
        ]);

        $lineItem = new LineItem;
        $lineItem->product_id = $request->product_id;
        $lineItem->amount = $request->amount;
        $lineItem->op_user_id = $request->user()->id;
        $is = $lineItem->save();

        if ($is) {
            return response()->json([
                'err_code' => 0,
                'message' => 'Success',
            ]);
        } else {
            return response()->json([
                'err_code' => -1,
                'message' => "Insert to db failed.",
            ]);
        }
    }
}
