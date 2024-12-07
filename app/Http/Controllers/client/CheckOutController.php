<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\client\OrderRequest;
use App\Models\Cart;
use App\Models\DetailOrder;
use App\Models\Discount;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{
    public function checkout(Request $request)
    {
        $listCart = Cart::with('user', 'product')->where('user_id', Auth::id())->get();
        if (count($listCart) == 0) {
            return back()->with('error', 'Giỏ hàng trống vui lòng thêm sản phẩm !');
        }
        $listDiscount = Discount::query()->latest('id')->get();
        $tongtien = 0;
        return view('client.cart.checkout', compact('listCart', 'tongtien', 'listDiscount'));
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
        if ($request['idDiscount'] != 0) {
            $discount = Discount::find($request['idDiscount']);
            $discount->decrement('quantity', 1);
        }

        if ($request->input('payment_method') == 0) {
            $dataOrder['status_order_id'] = 1;
        }  
        $dataOrder['user_id'] = Auth::id();
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
            $product = Product::find($product);
            $product->update(['quantity'=>$product->quantity - $DetailQuantity[$index]]);
            }
        DetailOrder::insert($dataDetail);
        Cart::where('user_id', Auth::id())->delete();
        $orderDetails = DetailOrder::with('order', 'product')->where('order_id', $order->id)->get();
        return view('client.cart.comfirm', compact('orderDetails'))
            ->with('success', 'Đặt hàng thành công!');
    }
}
