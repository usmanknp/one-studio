<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Instructor;

class InstructorController extends Controller
{
    public function instructor_create () {
        return view('instructor.create');
    }

    public function instructor_save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048'
        ]);

        if($validator->fails())
        {
            return redirect()->to('/instructor-create')->with('error', 'All Fields are required!'); 
        }
        
        $image = time().'.'.$request->image->extension();
        $request->image->move(public_path('asset/images'), $image);

        $instructor = new Instructor();
        $instructor->uuid = Str::uuid();
        $instructor->name = $request->name;
        $instructor->description = $request->description;
        $instructor->image = url('asset/images/'.$image);
        $instructor->save();

        return redirect()->to('/instructor-list')->with('message', 'Record Save Successfully!'); 
    }

    public function instructor_list() 
    {
        $records = Instructor::all();
        return view('instructor.list', compact('records'));
    }

    public function instructor_edit($uuid) 
    {
        $record = Instructor::where('uuid',$uuid)->first();
        if($record)
        {
            return view('instructor.edit', compact('record'));
        }
        return redirect()->to('/instructor-list')->with('error', 'Record Not Found!'); 
    }

    public function instructor_update(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect()->to('/instructor-edit/'  . $request->id)->with('error', 'All Fields are required!'); 
        }
      
        $instructor = Instructor::where('uuid',$request->id)->first();

         if($instructor)
         {
            // Update the fields based on the request data
            $instructor->name = $request->name;
            $instructor->description = $request->description;
            $instructor->status = $request->status;

            // Check if an image file is present in the request
            if ($request->hasFile('image'))
            {
                $image = time().'.'.$request->image->extension();
                $request->image->move(public_path('asset/images'), $image);
                $instructor->image = url('asset/images/'.$image);
            }

            // Save the instructor model
            $instructor->save();

            return redirect()->to('/instructor-list')->with('message', 'Record updated successfully!'); 
         }

         return redirect()->to('/instructor-list')->with('error', 'Something went wrong!');

    }

    public function destroy($uuid) 
    {
        try {
            $record = Instructor::where('uuid', $uuid)->delete();
            if ($record) {
                return redirect()->to('/instructor-list')->with('error', 'Record has been deleted!');
            }

            return redirect()->to('/instructor-list')->with('error', 'Record Not Found!');

        } catch (\Illuminate\Database\QueryException $e) {

            return redirect()->to('/instructor-list')->with('error', 'Cannot delete the instructor because there are associated records');
        }        
    }
}
