<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Validator;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\CouponRedeem;
use App\Models\Offer;

class CouponController extends Controller
{
    public function coupon_create()
    {
        return view('coupon.create');
    }

    public function coupon_save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect()->to('/coupon-create')->with('error', 'All Fields are required!'); 
        }

        $coupon = new Coupon();
        $coupon->name = $request->name;
        $coupon->price = $request->price;
        $coupon->status = $request->status;
        $coupon->save();

        return redirect()->to('/coupon-list')->with('message', 'Record Save Successfully!'); 
    }

    public function coupon_list() 
    {
        $records = Coupon::all();
        return view('coupon.list', compact('records'));
    }

    public function coupon_edit($id) 
    {
        $record = Coupon::where('id',$id)->first();
        if($record)
        {
            return view('coupon.edit', compact('record'));
        }
        return redirect()->to('/coupon-list')->with('error', 'Record Not Found!'); 
    }

    public function coupon_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|min:1',
        ]);

        if($validator->fails())
        {
            return redirect()->to('/coupon-edit/'  . $request->id)->with('error', 'Verify the all fields and price value  positve number'); 
        }

        $coupon = Coupon::where('id',$request->id)->first();
        if($coupon)
        {
            $coupon->name = $request->name;
            $coupon->price = $request->price;
            $coupon->status = $request->status;
            $coupon->save();

            return redirect()->to('/coupon-list')->with('message', 'Record Update Successfully!'); 
        }
       
        return redirect()->to('/coupon-list')->with('error', 'Something went wrong!');

        
    }


    /**
     * Here is list of api for coupon controller
     */

     public function api_coupon_redeem(Request $request)
     {
        $validator = Validator::make($request->all(), [
            'offer_id' => 'required',
            'class_id' => 'required',
            'coupon_name' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json('All fields are required!',422); 
        }

        $coupon = Coupon::where(['name' => $request->coupon_name, 'status' => 1])->first();

        if(!$coupon)
        {
            return response()->json('Your coupon is invalid!',422); 
        }

        $offer = Offer::where(['id' => $request->offer_id, 'class_id' => $request->class_id])->first();

        if(!$offer)
        {
            return response()->json('Your offer is invalid!',422); 
        }

        // $coupon_redeem = new CouponRedeem();
        // $coupon_redeem->user_id = $request->user()->id;
        // $coupon_redeem->offer_id = $offer->id;
        // $coupon_redeem->coupon_id = $coupon->id;
        // if($coupon->price>$offer->amount)
        // {
        //     $new_price = max(0,(int)($coupon->price) - (int)($offer->amount));
        //     $coupon_redeem->price = $offer->amount;
        //     $coupon_redeem->save();
        //     return response()->json((int)0,200); 
        // }
        
        // $new_price = max(0,(int)($offer->amount)-(int)($coupon->price));
        // $coupon_redeem->price = $coupon->price;
        // $coupon_redeem->save();
        
        return response()->json($coupon->price,200); 
        
     }
}

