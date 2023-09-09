<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function api_create_order(Request $request)
    {
        dd($request->all());
    }
}
