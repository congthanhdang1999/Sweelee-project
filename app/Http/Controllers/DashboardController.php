<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    public function show(Request $request)
    {

        $data['processing'] = $this->order->where('status', 0)->count();
        $data['delivery'] = $this->order->where('status', 1)->count();
        $data['success'] = $this->order->where('status', 2)->count();
        $data['cancel'] = $this->order->onlyTrashed()->count();
        $orders = $this->order->orderBy('id', 'DESC')->paginate(8);
        $sucessOrder =  (int)$this->order->where('status', 2)->sum('total');
        //dd($sucessOrder);
        //dd($total);
        return view('admin.dashboard', compact('orders', 'data','sucessOrder'));
    }
}
