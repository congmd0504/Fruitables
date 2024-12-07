@extends('client.index')
@section('content')
    <style>
        .star-danh_gia {
            direction: rtl;
            font-size: 27px;
            unicode-bidi: bidi-override;
            display: inline-block;
        }

        .star-danh_gia input {
            display: none;
        }

        .star-danh_gia label {
            color: #ddd;
            cursor: pointer;
        }

        .star-danh_gia input:checked~label,
        .star-danh_gia label:hover,
        .star-danh_gia label:hover~label {
            color: #f5b301;
        }
    </style>
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Đánh giá sản phẩm !</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="#">Trang</a></li>
            <li class="breadcrumb-item active text-white">Đánh giá sản phẩm </li>
        </ol>
    </div>
    <div class="container border border-dark mt-4 p-3" style="border-radius: 10px">
        <div class="d-flex">
            <img style="border-radius: 10px"
                src="{{Storage::url($product->image)}}" height="150px"
                width="150px" alt="">
            <div class="m-2">
                <h3>{{$product->name}}</h3>
                <b>Gía : </b><span class="text-danger">{{number_format($product->price)}} VNĐ</span>
            </div>
        </div>
        <form action="{{route('client.postReview')}}" method="POST">
            @csrf
            <div class="text-center">
                <div class="star-danh_gia">
                    <input type="radio" id="star5" name="star" value="5"><label
                        for="star5">&#9733;</label>
                    <input type="radio" id="star4" name="star" value="4"><label
                        for="star4">&#9733;</label>
                    <input type="radio" id="star3" name="star" value="3"><label
                        for="star3">&#9733;</label>
                    <input type="radio" id="star2" name="star" value="2"><label
                        for="star2">&#9733;</label>
                    <input type="radio" id="star1" name="star" value="1"><label
                        for="star1">&#9733;</label>
                </div> 
                <div class="mt-2 mb-3">
                    <span class="text-dark">Đánh giá sản phẩm này <span class="text-danger">*</span></span>
                </div>
            </div>
            <div>
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <input type="hidden" name="user_id" value="{{Auth::id()}}">
                <textarea name="content" id="" cols="30" rows="5" class="form-control" placeholder="Viết đánh giá của bạn vào đấy.."></textarea>
                <button type="submit" class="btn btn-success m-2" >Gửi đánh giá</button>
            </div>
        </form>
    </div>
@endsection
