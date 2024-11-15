<div class="container py-2">
    <h1 class="mb-0">Sản Phẩm Liên Quan </h1>
    <div class="owl-carousel vegetable-carousel mt-5 justify-content-center">
        @foreach ($allProduct as $item)
            @if ($item->id == $product->id)
                @continue
            @endif
            @if ($item->category->id == $product->category->id)
                <div class="border border-primary rounded position-relative vesitable-item">
                    <a href="{{route('client.shop-detail',$item->id)}}">
                        <div class="vesitable-img">
                            <img src="{{ Storage::url($item->image) }}" style="height: 200px;object-fit: cover;"
                                class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                            style="top: 10px; right: 10px;">{{ $item->category->name }}</div>
                        <div class="p-4 rounded-bottom">
                            <h4>{{ $item->name }}</h4>
                            <p>{{ $item->description }}</p>
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">
                                    {{ number_format($item->price) }} vnđ
                                </p>
                                <form action="" method="POST" class="mb-0">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                    <button onclick="addCart({{ $product->id }}, {{ Auth::id() }})" type="button" class="btn border border-secondary rounded-pill px-4 py-2 text-primary">
                                        <i class="fa fa-shopping-bag me-2 text-primary"></i> Mua
                                    </button>
                                </form>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        @endforeach
    </div>
</div>
