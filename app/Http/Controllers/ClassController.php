<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Offer;
use App\Models\Instructor;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;

class ClassController extends Controller
{
    public function class_create() 
    {
        $records = Instructor::where('status','active')->get();
        return view('classes.create', compact('records'));
    }

    public function class_save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'instructor_id' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'type' => 'required',
        ]);

        if($validator->fails())
        {
            $error = "All Fields are required!";
            return redirect()->to('/class-create')->with('error', $error); 
        }

        $class = new Classes();
        $class->uuid = Str::uuid();
        $class->name = $request->name;
        $class->instructor_id = $request->instructor_id;
        $class->description = $request->description;
        $class->start_date = $request->start_date;
        $class->end_date = $request->end_date;
        $class->type = $request->type;
        $class->save();
        return redirect()->to('/class-create')->with('message', 'Record Save Successfully!'); 
    }

    public function class_list() 
    {
        $records = Classes::with('instuctors')->get(); 
        return view('classes.list', compact('records'));
    }

    public function class_edit($uuid) 
    {
        $instructors = Instructor::where('status','active')->get();
        $record = Classes::where('uuid',$uuid)->first();
        if($record)
        {
            return view('classes.edit', compact(['record','instructors']));
        }
        return redirect()->to('/class-list')->with('error', 'Record Not Found!'); 
    }

    public function class_update(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'instructor_id' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'type' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect()->to('/class-edit/'  . $request->id)->with('error', 'All Fields are required!'); 
        }

        $class = Classes::where('uuid',$request->id)->first();
        if($class)
        {
            $class->name = $request->name;
            $class->instructor_id = $request->instructor_id;
            $class->description = $request->description;
            $class->start_date = $request->start_date;
            $class->end_date = $request->end_date;
            $class->type = $request->type;
            $class->save();
            return redirect()->to('/class-list')->with('message', 'Record Updated Successfully!'); 
        }
        return redirect()->to('/class-list')->with('error', 'Something went wrong!');
    }

    public function destroy($uuid) 
    {
        try {
            $record = Classes::where('uuid', $uuid)->delete();
            if ($record) {
                return redirect()->to('/class-list')->with('error', 'Record has been deleted!');
            }

            return redirect()->to('/class-list')->with('error', 'Record Not Found!');

        } catch (\Illuminate\Database\QueryException $e) {

            return redirect()->to('/class-list')->with('error', 'Error: Class has associated records!');
        }        
    }


    public function api_class_list()
    {
       $classes =  Classes::with('instructor')->get();
        return response([
            'data' => $classes
        ],200);
    }

    public function api_class_offer(Request $request)
    {
        $offer = Classes::with(['instructor','offers'])->where('id',$request->id)->get();
        return response([
            'data' => $offer
        ],200);
    }

    public function api_book_offer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'offer_id' => 'required',
            'user_id' => 'required',
            'class_id' => 'required',
            'price' => 'required'
        ]);

        if($validator->fails())
        {
            return response([
                'message' => 'All fields required'
            ],422); 
        }

       $offer_save =  DB::table('classes_selected_offers')->insertGetId([
            'user_id' => $request->user_id,
            'offfer_id' => $request->offer_id,
            'class_id' => $request->class_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        if($offer_save)
        {
            $offer_payment =  DB::table('classes_payments')->insert([
                'user_id' => $request->user_id,
                'selected_offer_id' => $offer_save,
                'price' => $request->price,
                'status' => 'INITIAL',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        dd($offer_payment);
        }


        // $offer = Classes::with(['instructor','offers'])->where('id',$request->id)->get();
        // return response([
        //     'data' => $offer
        // ],200);
    }
}
