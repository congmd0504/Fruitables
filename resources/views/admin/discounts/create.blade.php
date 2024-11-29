@extends('admin.home')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Mã giảm giá</h3>
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
                    <a href="#">Mã giảm giá</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Thêm mới mã giảm giá</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="{{route('admin.discounts.store')}}" class="m-3" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <label for="code" class=" fw-bold">Mã giảm giá:</label>
                                <input type="text" name="code" class="form-control mt-2"
                                    placeholder="Nhập tên tên sản phẩm..">
                                <label for="discount" class=" fw-bold">Giảm giá(%) :</label>
                                <input type="text" name="discount" class="form-control mt-2"
                                    placeholder="Nhập giá sản phẩm..">
                            </div>
                            <div class="col-6">
                                <label for="quantity" class=" fw-bold">Số lượng:</label>
                                <input type="text" name="quantity" class="form-control mt-2"
                                    placeholder="Nhập tên tên sản phẩm..">
                                <label for="end_date" class=" fw-bold">Ngày hết hạn:</label>
                                <input type="date" name="end_date" class="form-control mt-2"
                                    placeholder="Nhập giá sản phẩm..">
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
