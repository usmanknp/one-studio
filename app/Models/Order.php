<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'offer_id',
        'transcation_id',
        'price',
        'status',
        'order_date'
    ];
}
