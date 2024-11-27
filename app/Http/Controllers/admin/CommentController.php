<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use App\Models\ReplyComment;
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
    public function show($id){
        $comments = Comment::with('product','user')->where('product_id',$id)->paginate(6);
        // dd($comments);
        return view('admin.comments.listComment',compact('comments'));
    }
    public function replyComment(Request $request){
        $data = $request->validate([
            'content'=>'required',
            'user_id'=>'required',
            'comment_id'=>'required',
        ]);
        ReplyComment::create($data);
        return redirect()->back()->with('success','Trả lời bình luận thành công!');
    }
    public function destroy(Comment $comment){
        $comment->delete();
        return redirect()->back()->with('success','Xóa thành công !');
    }
    public function listReplyComment(){
        $listReply = ReplyComment::with('comment','user')->latest('id')->get();
        // dd($listReply);
        return view('admin.comments.listReply',compact('listReply'));
    }
    public function editReplyComment(Request $request,ReplyComment $replyComment){
        $data = $request->only('content');
        $replyComment->update($data);
        return redirect()->route('admin.comments.listReplyComment')->with('success','Bạn đã cập nhập thành công !');
    }
    public function destroyReplyComment(ReplyComment $replyComment){
        $replyComment->delete();
        return redirect()->route('admin.comments.listReplyComment')->with('success','Bạn đã xóa thành công !');
    }
}
