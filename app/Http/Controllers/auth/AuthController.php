<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\PostRegisterRequest;
use App\Http\Requests\auth\UpdateUserRequest;
use App\Mail\ForgotPassword;
use App\Models\ResetPass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\FuncCall;
use Str;

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

    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(PostRegisterRequest $request)
    {
        $data = $request->all();
        User::create($data);
        return redirect()->route('getLogin')->with('success', 'Bạn đã đăng ký thành công vui lòng đăng nhập');
    }

    public function updateFile(Request $request, $filename)
    {
        if ($request->hasFile($filename)) {
            return $request->file($filename)->store('user');
        }
        return "";
    }
    public function getUpdate(User $user)
    {
        return view('auth.update', compact('user'));
    }
    public function update(UpdateUserRequest $request, User $user)
    {
        // dd($request->all());
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $this->updateFile($request, 'image');
            if ($user->image) {
                Storage::delete($user->image);
            }
        }
        $user->update($data);
        return redirect()->back()->with('success', 'Cập nhập thành công!');
    }
    public function postForgetPass(Request $request)
    {
        // Validate yêu cầu
        $request->validate([
            'email' => 'required|email|exists:users,email', // Kiểm tra email tồn tại trong bảng users
        ]);

        // Lấy thông tin người dùng từ email
        $user = User::where('email', $request->email)->first();

        $token = Str::random(40);

        DB::table('reset_passes')->insert([
            'email' => $request->email,
            'token' => $token,
        ]);
        // dd($user,$request->email,$token);
        try {
            Mail::mailer()->to($request->email)->send(new ForgotPassword($user, $token));
        } catch (\Exception $e) {
            return back()->with('error', 'Không thể gửi email: ' . $e->getMessage());
        }
        return back()->with('success', 'Vui lòng kiểm tra email để đặt lại mật khẩu.');
    }
    public function showResetForm($token)
    {
        $tokenData = ResetPass::where('token', $token)->firstOrFail();
        $user = User::where('email', $tokenData->email)->firstOrFail();
        return view('auth.reset-pass', compact('tokenData', 'user'));
    }
    public function reset(Request $request, $token)
    {
        // Xác thực dữ liệu
        $data = $request->validate([
            'email' => 'nullable|email',
            'password' => 'required|min:5',
            'confirm_password' => 'required|same:password',
        ]);
        $id = ResetPass::query()
            ->join('users', 'users.email', '=', 'reset_passes.email')
            ->where('reset_passes.token', $token)
            ->select('users.id as userId')
            ->first();
        if (!$id) {
            return redirect()->route('getLogin')->with('error', 'Không tìm thấy người dùng');
        }
        $user = User::findOrFail($id->userId);
        $user->update(['password' => Hash::make($data['password'])]);
        ResetPass::where('email', $user->email)->delete();
        return redirect()->route('getLogin')->with('success', 'Đổi mật khẩu thành công!');
    }
}
