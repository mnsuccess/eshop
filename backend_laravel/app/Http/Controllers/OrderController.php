<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Listing of the resource
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->select(
            'id',
            'product_id',
            'user_id',
            'order_ref',
            'total_payable',
            'created_at'
        )->paginate(10);
        return view('admin.order.index', compact('orders'));
    }
}
