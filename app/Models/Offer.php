<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'classes_offers';

    protected $fillable = [
        'uuid',
        'class_id',
        'offers',
        'amount'
    ];

    public function classes()
    {
        return $this->hasOne(Classes::class, 'id', 'class_id');
    }

}
