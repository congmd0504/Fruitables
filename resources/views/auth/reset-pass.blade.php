@extends('client.index')
@section('content')
<div  class="login-container">
    <h2 class="text-center mb-4">Forget Password</h2>
    <form action="{{ route('passwordUpdate',$tokenData->token) }}" method="POST" >
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" value="{{$user->email}}" disabled > 
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu mới :</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Nhập lại mật khẩu mới :</label>
            <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Enter your confirm_password">
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-login btn-block">Submit</button>
        </div>
       
    </form>
</div>
@endsection
