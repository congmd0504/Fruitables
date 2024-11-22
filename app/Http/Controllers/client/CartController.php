<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listCart = Cart::with('user', 'product')->where('user_id', Auth::id())->get();
        $tongdon = 0;
        return view('client.cart.cart', compact('listCart', 'tongdon'));
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
        $cart = Cart::where('user_id', $request['user_id'])
            ->where('product_id', $request['product_id'])
            ->first();
        if ($cart) {
            $data = [
                'quantity' => $cart->quantity + $request['quantity'],
            ];
            $cart->update($data);
        } else {
            $data = [
                'user_id' => $request['user_id'],
                'product_id' => $request['product_id'],
                'quantity' => $request['quantity'],
            ];
            Cart::create($data);
        }
        // Tính tổng số sản phẩm trong giỏ hàng của người dùng hiện tại
        $totalCart = Cart::where('user_id', $request['user_id'])->count();
       
        // Trả về phản hồi JSON bao gồm tổng số sản phẩm trong giỏ hàng
        return response()->json([
            'totalCart' => $totalCart
        ]);
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

    }
    public function updateQuantity(Request $request)
    {
        // Lấy ID mục giỏ hàng và số lượng mới từ yêu cầu AJAX
        $cartItemId = $request->input('cart_item_id');
        $newQuantity = $request->input('quantity'); // Thêm dòng này để lấy số lượng mới

        // Kiểm tra mục giỏ hàng có tồn tại không
        $cartItem = Cart::find($cartItemId);
        if ($cartItem) {
            $cartItem->quantity = $newQuantity; // Cập nhật số lượng mới cho mục giỏ hàng
            $cartItem->save(); // Lưu thay đổi vào cơ sở dữ liệu
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật số lượng thành công!',
            ]);
        }

        // Trả về phản hồi JSON lỗi nếu mục giỏ hàng không tồn tại
        return response()->json([
            'success' => false,
            'message' => 'Mục giỏ hàng không tồn tại!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = Cart::find($id);
        $cart->delete();
    }
}
