@extends('client.index')
@section('content')
    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5 hero-header">
        @include('client.layouts.home.hero')
    </div>
    <!-- Hero End -->

    {{-- Danh sách sản phẩm hot --}}
    <div class="container-fluid vesitable ">
        @include('client.layouts.product-hot')
    </div>
    {{-- Kết thúc sản phẩm hot --}}

    <!-- Bestsaler Product Start -->
    <div class="container-fluid py-3">
        @include('client.layouts.home.bestsaler')
    </div>
    <!-- Bestsaler Product End -->

    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-3">
        <div class="container py-5">
            <div class="tab-class text-center">
                <div class="row g-4">
                    <div class="col-lg-4 text-start">
                        <h1>Sản Phẩm Mới Nhất</h1>
                    </div>
                    <div class="col-lg-8 text-end">
                        <ul class="nav nav-pills d-inline-flex text-center mb-5">
                            @foreach ($categories as $category)
                                @if ($category->id == 1)
                                    <li class="nav-item">
                                        <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill"
                                            href="#tab-1">
                                            <span class="text-dark" style="width: 130px;">{{ $category->name }}</span>
                                        </a>
                                    </li>
                                    @continue
                                @endif
                                <li class="nav-item">
                                    <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill"
                                        href="#tab-{{ $category->id }}">
                                        <span class="text-dark" style="width: 130px;">{{ $category->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    @foreach ($allProduct as $product)
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <a href="{{route('client.shop-detail',$product)}}" class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img style="max-height: 200px ;object-fit: cover;"
                                                        src="{{ Storage::url($product->image) }}"
                                                        class="img-fluid w-100 rounded-top" alt="">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                    style="top: 10px; left: 35%;">{{ $product->category->name }}</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>{{ $product->name }}</h4>
                                                    <p>{{ $product->description }}</p>
                                                    <div
                                                        class="d-flex justify-content-between align-items-center flex-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">
                                                            {{ number_format($product->price) }} vnđ
                                                        </p>
                                            </a>
                                            <button onclick="addCart({{ $product->id }}, {{ Auth::id() }})"
                                                type="button"
                                                class="btn border border-secondary rounded-pill px-4 py-2 text-primary">
                                                <i class="fa fa-shopping-bag me-2 text-primary"></i> Add
                                            </button>
                                        </div>
                                </div>

                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($categories as $cate)
                <div id="tab-{{ $cate->id }}" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                @foreach ($allProduct as $product)
                                    @if ($product->category->id != $cate->id)
                                        @continue
                                    @endif
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <a href="{{route('client.shop-detail',$product)}}">
                                            <div class="rounded position-relative fruite-item">
                                                <div class="fruite-img">
                                                    <img style="max-height: 200px ;object-fit: cover;"
                                                        src="{{ Storage::url($product->image) }}"
                                                        class="img-fluid w-100 rounded-top" alt="">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute text-end"
                                                    style="top: 10px; left: 50%;">{{ $product->category->name }}</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>{{ $product->name }}</h4>
                                                    <p>{{ $product->description }}</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">
                                                            {{ number_format($product->price) }}vnđ</p>
                                                        <form action="" method="POST" class="mb-0">
                                                            @csrf
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $product->id }}">
                                                            <input type="hidden" name="quantity" value="1">
                                                            <input type="hidden" name="user_id"
                                                                value="{{ Auth::id() }}">
                                                            <button type="submit"
                                                                class="btn border border-secondary rounded-pill px-4 py-2 text-primary">
                                                                <i class="fa fa-shopping-bag me-2 text-primary"></i> Add
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <!-- Fruits Shop End-->


    <!-- Featurs Start -->
    <div class="container-fluid service py-3">
        <div class="container py-5">
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <a href="#">
                        <div class="service-item bg-secondary rounded border border-secondary">
                            <img src="client/img/featur-1.jpg" class="img-fluid rounded-top w-100" alt="">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-primary text-center p-4 rounded">
                                    <h5 class="text-white">Fresh Apples</h5>
                                    <h3 class="mb-0">20% OFF</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="#">
                        <div class="service-item bg-dark rounded border border-dark">
                            <img src="client/img/featur-2.jpg" class="img-fluid rounded-top w-100" alt="">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-light text-center p-4 rounded">
                                    <h5 class="text-primary">Tasty Fruits</h5>
                                    <h3 class="mb-0">Free delivery</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="#">
                        <div class="service-item bg-primary rounded border border-primary">
                            <img src="client/img/featur-3.jpg" class="img-fluid rounded-top w-100" alt="">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-secondary text-center p-4 rounded">
                                    <h5 class="text-white">Exotic Vegitable</h5>
                                    <h3 class="mb-0">Discount 30$</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Featurs End -->


    <!-- Vesitable Shop Start-->
    <div class="container-fluid vesitable py-3">
        @include('client.layouts.vesitablde-shop')
    </div>
    <!-- Vesitable Shop End -->


    <!-- Banner Section Start-->
    <div class="container-fluid banner bg-secondary py-3">
        @include('client.layouts.home.banner')
    </div>
    <!-- Banner Section End -->


    <!-- Featurs Section Start -->
    <div class="container-fluid featurs ">
        @include('client.layouts.home.featurs')
    </div>
    <!-- Featurs Section End -->


    <!-- Tastimonial Start -->
    <div class="container-fluid testimonial py-3">
        @include('client.layouts.home.tastimonial')
    </div>
    <!-- Tastimonial End -->
@endsection
