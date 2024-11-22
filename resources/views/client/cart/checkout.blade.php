@extends('client.index')
@section('content')
    <div class="container my-5">
        <h2 class="text-center mb-4 fw-bold">Thanh toán</h2>
        <form action="{{route('client.order')}}" method="POST" class="row d-flex justify-content-center">
            @csrf
            <div class="col-5">
                <h4 class="fw-bold m-3">Thông tin giao hàng</h4>
                <div class="">
                    <input type="text" class="form-control mt-3 text-dark" name="fullname" value="{{ Auth::user()->fullname }}"
                        placeholder="Nhập họ và tên..">
                    <input type="email" class="form-control mt-3 text-dark" value="{{ Auth::user()->email }}"
                        placeholder="Nhập email..">
                    <input type="address" class="form-control mt-3 text-dark" name="address" value="{{ Auth::user()->address }}"
                        placeholder="Nhập địa chỉ..">
                    <input type="number" class="form-control mt-3 text-dark" name="phone" value="{{ Auth::user()->phone }}"
                        placeholder="Nhập số điện thoại..">
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
                        <input type="hidden" name="product_id[]" value="{{$item->product->id}}">
                        <input type="hidden" name="quantity[]" value="{{$item->quantity}}">
                        <input type="hidden" name="price[]" value="{{$item->product->price * $item->quantity}}">
                        @php
                            $tongtien += $item->product->price * $item->quantity;
                        @endphp
                    @endforeach
                    <div class="d-flex justify-content-between mt-3">
                        <h5 class="fw-bold">Tổng tiền :</h5>
                        <h5 class="fw-bold">{{ number_format($tongtien) }} VNĐ</h5>
                        <input type="hidden" name="total" value="{{$tongtien}}">
                    </div>
                    <button class="mt-3 border rounded-pill ; fw-bold ; text-light"
                        style="width: 100%; height: 50px; background-color: #81c408">TIẾN HÀNH ĐẶT HÀNG </button>
                </div>️
            </div>
        </form>
    </div>
@endsection
