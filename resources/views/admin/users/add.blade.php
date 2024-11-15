@extends('admin.home')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Khách hàng</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Khách hàng</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Thêm mới user</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="{{ route('admin.users.store') }}" class="m-3" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <label for="username" class=" fw-bold">User Name:</label>
                                <input type="text" name="username" class="form-control mt-2"
                                    placeholder="Enter your username.." value="{{old('username')}}">
                                <label for="email" class=" fw-bold">Email :</label>
                                <input type="email" name="email" class="form-control mt-2"
                                    placeholder="Enter your email.." value="{{old('email')}}">
                                <label for="password" class=" fw-bold">Password :</label>
                                <input type="password" name="password" class="form-control mt-2"
                                    placeholder="Enter your password..">
                                <label for="confirmPassword" class=" fw-bold">Confirm Password :</label>
                                <input type="password" name="confirmPassword" class="form-control mt-2"
                                    placeholder="Enter your confirm password..">

                            </div>
                            <div class="col-6">
                                <label for="fullname" class=" fw-bold">Full Name :</label>
                                <input type="text" name="fullname" class="form-control mt-2"
                                    placeholder="Enter your full name.." value="{{old('fullname')}}">
                                <label for="address" class=" fw-bold">Address :</label>
                                <input type="text" name="address" class="form-control mt-2"
                                    placeholder="Enter your address.." value="{{old('address')}}">
                                <label for="phone" class=" fw-bold">Phone :</label>
                                <input type="number" name="phone" class="form-control mt-2"
                                    placeholder="Enter your phone.." value="{{old('phone')}}">
                                <label for="image" class=" fw-bold">Image:</label>
                                <input type="file" name="image" class="form-control mt-2">

                            </div>
                        </div>
                        <label for="content" class="mt-2 fw-bold text-danger">Role :</label>
                        <div class="d-flex">
                            <div class="form-check">
                                <input class="form-check-input" value="3" type="radio" name="role_id"
                                    id="flexRadioDefault1" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    User
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" value="2" type="radio" name="role_id"
                                    id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Nhân viên
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" value="1" type="radio" name="role_id"
                                    id="flexRadioDefault3">
                                <label class="form-check-label" for="flexRadioDefault3">
                                    Admin
                                </label>
                            </div>
                        </div>
                        <div class="text-end mt-4 me-2">
                            <input type="submit" value="Thêm mới" style="width: 100%;" class="btn btn-success ">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
