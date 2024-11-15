<div class="container py-5">
    <h1 class="mb-0">Sản Phẩm Của Chúng Tôi</h1>
    <div class="owl-carousel vegetable-carousel justify-content-center">
        @foreach ($allProduct as $product)
            <div class="border border-primary rounded position-relative vesitable-item">
                <a href="{{ route('client.shop-detail', $product) }}">
                    <div class="vesitable-img">
                        <img src="{{ Storage::url($product->image) }}" style="height: 200px;object-fit: cover;"
                            class="img-fluid w-100 rounded-top" alt="">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                        style="top: 10px; right: 10px;">{{ $product->category->name }}</div>
                    <div class="p-4 rounded-bottom">
                        <h4>{{ $product->name }}</h4>
                        <p>{{ $product->description }}</p>
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">
                                {{ number_format($product->price) }} vnđ
                            </p>
                </a>
                <button onclick="addCart({{ $product->id }}, {{ Auth::id() }})" type="button"
                    class="btn border border-secondary rounded-pill px-4 py-2 text-primary">
                    <i class="fa fa-shopping-bag me-2 text-primary"></i> Mua
                </button>
            </div>
    </div>

</div>
@endforeach
</div>
</div>
