@extends('client.index')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Chi tiết sản phẩm</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="#">Trang</a></li>
            <li class="breadcrumb-item active text-white">{{$product->name}}</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <div class="row g-4 ">
                        <div class="col-lg-6">
                            <div class="border rounded">
                                <a href="#">
                                    <img src="{{ Storage::url($product->image) }}" class="img-fluid rounded" alt="Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-5 ms-2">
                            <div class="d-flex mt-2">
                                <h4 class="fw-bold mb-3">{{ $product->name }}</h4>
                                <p class="m-1">({{ $product->category->name }})</p>
                            </div>
                            <h5 class="fw-bold mb-3">{{ $product->price }} VNĐ</h5>
                            <div class="d-flex mb-4">
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <p class="mb-4">{{ $product->description }}</p>

                            <div class="input-group quantity mb-5" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text"
                                    class="form-control form-control-sm text-center border-0 quantity-input" value="1"
                                    id="quantityProduct" min="1" name="quantity">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <button onclick="addCart({{ $product->id }}, {{ Auth::id() }})" type="button"
                                class="btn border border-secondary rounded-pill px-4 py-2 text-primary">
                                <i class="fa fa-shopping-bag me-2 text-primary"></i> Thêm Vào Giỏ Hàng
                            </button>


                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    // Lấy các nút và input số lượng
                                    const minusBtn = document.querySelector('.btn-minus');
                                    const plusBtn = document.querySelector('.btn-plus');
                                    const quantityInput = document.querySelector('.quantity-input');
                                });
                            </script>

                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button"
                                        role="tab" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                        aria-controls="nav-about" aria-selected="true">Mô tả </button>
                                    <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">Bình luận</button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                    <p>{{ $product->content }}</p>
                                    <div class="px-2">
                                        <div class="row g-4">
                                            <div class="col-6">
                                                <div
                                                    class="row bg-light align-items-center text-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Weight</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">{{ $product->weight }} g</p>
                                                    </div>
                                                </div>

                                                <div
                                                    class="row bg-light text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Quality</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">{{ $product->quantity }}</p>
                                                    </div>
                                                </div>
                                                <div class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Сheck</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">Healthy</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                    <div id="comments-container">
                                        @if (count($product->comments) > 0)
                                            @foreach ($product->comments as $comment)
                                                <div class="d-flex">
                                                    <img src="{{ Storage::url($comment->user->image) }}"
                                                        class="img-fluid rounded-circle p-3"
                                                        style="width: 100px; height: 100px;" alt="">
                                                    <div class="mt-4">
                                                        <h5>{{ $comment->user->username }}</h5>
                                                        <p>{{ $comment->content }}</p>
                                                        <p style="font-size:11px; margin:-10px 0">
                                                            {{ $comment->created_at }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h4 class="mb-2 fw-bold">Bình luận</h4>
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="border rounded my-4">
                                        <textarea name="content" id="content" class="form-control border-0" cols="20" rows="6"
                                            placeholder="Bình luận *" spellcheck="false"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div> <button type="button"
                                            class="btn border border-secondary text-primary rounded-pill px-4 py-3 me-3"
                                            onclick="addComment({{ $product->id }}, {{ Auth::id() }})"> Bình luận
                                        </button> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="row g-4 fruite">
                        @include('client.layouts.category-shop')
                    </div>
                </div>
            </div>

            @include('client.layouts.related-products')
        </div>
    </div>
    <!-- Single Product End -->
@section('javascript')
    <script type="text/javascript">
        function addComment(productId, userId) {
            var content = $('#content').val();
            if (content.trim() === '') {
                toastr.error('Vui lòng nhập nội dung bình luận.');
                return;
            }
            $.ajax({
                url: '{{ route('client.postComment') }}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "product_id": productId,
                    "user_id": userId,
                    "content": content,
                },
                success: function(response) {
                    toastr.success('Bình luận thành công!');
                    $('#content').val('');
                    var newComment =
                        ` <div class="d-flex"> <img src="{{ Auth::user()->image ? Storage::url(Auth::user()->image) : 'default-avatar.png' }}" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt=""> <div class="mt-4"> <h5>{{ Auth::user()->username }}</h5> <p>` +
                        content +
                        `</p> <p style="font-size:11px; margin:-10px 0">Vừa xong</p> </div> </div><hr>`;
                    $('#comments-container').append(newComment);
                },
                error: function(xhr) {
                    toastr.error('Bình luận thất bại!');
                }
            });
        }
    </script>
@endsection
@endsection
