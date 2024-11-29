@extends('client.index')
@section('content')
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Lịch sử mua </h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="#">Trang</a></li>
            <li class="breadcrumb-item active text-white">Lịch sử mua </li>
        </ol>
    </div>
    <div class="container py-5">
        <div class="row">
            <div class="col-3 ">
                <div class="border rounded p-4">
                    <div class="d-flex  align-items-center">
                        <img class="rounded-circle me-2" src="{{ Storage::url(Auth::user()->image) }}" height="50x"
                            alt="">
                        <h4>{{ Auth::user()->username }}</h4>
                    </div>
                    <hr>
                    <div class="">
                        <b>Họ và tên:</b> <span>{{ Auth::user()->fullname }}</span><br>
                        <b>Email:</b> <span>{{ Auth::user()->email }}</span><br>
                        <b>Số điện thoại:</b> <span>{{ Auth::user()->phone }}</span><br>
                        <b>Địa chỉ:</b> <span>{{ Auth::user()->address }}</span><br>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <nav>
                    <div class="nav nav-tabs nav-fill border-0 shadow-sm" id="nav-tab" role="tablist">
                        <button class="nav-link active fw-bold text-primary" id="nav-home-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                            aria-selected="true">
                            <i class="bi bi-list"></i> Tất cả
                        </button>
                        <button class="nav-link fw-bold text-warning small-tab" id="nav-profile-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                            aria-selected="false">
                            Chưa thanh toán
                        </button>
                        <button class="nav-link fw-bold text-info" id="nav-confirm-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-confirm" type="button" role="tab" aria-controls="nav-confirm"
                            aria-selected="false">
                            Chờ xác nhận
                        </button>
                        <button class="nav-link fw-bold text-danger" id="nav-processing-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-processing" type="button" role="tab" aria-controls="nav-processing"
                            aria-selected="false">
                            Đang xử lý
                        </button>
                        <button class="nav-link fw-bold text-primary" id="nav-shipping-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-shipping" type="button" role="tab" aria-controls="nav-shipping"
                            aria-selected="false">
                            Đang giao hàng
                        </button>
                        <button class="nav-link fw-bold text-success" id="nav-completed-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-completed" type="button" role="tab" aria-controls="nav-completed"
                            aria-selected="false">
                            <i class="bi bi-check-circle"></i> Hoàn thành
                        </button>
                        <button class="nav-link fw-bold text-secondary" id="nav-cancelled-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-cancelled" type="button" role="tab" aria-controls="nav-cancelled"
                            aria-selected="false">
                            <i class="bi bi-x-circle"></i> Đã hủy
                        </button>
                    </div>
                </nav>

                <div class="tab-content border rounded p-3 shadow-sm bg-white mt-3" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                        tabindex="0">
                        <table class="table">
                            <thead class="text-center">
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Trạng thái đơn</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Ngày đặt</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($historys as $item)
                                    <tr class="text-center">
                                        <td class="fw-bold">{{ $item->id }}</td>
                                        <td
                                            class="@if ($item->status_order_id == 6) text-danger
                                            @elseif ($item->status_order_id == 5)
                                            text-primary
                                        @else
                                            text-info @endif">
                                            {{ $item->statusOrder->name }}</td>
                                        <td>{{ $item->payment_method ? 'Thanh toán onlline' : 'Thanh toán khi nhận hàng' }}
                                        </td>
                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <button title="Chi tiết" type="button" class="btn" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $item->id }}">
                                                <i class="fa text-danger fa-folder-open"></i>

                                            </button>
                                            <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Chi tiết
                                                                đơn hàng</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @foreach ($item->detailOrders as $order)
                                                                <div style="background-color: #f3f3f3; border-radius: 5px; border: 1px solid #e0e0e0;"
                                                                    class="p-3 mb-3">
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center">
                                                                        <div class="d-flex align-items-center">
                                                                            <img src="{{ Storage::url($order->product->image) }}"
                                                                                height="70" width="70"
                                                                                alt="Bánh bao" class="rounded">
                                                                            <div class="ms-3">
                                                                                <h6 class="mb-1">
                                                                                    {{ $order->product->name }}</h6>
                                                                                <span class="text-muted">Số lượng:
                                                                                    <strong>{{ $order->quantity }}</strong></span>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <h6 class="text-danger mb-0">
                                                                                {{ number_format($order->price) }}đ</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                            <h5>Tổng giá tiền : {{ number_format($item->total) }} VNĐ</h5>
                                                        </div>
                                                        <div class="modal-footer">
                                                            @if ($item->status_order_id == 1)
                                                                <form
                                                                    action="{{ route('client.updateHistory', $item->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="submit"
                                                                        onclick="return confirm('Bạn có muốn hủy đơn hàng này không?')"
                                                                        class="btn btn-danger">Hủy đơn hàng</button>
                                                                </form>
                                                            @endif
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Đóng</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <style>
                            .pagination {
                                display: flex;
                            }
                        </style>
                        {{ $historys->links() }}
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                        tabindex="0">
                        <table class="table">
                            <thead class="text-center">
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Trạng thái đơn</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Ngày đặt</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($historys as $item)
                                    @if ($item->status_order_id != 7)
                                        @continue
                                    @endif
                                    <tr class="text-center">
                                        <td class="fw-bold">{{ $item->id }}</td>
                                        <td
                                            class="@if ($item->status_order_id == 6) text-danger
                                            @elseif ($item->status_order_id == 5)
                                            text-primary
                                        @else
                                            text-info @endif">
                                            {{ $item->statusOrder->name }}</td>
                                        <td>{{ $item->payment_method ? 'Thanh toán onlline' : 'Thanh toán khi nhận hàng' }}
                                        </td>
                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <button title="Chi tiết" type="button" class="btn"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal2{{ $item->id }}">
                                                <i class="fa text-danger fa-folder-open"></i>

                                            </button>
                                            <div class="modal fade" id="exampleModal2{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Chi tiết
                                                                đơn hàng</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @foreach ($item->detailOrders as $order)
                                                                <div style="background-color: #f3f3f3; border-radius: 5px; border: 1px solid #e0e0e0;"
                                                                    class="p-3 mb-3">
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center">
                                                                        <div class="d-flex align-items-center">
                                                                            <img src="{{ Storage::url($order->product->image) }}"
                                                                                height="70" width="70"
                                                                                alt="Bánh bao" class="rounded">
                                                                            <div class="ms-3">
                                                                                <h6 class="mb-1">
                                                                                    {{ $order->product->name }}</h6>
                                                                                <span class="text-muted">Số lượng:
                                                                                    <strong>{{ $order->quantity }}</strong></span>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <h6 class="text-danger mb-0">
                                                                                {{ number_format($order->price) }}đ</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                            <h5>Tổng giá tiền : {{ number_format($item->total) }} VNĐ</h5>
                                                        </div>
                                                        <div class="modal-footer">
                                                            @if ($item->status_order_id == 1)
                                                                <form
                                                                    action="{{ route('client.updateHistory', $item->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="submit"
                                                                        onclick="return confirm('Bạn có muốn hủy đơn hàng này không?')"
                                                                        class="btn btn-danger">Hủy đơn hàng</button>
                                                                </form>
                                                            @endif
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Đóng</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="nav-confirm" role="tabpanel" aria-labelledby="nav-confirm-tab"
                        tabindex="0">
                        <table class="table">
                            <thead class="text-center">
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Trạng thái đơn</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Ngày đặt</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($historys as $item)
                                    @if ($item->status_order_id != 1)
                                        @continue
                                    @endif
                                    <tr class="text-center">
                                        <td class="fw-bold">{{ $item->id }}</td>
                                        <td
                                            class="@if ($item->status_order_id == 6) text-danger
                                            @elseif ($item->status_order_id == 5)
                                            text-primary
                                        @else
                                            text-info @endif">
                                            {{ $item->statusOrder->name }}</td>
                                        <td>{{ $item->payment_method ? 'Thanh toán onlline' : 'Thanh toán khi nhận hàng' }}
                                        </td>
                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <button title="Chi tiết" type="button" class="btn" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal3{{ $item->id }}">
                                                <i class="fa text-danger fa-folder-open"></i>

                                            </button>
                                            <div class="modal fade" id="exampleModal3{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Chi tiết
                                                                đơn hàng</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @foreach ($item->detailOrders as $order)
                                                                <div style="background-color: #f3f3f3; border-radius: 5px; border: 1px solid #e0e0e0;"
                                                                    class="p-3 mb-3">
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center">
                                                                        <div class="d-flex align-items-center">
                                                                            <img src="{{ Storage::url($order->product->image) }}"
                                                                                height="70" width="70"
                                                                                alt="Bánh bao" class="rounded">
                                                                            <div class="ms-3">
                                                                                <h6 class="mb-1">
                                                                                    {{ $order->product->name }}</h6>
                                                                                <span class="text-muted">Số lượng:
                                                                                    <strong>{{ $order->quantity }}</strong></span>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <h6 class="text-danger mb-0">
                                                                                {{ number_format($order->price) }}đ</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                            <h5>Tổng giá tiền : {{ number_format($item->total) }} VNĐ</h5>
                                                        </div>
                                                        <div class="modal-footer">
                                                            @if ($item->status_order_id == 1)
                                                                <form
                                                                    action="{{ route('client.updateHistory', $item->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="submit"
                                                                        onclick="return confirm('Bạn có muốn hủy đơn hàng này không?')"
                                                                        class="btn btn-danger">Hủy đơn hàng</button>
                                                                </form>
                                                            @endif
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Đóng</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="nav-processing" role="tabpanel" aria-labelledby="nav-processing-tab"
                        tabindex="0">
                        <table class="table">
                            <thead class="text-center">
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Trạng thái đơn</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Ngày đặt</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($historys as $item)
                                    @if ($item->status_order_id != 3)
                                        @continue
                                    @endif
                                    <tr class="text-center">
                                        <td class="fw-bold">{{ $item->id }}</td>
                                        <td
                                            class="@if ($item->status_order_id == 6) text-danger
                                            @elseif ($item->status_order_id == 5)
                                            text-primary
                                        @else
                                            text-info @endif">
                                            {{ $item->statusOrder->name }}</td>
                                        <td>{{ $item->payment_method ? 'Thanh toán onlline' : 'Thanh toán khi nhận hàng' }}
                                        </td>
                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <button title="Chi tiết" type="button" class="btn" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal4{{ $item->id }}">
                                                <i class="fa text-danger fa-folder-open"></i>

                                            </button>
                                            <div class="modal fade" id="exampleModal4{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Chi tiết
                                                                đơn hàng</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @foreach ($item->detailOrders as $order)
                                                                <div style="background-color: #f3f3f3; border-radius: 5px; border: 1px solid #e0e0e0;"
                                                                    class="p-3 mb-3">
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center">
                                                                        <div class="d-flex align-items-center">
                                                                            <img src="{{ Storage::url($order->product->image) }}"
                                                                                height="70" width="70"
                                                                                alt="Bánh bao" class="rounded">
                                                                            <div class="ms-3">
                                                                                <h6 class="mb-1">
                                                                                    {{ $order->product->name }}</h6>
                                                                                <span class="text-muted">Số lượng:
                                                                                    <strong>{{ $order->quantity }}</strong></span>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <h6 class="text-danger mb-0">
                                                                                {{ number_format($order->price) }}đ</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                            <h5>Tổng giá tiền : {{ number_format($item->total) }} VNĐ</h5>
                                                        </div>
                                                        <div class="modal-footer">
                                                            @if ($item->status_order_id == 1)
                                                                <form
                                                                    action="{{ route('client.updateHistory', $item->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="submit"
                                                                        onclick="return confirm('Bạn có muốn hủy đơn hàng này không?')"
                                                                        class="btn btn-danger">Hủy đơn hàng</button>
                                                                </form>
                                                            @endif
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Đóng</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="nav-shipping" role="tabpanel" aria-labelledby="nav-shipping-tab"
                        tabindex="0">
                        <table class="table">
                            <thead class="text-center">
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Trạng thái đơn</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Ngày đặt</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($historys as $item)
                                    @if ($item->status_order_id != 4)
                                        @continue
                                    @endif
                                    <tr class="text-center">
                                        <td class="fw-bold">{{ $item->id }}</td>
                                        <td
                                            class="@if ($item->status_order_id == 6) text-danger
                                            @elseif ($item->status_order_id == 5)
                                            text-primary
                                        @else
                                            text-info @endif">
                                            {{ $item->statusOrder->name }}</td>
                                        <td>{{ $item->payment_method ? 'Thanh toán onlline' : 'Thanh toán khi nhận hàng' }}
                                        </td>
                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <button title="Chi tiết" type="button" class="btn" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal5{{ $item->id }}">
                                                <i class="fa text-danger fa-folder-open"></i>

                                            </button>
                                            <div class="modal fade" id="exampleModal5{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Chi tiết
                                                                đơn hàng</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @foreach ($item->detailOrders as $order)
                                                                <div style="background-color: #f3f3f3; border-radius: 5px; border: 1px solid #e0e0e0;"
                                                                    class="p-3 mb-3">
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center">
                                                                        <div class="d-flex align-items-center">
                                                                            <img src="{{ Storage::url($order->product->image) }}"
                                                                                height="70" width="70"
                                                                                alt="Bánh bao" class="rounded">
                                                                            <div class="ms-3">
                                                                                <h6 class="mb-1">
                                                                                    {{ $order->product->name }}</h6>
                                                                                <span class="text-muted">Số lượng:
                                                                                    <strong>{{ $order->quantity }}</strong></span>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <h6 class="text-danger mb-0">
                                                                                {{ number_format($order->price) }}đ</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                            <h5>Tổng giá tiền : {{ number_format($item->total) }} VNĐ</h5>
                                                        </div>
                                                        <div class="modal-footer">
                                                            @if ($item->status_order_id == 1)
                                                                <form
                                                                    action="{{ route('client.updateHistory', $item->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="submit"
                                                                        onclick="return confirm('Bạn có muốn hủy đơn hàng này không?')"
                                                                        class="btn btn-danger">Hủy đơn hàng</button>
                                                                </form>
                                                            @endif
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Đóng</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="nav-completed" role="tabpanel" aria-labelledby="nav-completed-tab"
                        tabindex="0">
                        <table class="table">
                            <thead class="text-center">
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Trạng thái đơn</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Ngày đặt</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($historys as $item)
                                    @if ($item->status_order_id != 5)
                                        @continue
                                    @endif
                                    <tr class="text-center">
                                        <td class="fw-bold">{{ $item->id }}</td>
                                        <td
                                            class="@if ($item->status_order_id == 6) text-danger
                                            @elseif ($item->status_order_id == 5)
                                            text-primary
                                        @else
                                            text-info @endif">
                                            {{ $item->statusOrder->name }}</td>
                                        <td>{{ $item->payment_method ? 'Thanh toán onlline' : 'Thanh toán khi nhận hàng' }}
                                        </td>
                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <button title="Chi tiết" type="button" class="btn" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal6{{ $item->id }}">
                                                <i class="fa text-danger fa-folder-open"></i>

                                            </button>
                                            <div class="modal fade" id="exampleModal6{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Chi tiết
                                                                đơn hàng</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @foreach ($item->detailOrders as $order)
                                                                <div style="background-color: #f3f3f3; border-radius: 5px; border: 1px solid #e0e0e0;"
                                                                    class="p-3 mb-3">
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center">
                                                                        <div class="d-flex align-items-center">
                                                                            <img src="{{ Storage::url($order->product->image) }}"
                                                                                height="70" width="70"
                                                                                alt="Bánh bao" class="rounded">
                                                                            <div class="ms-3">
                                                                                <h6 class="mb-1">
                                                                                    {{ $order->product->name }}</h6>
                                                                                <span class="text-muted">Số lượng:
                                                                                    <strong>{{ $order->quantity }}</strong></span>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <h6 class="text-danger mb-0">
                                                                                {{ number_format($order->price) }}đ</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                            <h5>Tổng giá tiền : {{ number_format($item->total) }} VNĐ</h5>
                                                        </div>
                                                        <div class="modal-footer">
                                                            @if ($item->status_order_id == 1)
                                                                <form
                                                                    action="{{ route('client.updateHistory', $item->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="submit"
                                                                        onclick="return confirm('Bạn có muốn hủy đơn hàng này không?')"
                                                                        class="btn btn-danger">Hủy đơn hàng</button>
                                                                </form>
                                                            @endif
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Đóng</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="nav-cancelled" role="tabpanel" aria-labelledby="nav-cancelled-tab"
                        tabindex="0">
                        <table class="table">
                            <thead class="text-center">
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Trạng thái đơn</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Ngày đặt</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($historys as $item)
                                    @if ($item->status_order_id != 6)
                                        @continue
                                    @endif
                                    <tr class="text-center">
                                        <td class="fw-bold">{{ $item->id }}</td>
                                        <td
                                            class="@if ($item->status_order_id == 6) text-danger
                                            @elseif ($item->status_order_id == 5)
                                            text-primary
                                        @else
                                            text-info @endif">
                                            {{ $item->statusOrder->name }}</td>
                                        <td>{{ $item->payment_method ? 'Thanh toán onlline' : 'Thanh toán khi nhận hàng' }}
                                        </td>
                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <button title="Chi tiết" type="button" class="btn" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal7  {{ $item->id }}">
                                                <i class="fa text-danger fa-folder-open"></i>

                                            </button>
                                            <div class="modal fade" id="exampleModal7{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Chi tiết
                                                                đơn hàng</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @foreach ($item->detailOrders as $order)
                                                                <div style="background-color: #f3f3f3; border-radius: 5px; border: 1px solid #e0e0e0;"
                                                                    class="p-3 mb-3">
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center">
                                                                        <div class="d-flex align-items-center">
                                                                            <img src="{{ Storage::url($order->product->image) }}"
                                                                                height="70" width="70"
                                                                                alt="Bánh bao" class="rounded">
                                                                            <div class="ms-3">
                                                                                <h6 class="mb-1">
                                                                                    {{ $order->product->name }}</h6>
                                                                                <span class="text-muted">Số lượng:
                                                                                    <strong>{{ $order->quantity }}</strong></span>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <h6 class="text-danger mb-0">
                                                                                {{ number_format($order->price) }}đ</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                            <h5>Tổng giá tiền : {{ number_format($item->total) }} VNĐ</h5>
                                                        </div>
                                                        <div class="modal-footer">
                                                            @if ($item->status_order_id == 1)
                                                                <form
                                                                    action="{{ route('client.updateHistory', $item->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="submit"
                                                                        onclick="return confirm('Bạn có muốn hủy đơn hàng này không?')"
                                                                        class="btn btn-danger">Hủy đơn hàng</button>
                                                                </form>
                                                            @endif
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Đóng</button>
                                                        </div>
                                                    </div>
                                                </div>
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
    </div>
@endsection
