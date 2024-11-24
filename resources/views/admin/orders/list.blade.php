@extends('admin.home')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Đơn Hàng </h3>
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
                    <a href="#">Đơn hàng </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Danh sách đơn hàng</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Danh sách đơn hàng</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th style="font-size: 12px">MÃ ĐƠN</th>
                                    <th style="font-size: 12px">KHÁCH HÀNG</th>
                                    <th style="font-size: 12px">SỐ ĐIỆN THOẠI</th>
                                    <th style="font-size: 12px">ĐỊA CHỈ GIAO</th>
                                    <th style="font-size: 12px">TRẠNG THÁI</th>
                                    <th style="font-size: 12px">NGÀY TẠO</th>
                                    <th style="font-size: 12px">PHƯƠNG THỨC THANH TOÁN</th>
                                    <th style="font-size: 12px">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $index => $item)
                                    <tr class="text-start">
                                        <td style="font-size: 12px">{{ $item->id }}</td>
                                        <td style="font-size: 12px">{{ $item->user->fullname }}</td>
                                        <td style="font-size: 12px">{{ $item->phone }}</td>
                                        <td style="font-size: 12px">{{ $item->address }}</td>
                                        <td style="font-size: 12px">{{ $item->statusOrder->name }}</td>
                                        <td style="font-size: 12px">{{ $item->created_at->format('d-m-Y') }}</td>
                                        <td style="font-size: 12px">
                                            {{ $item->payment_method ? 'Thanh toán online' : 'Thanh toán sau khi nhận hàng' }}
                                        </td>
                                        <td>
                                            <button type="button" class="border" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $index }}">
                                                <i title="Chi tiết" class="fa fa-pen"></i>
                                            </button>

                                            <div class="modal fade" id="exampleModal{{ $index }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <form action="{{route('admin.orders.update',$item->id)}}" method="POST" class="modal-dialog modal-xl">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Chỉnh sửa
                                                                đơn hàng
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body ">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <label for="">Tên khách hàng</label>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ $item->user->fullname }}" disabled>
                                                                        <label for="">Ghi chú</label>
                                                                        <textarea name="" class="form-control" disabled id="" cols="30" rows="3">{{ $item->note }}</textarea>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label for="">Số điện thoại</label>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ $item->user->phone }}" disabled>
                                                                        <label for="">Trạng thái</label>
                                                                        <select name="status_order_id" class="form-select"
                                                                            id="">
                                                                            @foreach ($status as $stat)
                                                                                <option value="{{ $stat->id }}"
                                                                                    @selected($stat->id == $item->status_order_id)>
                                                                                    {{ $stat->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <hr class="m-3">
                                                                    <table>
                                                                        <thead class="text-center">
                                                                            <tr>
                                                                                <th class="text-start">Sản phẩm</th>
                                                                                <th>Gía</th>
                                                                                <th>Số lượng</th>
                                                                                <th>Tổng giá</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="text-center">
                                                                            @foreach ($item->detailOrders as $detail)
                                                                                <tr>
                                                                                    <td class="text-start">
                                                                                        <img class="m-2"
                                                                                            src="{{ Storage::url($detail->product->image) }}"
                                                                                            height="50" alt="">
                                                                                        <span
                                                                                            class="ms-2">{{ $detail->product->name }}</span>
                                                                                    </td>
                                                                                    <td class="text-danger text-center">
                                                                                        {{ number_format($detail->product->price) }}đ
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        x{{ $detail->quantity }}</td>
                                                                                    <td class="text-danger">
                                                                                        {{ number_format($detail->product->price * $detail->quantity) }}đ
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                            <tr class="text-end">
                                                                                <td colspan="4">
                                                                                    <h4 class="fw-bold m-2">Tổng tiền :
                                                                                        {{ number_format($item->total) }}
                                                                                        VNĐ</h4>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Đóng</button>
                                                            <button type="sumbmit" class="btn btn-primary">Cập nhập</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{ $orders->links() }}
    @endsection
