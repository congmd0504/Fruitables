@extends('client.index')
@section('content')
    <style>
        .container-custom {
            max-width: 1020px;
        }
    </style>
    <div class="container container-custom my-5">
        <div class="invoice-header mb-5 text-center">
            <h3>❤️ Cảm ơn bạn ❤️</h3>
            <p class="text-start">
                Cảm ơn quý khách hàng đã lựa chọn <b>Fruitables</b> để mua sắm đồ ăn!
                Chúng tôi rất trân trọng sự ủng hộ của quý vị và hy vọng rằng quý vị sẽ thưởng thức những sản phẩm tuyệt vời
                mà chúng tôi cung cấp.
                Nếu quý vị có bất kỳ câu hỏi hoặc phản hồi nào, đừng ngần ngại liên hệ với chúng tôi!
                Dưới đây là <b>hóa đơn chi tiết</b> của bạn. ❤️
            </p>
        </div>

        <h3 class="text-center">Hóa đơn chi tiết</h3>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2">Mã đơn: {{$orderDetails->first()->order->id}}</th>
                            <th colspan="2">Thời gian đặt: {{$orderDetails->first()->order->created_at->format('d-m-Y') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="height: 250px" class="text-center">
                            <td colspan="4" class="logo ">
                                <h1 class="text-primary display-6 mt-5 ">Fruitables</h1>
                                <p>Thực Phẩm Tươi Sống & Pack Món Nấu Ngay</p>
                                <p>Phố Trịnh Văn Bô, Xuân Phương, Nam Từ Liêm, Hà Nội</p>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Tên khách hàng:</b></td>
                            <td colspan="3">{{$orderDetails->first()->order->user->fullname}}</td>
                        </tr>
                        <tr>
                            <td><b>Số điện thoại:</b></td>
                            <td colspan="3">{{$orderDetails->first()->order->phone}}</td>
                        </tr>
                        <tr>
                            <td><b>Địa chỉ:</b></td>
                            <td colspan="3">{{$orderDetails->first()->order->address}}</td>
                        </tr>
                        <tr>
                            <td><b>Hình thức thanh toán:</b></td>
                            <td colspan="3">{{$orderDetails->first()->order->payment_method ? "Thanh toán online" : "Thanh toán sau khi nhận hàng " }}</td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered invoice-table">
                    <thead class="table-light text-center">
                        <tr>
                            <th>STT</th>
                            <th>Món ăn</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($orderDetails as $index=>$cart)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$cart->product->name}}</td>
                            <td>{{$cart->quantity}}</td>
                            <td>{{number_format($cart->product->price)}}VNĐ</td>
                        </tr>
                        
                        @endforeach
                        <tr>
                            <td colspan="2"><b>Tổng đơn</b></td>
                            <td colspan="2"><b>{{number_format($orderDetails->first()->order->total)}}VNĐ</b></td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{route('client.index')}}" class="btn btn-danger btn-home" style="width: 100%">Về trang chủ</a>
            </div>
        </div>
    </div>
@endsection
