<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\PostRegisterRequest ;
use App\Http\Requests\auth\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\FuncCall;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }
    public function postLogin(Request $request)
    {
        $data = $request->only('username', 'password');
        $data = $request->validate([
            'username' => ['required'],
            'password' => ['required', 'min:5'],
        ]);
        if (Auth::attempt($data)) {
            return redirect()->route('client.index')->with('success', 'Bạn đã đăng nhập thành công !');
        } else {
            return back()->with('error', 'Username hoặc password sai !');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('client.index')->with('success', 'Đăng xuất thành công !');
    }

    public function getRegister(){
        return view('auth.register');
    }

    public function postRegister(PostRegisterRequest $request){
       $data= $request->all();
       User::create($data);
       return redirect()->route('getLogin')->with('success','Bạn đã đăng ký thành công vui lòng đăng nhập');
    }
    
    public function updateFile(Request $request,$filename){
        if($request->hasFile($filename)){
            return $request->file($filename)->store('user');
        }
        return "";
    }
    public function getUpdate(User $user){
        return view('auth.update',compact('user'));
    }
    public function update(UpdateUserRequest $request , User $user){
        // dd($request->all());
        $data = $request->all();
        if($request->hasFile('image')){
            $data['image']= $this->updateFile($request,'image');
            if($user->image){
                Storage::delete($user->image);
            }
        }
        $user->update($data);
         return redirect()->back()->with('success','Cập nhập thành công!');
    }
}
