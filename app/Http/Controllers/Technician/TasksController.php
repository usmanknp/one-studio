<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Order;
use App\Models\SparePart;
use App\Models\Tasks;
use App\Models\TaskSparePart;
use App\Models\TaskTypes;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;


class TasksController extends Controller
{
    public function task_view()
    {
        $task_types = TaskTypes::all();
        return view('technician.tasks.create',compact('task_types'));
    }

    public function create_task(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'occurred_at' => 'required',
            'task_type' => 'required',

        ]);
    
        if($validator->fails())
        {
            return redirect()->to('/technician/tasks/create-task')->with('error','All Fields are required!');
        }

        $task_type = TaskTypes::find($request->task_type);

        if(!$task_type)
        {
            return redirect()->to('/technician/tasks/create-task')->with('error','Task type not found');
        }

        $task = new Tasks();

        $task->uuid = Str::uuid();
        // $task->track_id = 12;
        $task->task_type_id = $request->task_type;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->assign_to = $request->user()->id;
        $task->created_by = $request->user()->id;
        $task->occurred_at = $request->occurred_at ?  date('Y-m-d H:i:s', strtotime($request->occurred_at)) : date('Y-m-d H:i:s');
        $task->status = 'NEW';
        $task->save();

        $track_id = $task_type->track_name.date('ymd') . str_pad($task->id, 3, '0', STR_PAD_LEFT);
        Tasks::where('id',$task->id)->update(['track_id' => $track_id]);
        
        $this->update_media($request->all(), $task->id, 'Tasks');

        return redirect()->to('/technician/tasks/create-task')->with('message','Record created successfully');


    }

    public function get_tasks()
    {
        $records = Tasks::with('task_type','technician','created_by_user')->OrderByDesc('created_at')->get();
        $avatar_path = url('/uploads/avatars');

        return view('technician.tasks.list', compact(['records','avatar_path']));
    }


    public function task_edit($uuid)
    {
        $task_types = TaskTypes::all();
        $spare_parts = SparePart::all();
        $record = Tasks::with('task_type','technician','created_by_user','media','task_spare_parts','task_approved_by')->where('uuid' , $uuid)->first();
        $avatar_path = url('/uploads/avatars');

        if(!$record)
        {
            return redirect()->to('/technician/tasks/get-tasks')->with('error', 'Record Not Found!');
        }

        if($record->approval_status == 'PENDING')
        {
            return redirect()->to('/technician/tasks/get-tasks')->with('error', 'Task Approval Pending!');
        }

        return view('technician.tasks.edit', compact(['record','task_types','avatar_path','spare_parts']));
    }

    public function task_update(Request $request)
    {
        $task = Tasks::where('uuid',$request->uuid)->first();

        if(!$task)
        {
            return redirect()->to('/technician/tasks/task-edit'  . $request->uuid)->with('error', 'Task Not Exists');
        }

        if($task->approval_status == 'PENDING')
        {
            return redirect()->to('/technician/tasks/get-tasks')->with('error', 'Task Approval Pending!');
        }

        if($task->status == 'IN_REVIEW')
        {
            return redirect()->to('/technician/tasks/get-tasks')->with('error', 'Task Under Review!');
        }

        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        if($request->status == 'IN_PROGRESS')
        {
            $task->start_date = $request->start_date ?  date('Y-m-d H:i:s', strtotime($request->start_date)) : date('Y-m-d H:i:s');
        }
        if($request->status == 'IN_REVIEW')
        {
            $task->start_date = $request->start_date ?  date('Y-m-d H:i:s', strtotime($request->start_date)) : date('Y-m-d H:i:s');
            $task->end_date = $request->end_date ?  date('Y-m-d H:i:s', strtotime($request->end_date)) : date('Y-m-d H:i:s');

            $start_date = new DateTime($task->start_date);
            $end_date = new DateTime($task->end_date);

            // Calculate the difference between the two dates
            $interval = $start_date->diff($end_date);

            // Extract the difference in days, hours, and minutes
            $days = $interval->d;
            $hours = $interval->h;
            $minutes = $interval->i;

            // If you need total hours and minutes, you can calculate them as follows:
            $total_hours = ($interval->days * 24) + $hours; // days * 24 + hours
            $total_minutes = ($total_hours * 60) + $minutes; // total hours * 60 + minutes
            $total_time = $hours.':HRS '.$minutes.': MIN';
            $task->total_time = $total_time;

        }

        $task->save();

        if(isset($request->spare_parts))
        {
            TaskSparePart::where(['task_id' => $task->id])->delete();
            foreach ($request->spare_parts as $sparePart) {
                $find_spare_part = SparePart::where('uuid', $sparePart['uuid'])->first();
                $task_spare_parts = TaskSparePart::where(['spare_parts_id'=> $find_spare_part->id, 'task_id' => $task->id])->first();
                if(!$task_spare_parts)
                {
                    $task_spare_parts = new TaskSparePart();
                }
                $task_spare_parts->spare_parts_id = $find_spare_part->id;
                $task_spare_parts->spare_parts_name = $find_spare_part->name;
                $task_spare_parts->spare_parts_code = $find_spare_part->code;
                $task_spare_parts->task_id = $task->id;
                $task_spare_parts->spare_parts_quantity = $sparePart['quantity'];
                $task_spare_parts->spare_parts_description = $sparePart['description'];
                $task_spare_parts->save();
            }
        }

        $this->update_media($request->all(), $task->id, 'Tasks');

        return redirect()->to('/technician/tasks/get-tasks')->with('message', 'Record Updated Successfully');

    }

    private function update_media($request, $entity_id, $entity)
    {
      $inputData = $request;
      if(!empty($inputData['files']))
      {
          foreach($inputData['files'] as $key => $file)
          {

              $media = new Media();

              $mime_type = explode('/',$file->getMimeType());
              $mime_type = !empty($mime_type) ? $mime_type[0] : 'file';
              $media_type = $mime_type == 'image' || $mime_type == 'video' || $mime_type == 'file' ? $mime_type : 'file';

              $filename = rand(1, 10000).''.time().'.'.$file->getClientOriginalExtension();
              
              if (!file_exists(public_path('/uploads/media')))
              {
                  mkdir(public_path('/uploads/media'), 0777, true);
              }
              $size=$file->getSize();

              $file->move(public_path('uploads/media'), $filename);

              $media->uuid = Str::uuid();
              $media->uploaded_by = Auth::id() ? Auth::id() : null;
              $media->entity_id = $entity_id;
              $media->entity = $entity;
              $media->media_type = strtoupper($media_type);
              $media->media = $filename;
              $media->url = url('/uploads/media/'.$filename);
              $media->save();
          }
      }
      return true;
    }
}
