@extends('client.index')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Cửa hàng</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="#">Trang</a></li>
            <li class="breadcrumb-item active text-white">Cửa hàng</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-9">
                            <h2 class="mb-4">Sản phẩm cửa hàng</h2>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <div class="row g-4">
                                @include('client.layouts.category-shop')
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row g-4 justify-content-center">
                                @if (count($products) == 0)
                                    <div style="width: 100%; height: 300px;" class="d-flex align-items-center justify-content-center">
                                        <h2 class="text-danger">Tạm thời cửa hàng đã hết loại này!</h2>
                                    </div>
                                @else
                                    @foreach ($products as $product)
                                        <div class="col-md-6 col-lg-6 col-xl-4">
                                            <a href="{{route('client.shop-detail',$product)}}" class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img src="{{ Storage::url($product->image) }}" style="height: 230px; object-fit:cover;" class="img-fluid w-100 rounded-top" alt="">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
                                                    {{ $product->category->name }}
                                                </div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>{{ $product->name }}</h4>
                                                    <p>{{ $product->description }}</p>
                                                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">{{ number_format($product->price) }} vnđ</p>
                                                    </a>
                                                    <button onclick="addCart({{ $product->id }}, {{ Auth::id() }})" type="button" class="btn border border-secondary rounded-pill px-4 py-2 text-primary">
                                                        <i class="fa fa-shopping-bag me-2 text-primary"></i> Mua
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->
@endsection

@section('javascript')
@endsection
