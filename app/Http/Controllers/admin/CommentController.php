<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(){
        $products = Product::withCount('comments')
        ->orderByDesc('comments_count')      
        ->get();
    // dd($products);
    return view('admin.comments.list',compact('products'));
    }
    public function show( $id){
        $comments = Comment::with('product','user')->where('product_id',$id)->paginate(6);
        // dd($comments);
        return view('admin.comments.listComment',compact('comments'));
    }
    public function destroy(Comment $comment){
        
        $comment->delete();
        return redirect()->back()->with('success','Xóa thành công !');
    }
}
