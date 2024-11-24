<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DetailOrder;
use App\Models\Order;
use App\Models\StatusOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('detailOrders','product')->latest('id')->paginate(7);
        $status = StatusOrder::all();
        // dd($orders);
        return view('admin.orders.list',compact('orders','status'));
    }
    public function list(){
        $orders = Order::with('detailOrders', 'product') ->where('status_order_id', 1) ->latest('id')->paginate(7);
        $status = StatusOrder::all();
        // dd($orders);
        return view('admin.orders.listComfirm',compact('orders','status'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->only('status_order_id');
        $order=Order::find($id);
        // dd($order);
        $order->update($data);
        return redirect()->route('admin.orders.index')->with('success','Cập nhập trạng thái thành công !');
    }
   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
