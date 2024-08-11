<?php

namespace Database\Seeders;

use App\Models\TaskTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class TaskTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $task_types = [
            [
                'name' => 'MECHNANICAL',
                'label' => 'Mechanical',
                'icon' => 'bi-exclamation-triangle',
                'color' => '#FFA500',
                'track_name' => 'M',
            ],
            [
                'name' => 'ELECTRICAL',
                'label' => 'Electrical',
                'icon' => 'bi-recycle',
                'color' => '#44B1A3',
                'track_name' => 'E',
            ],
            [
                'name' => 'PRODUCTION',
                'label' => 'Production',
                'icon' => 'bi-truck',
                'color' => '#1EA3D0',
                'track_name' => 'P',
            ],
            [
                'name' => 'OHTER',
                'label' => 'Other',
                'icon' => 'bi-motherboard',
                'color' => '#ff18ff',
                'track_name' => 'O',
            ],
   
        ];

        foreach($task_types as $type)
        {
            $task_type = TaskTypes::where('name',$type['name'])->first();
            if(empty($task_type))
            {
                $task_type = new TaskTypes();
                $task_type->name = $type['name'];
                $task_type->label = $type['label'];
            }
            $task_type->icon = $type['icon'];
            $task_type->color = $type['color'];
            $task_type->track_name = $type['track_name'];
            $task_type->save();
        }

        return "Task Types updated!";
    }
}
