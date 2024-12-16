<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\StatusOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function shop(Request $request, $id = null)
    {
        if ($request->name) {
            $products = Product::with('category')->where('name', 'LIKE', '%' . $request->name . '%')->paginate(9);
        } elseif ($id) {
            $products = Product::with('category')->where('category_id', $id)->paginate(5);
        } else {
            $products = Product::with('category')->paginate(9);
        }
        $hotProducts = Product::with('category', 'tags')->latest('id')->take(6)->get();
        return view('client.home.shop', compact('products', 'hotProducts'));
    }

    public function shopDetail(Product $product)
    {
        $product::with('category', 'comments','reviews')->first();
        $hotProducts = Product::with('category', 'tags')->latest('id')->take(6)->get();
        $product->increment('view');
        return view('client.home.product-detail', compact('product', 'hotProducts'));
    }
    public function postComment(Request $request)
    {
        $data = [
            'user_id' => $request['user_id'],
            'product_id' => $request->input('product_id'),

            'content' => $request['content'],
        ];
        Comment::create($data);
        return response()->json([
            'success' => 'Bình luận thành công! '
        ]);
    }
    public function history()
    {
        $historys = Order::with('user', 'statusOrder', 'detailOrders')->where('user_id', Auth::id())->latest('id')->paginate(10);
        // dd($historys);
        return view('client.home.history', compact('historys'));
    }
    public function updateHistory($id)
    {
        Order::where('id', $id)->update(['status_order_id' => 6]);
        return redirect()->route('client.history')->with('success', 'Hủy thành công ?');
    }
    public function review($id)
    {
        $check = Review::where([
            ['product_id', '=', $id],
            ['user_id', '=', Auth::id()]
        ])->count();
        if($check!=0){
            return back()->with('error','Bạn đã đánh giá sản phẩm này !');
        }
        $product = Product::find($id);
        return view('client.home.review', compact('product'));
    }
    public function postReview(Request $request)
    {
        $data = $request->validate([
            'star' => 'required|numeric|min:1|max:5',
            'content' => 'required',
            'user_id' => 'required',
            'product_id' => 'required',

        ]);
        Review::create($data);
        return redirect()->route('client.history')->with('success', 'Bạn đã đánh giá thành công!');
    }
}
