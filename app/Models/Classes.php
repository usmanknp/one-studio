<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'uuid',
        'name',
        'instructor_id',
        'description',
        'start_date',
        'end_date',
        'type'
    ];

    public function instuctors()
    {
        return $this->hasOne(Instructor::class, 'id', 'instructor_id');
    }

 
    public function offers()
    {
            return $this->hasMany(Offer::class, 'class_id', 'id');  
    }

    public function instructor()
    {
            return $this->belongsTo(Instructor::class, 'instructor_id', 'id');  
    }
}
