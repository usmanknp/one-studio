<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponRedeem extends Model
{
    use HasFactory;
    protected $table = 'coupons_redeem';
    
    protected $fillable = [
        'user_id',
        'offer_id',
        'coupon_id',
        'price'
    ];
}
