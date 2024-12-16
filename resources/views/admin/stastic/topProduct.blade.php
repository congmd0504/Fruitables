@extends('admin.home')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Thống kê</h3>
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
                    <a href="#">Thống kê</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Bảng xếp hạng sản phẩm</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Bảng xếp hạng sản phẩm theo lượt mua</div>
                    </div>
                    <div class="card-body">
                        <table class="table table-head-bg-success">
                            <thead class="text-center">
                                <tr>
                                    <th>#</th>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Lượt mua</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($topOrder as $index=>$item)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->quantity}}</td>
                                </tr>
                                @endforeach
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Bảng xếp hạng sản phẩm theo lượt xem</div>
                    </div>
                    <div class="card-body">
                        <table class="table table-head-bg-primary">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Lượt xem</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($topViewProduct as $index=>$item)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td >{{$item->view}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
