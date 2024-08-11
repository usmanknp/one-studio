<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    //
    protected $table = 'tasks';

    public function task_type()
    {
        return $this->hasOne('App\Models\TaskTypes', 'id', 'task_type_id');
    }

    public function technician()
    {
        return $this->hasOne('App\Models\User', 'id', 'assign_to');
    }

    public function task_approved_by()
    {
        return $this->hasOne('App\Models\User', 'id', 'approved_by');
    }

    public function created_by_user()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    public function media()
    {
        return $this->hasMany('App\Models\Media', 'entity_id', 'id')->where('entity','tasks');
    }
    public function task_spare_parts()
{
    return $this->hasMany('App\Models\TaskSparePart','task_id','id');
}

}

?>
