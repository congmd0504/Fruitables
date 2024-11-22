<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\client\OrderRequest;
use App\Models\Cart;
use App\Models\DetailOrder;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{
    public function checkout(Request $request)
    {
        $listCart = Cart::with('user', 'product')->where('user_id', Auth::id())->get();
        if(count($listCart) == 0){
            return back()->with('error','Giỏ hàng trống vui lòng thêm sản phẩm !');
        }
        $tongtien = 0;
        return view('client.cart.checkout', compact('listCart', 'tongtien'));
    }
    public function order(OrderRequest $request)
    {
        $dataOrder = $request->only([
            'fullname',
            'phone',
            'address',
            'note',
            'total',
            'payment_method'
        ]);
        
        $dataOrder['user_id'] = Auth::id();
        if ($request->input('payment_method') == 0) {
            $dataOrder['status_order_id'] = 1;
        }
        $order = Order::create($dataOrder);

        $DetailProductId = $request->input('product_id');
        $DetailQuantity = $request->input('quantity');
        $DetailPrice = $request->input('price');

        foreach ($DetailProductId as $index => $product) {
            $dataDetail[] = [
                'product_id' => $product,
                'quantity' => $DetailQuantity[$index],
                'price' => $DetailPrice[$index],
                'order_id' => $order->id
            ];
        }
        DetailOrder::insert($dataDetail);
        Cart::where('user_id', Auth::id())->delete();
        $orderDetails = DetailOrder::with('order', 'product')->where('order_id', $order->id)->get();
        return view('client.cart.comfirm', compact('orderDetails'))
            ->with('success', 'Đặt hàng thành công!');
    }
}
