<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Order;
use App\Models\SparePart;
use App\Models\Tasks;
use App\Models\TaskSparePart;
use App\Models\TaskTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;


class TasksController extends Controller
{
    public function task_view()
    {
        $task_types = TaskTypes::all();
        return view('admin.tasks.create',compact('task_types'));
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
            return redirect()->to('/backend/tasks/create-task')->with('error','All Fields are required!');
        }

        $task_type = TaskTypes::find($request->task_type);

        if(!$task_type)
        {
            return redirect()->to('/backend/tasks/create-task')->with('error','Task type not found');
        }

        $task = new Tasks();

        $task->uuid = Str::uuid();
        $task->task_type_id = $request->task_type;
        $task->title = $request->title;
        $task->description = $request->description;
        // $task->assign_to = $request->user()->id;
        $task->created_by = $request->user()->id;
        $task->occurred_at = $request->occurred_at ?  date('Y-m-d H:i:s', strtotime($request->occurred_at)) : date('Y-m-d H:i:s');
        $task->status = 'NEW';
        $task->save();

        $track_id = $task_type->track_name.date('ymd') . str_pad($task->id, 3, '0', STR_PAD_LEFT);
        Tasks::where('id',$task->id)->update(['track_id' => $track_id]);

        $this->update_media($request->all(), $task->id, 'Tasks');

        return redirect()->to('/backend/tasks/create-task')->with('message','Record created successfully');


    }

    public function get_tasks()
    {
        $records = Tasks::with('task_type','technician','created_by_user')->OrderByDesc('created_at')->get();
        $avatar_path = url('/uploads/avatars');

        return view('admin.tasks.list', compact(['records','avatar_path']));
    }


    public function task_edit($uuid)
    {
        $task_types = TaskTypes::all();
        $spare_parts = SparePart::all();
        $record = Tasks::with('task_type','technician','created_by_user','media','task_spare_parts','task_approved_by')->where('uuid' , $uuid)->first();
        $avatar_path = url('/uploads/avatars');

        if(!$record)
        {
            return redirect()->to('/backend/tasks/get-tasks')->with('error', 'Record Not Found!');
        }

        return view('admin.tasks.edit', compact(['record','task_types','avatar_path','spare_parts']));
    }

    public function task_update(Request $request)
    {
        $task = Tasks::where('uuid',$request->uuid)->first();

        if(!$task)
        {
            return redirect()->to('/backend/tasks/task-edit'  . $request->uuid)->with('error', 'Task Not Exists');
        }


        if($task->status == 'COMPLETED')
        {
            return redirect()->to('/backend/tasks/get-tasks')->with('error', 'Task already completed!');
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
        }

        if($request->approval_status == 'APPROVED')
        {
            $task->approval_status = $request->approval_status;
            $task->approved_by = $request->user()->id;
            if($task->approved_date == null)
            {
                $task->approved_date = date('Y-m-d H:i:s');
            }
        }

        if($request->status == 'COMPLETED')
        {
            $task->start_date = $task->start_date == null  ?  date('Y-m-d H:i:s') : $task->start_date;
            $task->end_date = $task->end_date == null  ?  date('Y-m-d H:i:s') : $task->end_date;
            $file = $this->generate_pdf($task->id);
            $task->file = $file;
        }

        $task->save();

        if($request->status == 'COMPLETED')
        {
            $file = $this->generate_pdf($task->id);
            $task->file = $file;
            Tasks::where('id',$task->id)->update(['file' => !empty($file) ? $file: null]);
        }
        
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

        return redirect()->to('/backend/tasks/get-tasks')->with('message', 'Record Updated Successfully');

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

    private function generate_pdf($task_id)
    {

    $public_path = public_path('/backend/files/tasks');
    if (!File::exists($public_path))
    {
        File::makeDirectory($public_path, 0755, true);
    }

    $task = Tasks::with('task_type','technician','created_by_user','media','task_spare_parts','task_approved_by')->find($task_id);
    $task->end_date = $task->end_date != null ? $task->end_date : date('Y-m-d H:i:s');
    $pdf_data['task'] = $task;
    $filename = $task->id.time().'.pdf';
    $pdf = Pdf::loadView('export_pdf.pdf',$pdf_data);
    $pdf->setPaper("A4", "portrait");
    $pdf->save($public_path.'/'.$filename);
    return url('/backend/files/tasks/'.$filename);
    }
}
