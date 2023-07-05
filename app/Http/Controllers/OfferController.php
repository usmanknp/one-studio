<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Offer;
use Illuminate\Support\Str;

class OfferController extends Controller
{
    public function offer_create()
    {
        $records = Classes::all();
        return view('offers.create', compact('records'));
    }

    public function offer_save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'offers' => 'required',
            'price' => 'required',
            'class_id' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect()->to('/offer-create')->with('error', 'All Fields are required!'); 
        }
        
        $offer = new Offer();
        $offer->uuid = Str::uuid();
        $offer->class_id = $request->class_id;
        $offer->offers = $request->offers;
        $offer->amount = $request->price;
        $offer->save();

        return redirect()->to('/offer-list')->with('message', 'Record Save Successfully!'); 
    }

    public function offer_list() 
    {
        $records = Offer::with('classes')->get();
        return view('offers.list', compact('records'));
    }

    public function offer_edit($uuid) 
    {
        $classes = Classes::all();
        $record = Offer::where('uuid',$uuid)->first();
        if($record)
        {
            return view('offers.edit', compact(['record','classes']));
        }
        return redirect()->to('/offer-list')->with('error', 'Record Not Found!'); 
    }

    public function offer_update(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'offers' => 'required',
            'price' => 'required',
            'class_id' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect()->to('/offer-edit/'  . $request->id)->with('error', 'All Fields are required!'); 

        }

        $offer = Offer::where('uuid',$request->id)->first();
         if($offer)
         {
            $offer->class_id = $request->class_id;
            $offer->offers = $request->offers;
            $offer->amount = $request->price;
            $offer->save();
    
            return redirect()->to('/offer-list')->with('message', 'Record updated successfully!');
        
         }

         return redirect()->to('/offer-list')->with('error', 'Something went wrong!');

    }
}
