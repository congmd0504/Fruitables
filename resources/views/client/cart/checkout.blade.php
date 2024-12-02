@extends('client.index')
@section('content')
    <div class="container my-5">
        <h2 class="text-center mb-4 fw-bold">Thanh toán</h2>
        <form action="{{ route('client.order') }}" method="POST" class="row d-flex justify-content-center">
            @csrf
            <div class="col-5">
                <h4 class="fw-bold m-3">Thông tin giao hàng</h4>
                <div class="">
                    <input type="text" class="form-control mt-3 text-dark" name="fullname"
                        value="{{ Auth::user()->fullname }}" placeholder="Nhập họ và tên..">
                    <input type="email" class="form-control mt-3 text-dark" value="{{ Auth::user()->email }}"
                        placeholder="Nhập email..">
                    <input type="address" class="form-control mt-3 text-dark" name="address"
                        value="{{ Auth::user()->address }}" placeholder="Nhập địa chỉ..">
                    <input type="number" class="form-control mt-3 text-dark" name="phone"
                        value="{{ Auth::user()->phone }}" placeholder="Nhập số điện thoại..">
                    <textarea name="note" class="form-control mt-3 text-dark" id="" cols="30" rows="8"
                        placeholder="Ghi chú (ví dụ như số nhà, địa chỉ cụ thể..).."></textarea>
                </div>
                <div class="m-3">
                    <h3 class="fw-bold ">Phương thức thanh toán</h3>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="flexRadioDefault1" checked
                            value="0">
                        <label class="form-check-label fw-bold" for="flexRadioDefault1">
                            Thanh toán sau khi nhận hàng (COD)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input " type="radio" name="payment_method" id="flexRadioDefault2"
                            value="1">
                        <label class="form-check-label fw-bold" for="flexRadioDefault2">
                            Thanh toán onlline
                        </label>
                    </div>
                </div>

            </div>
            <div class="col-5">
                <h4 class="fw-bold m-3">Đơn hàng của bạn️ ️</h4>
                <div class="border rounded p-4 ">
                    <h5 class="fw-bolder">Tổng giỏ hàng : {{ $totalCart }} </h5>
                    <hr>
                    <h5 class="fw-semibold">Danh sách đơn hàng 🛍️</h5>
                    @foreach ($listCart as $item)
                        <div class="row mt-4 ">
                            <div class="col-2">
                                <img src="{{ Storage::url($item->product->image) }}" style="height: 50px" width="50px"
                                    alt="">
                            </div>
                            <div class="col-6">
                                <span>{{ $item->product->name }}</span> <br>
                                <span>x{{ $item->quantity }}</span>
                            </div>
                            <div class="col-4 d-flex align-items-center">
                                <b>{{ number_format($item->product->price * $item->quantity) }} VNĐ</b>
                            </div>
                        </div>
                        <hr>
                        <input type="hidden" name="product_id[]" value="{{ $item->product->id }}">
                        <input type="hidden" name="quantity[]" value="{{ $item->quantity }}">
                        <input type="hidden" name="price[]" value="{{ $item->product->price * $item->quantity }}">
                        @php
                            $tongtien += $item->product->price * $item->quantity;
                        @endphp
                    @endforeach
                    <input type="hidden" id="totalAll" value="{{ $tongtien }}">
                    <div class="accordion accordion-flush border " id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    Mã giảm giá
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                @foreach ($listDiscount as $item)
                                    <div class="d-flex p-2 border justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <img class="rounded-circle" src="{{ Storage::url('user/sale.png') }}"
                                                alt="" height="40px">
                                            <div class="ms-2">
                                                <span class="text-dark fw-bold ">-{{ $item->discount }}%</span> <br>
                                                <span
                                                    style="font-size: 10px">{{ \Carbon\Carbon::parse($item->end_date)->format('d-m-Y') }}</span>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            @if($item->quantity == 0)
                                                <span class="badge bg-warning rounded-pill text-bg-primary">Đã hết</span>
                                            @elseif ($item->end_date >= date('Y-m-d'))
                                            <button type="button" onclick="applyDiscount({{ $item->discount }}, event,{{$item->id}})" class="badge bg-primary rounded-pill border">Sử dụng</button>
                                            @elseif ($item->end_date < date('Y-m-d'))
                                                <span class="badge bg-danger rounded-pill text-bg-primary">Hết hạn</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <h5 class="fw-bold">Tổng tiền :</h5>
                        <h5 class="fw-bold" id="tong_tien_display">{{ number_format($tongtien) }} VNĐ</h5>
                        <input type="hidden" id="tong_tien" name="total" value="{{ $tongtien }}">
                        <input type="hidden" name="idDiscount" id="idDiscount" value="0">
                    </div>
                    <button title="submit" class="mt-3 border rounded-pill ; fw-bold ; text-light"
                        style="width: 100%; height: 50px; background-color: #81c408">TIẾN HÀNH ĐẶT HÀNG </button>
                </div>️
            </div>
        </form>
    </div>
@section('javascript')
    <script>
        function applyDiscount(discount, event,id) {
            event.preventDefault();
            const tong_tien_input = document.getElementById('tong_tien');
            const totalAll = document.getElementById('totalAll');
            
            let tong_tien = parseFloat(totalAll.value);

            const total = tong_tien - (tong_tien * discount / 100);
            tong_tien_input.value = total;
            document.getElementById('idDiscount').value = id;

            let formattedTotal = new Intl.NumberFormat('vi-VN').format(total);
            document.getElementById('tong_tien_display').textContent = formattedTotal + ' VNĐ';

            toastr.success('Áp dụng thành công !');
        }
    </script>
@endsection
@endsection
