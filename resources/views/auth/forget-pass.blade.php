@extends('client.index')
@section('content')
    <div  class="login-container">
        <h2 class="text-center mb-4">Quên Mật Khẩu</h2>
        <form action="{{route('postForgetPass')}}" method="POST" >
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email đã đăng ký</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Nhập email..">
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-login btn-block">Gửi</button>
            </div>
            <div class="text-center mt-3">
                <a href="{{route('getLogin')}}">Bạn đã có tài khoản ?</a>
            </div>
        </form>
    </div>
@endsection
