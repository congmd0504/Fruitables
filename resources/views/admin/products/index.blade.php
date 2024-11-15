@extends('admin.home')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Sản phẩm</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Sản phẩm</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Danh sách sản phẩm</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Danh sách sản phẩm</h4>
                            <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-round ms-auto">
                                <i class="fa fa-plus"></i>
                                Thêm mới sản phẩm
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th>STT</th>
                                    <th>TÊN SẢN PHẨM</th>
                                    <th>GÍA SẢN PHẨM</th>
                                    <th>SỐ LƯỢNG</th>
                                    <th>HÌNH ẢNH</th>
                                    <th>NHÃN</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $index => $product)
                                    <tr class="text-center">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ number_format($product->price) }} VNĐ</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>
                                            @if ($product->image)
                                                <img src="{{ Storage::url($product->image) }}" height="50px"
                                                    alt="">
                                            @endif
                                        </td>
                                        <td>
                                            @foreach ($product->tags as $tag)
                                                <span class="badge text-bg-{{ $tag->color }}">{{ $tag->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="form-button-action ">
                                                <button type="button" class="btn btn-link btn-primary "
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $index }}">
                                                    <i class="fa fa-exclamation"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal{{ $index }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Chi tiết
                                                                    sản phẩm : {{ $product->name }}</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-body row">
                                                                    <div class="col-6 text-start">
                                                                        <label for="name" class=" fw-bold">Tên sản
                                                                            phẩm:</label>
                                                                        <input type="text" name="name"
                                                                            class="form-control mt-2"
                                                                            value="{{ $product->name }}" disabled>
                                                                        <label for="price" class=" fw-bold">Gía sản
                                                                            phẩm:</label>
                                                                        <input type="text" name="price"
                                                                            class="form-control mt-2"
                                                                            value="{{ $product->price }}" disabled>
                                                                        <label for="weight" class=" fw-bold">Trọng lượng
                                                                            sản phẩm:</label>
                                                                        <input type="text" name="weight"
                                                                            class="form-control mt-2"
                                                                            value="{{ $product->weight }}" disabled>
                                                                        <label for="quality" class=" fw-bold">Số lượng sản
                                                                            phẩm:</label>
                                                                        <input type="text" name="quantity"
                                                                            class="form-control mt-2"
                                                                            value="{{ $product->quantity }}" disabled>
                                                                        <label for="title" class=" fw-bold">Danh mục
                                                                            :</label>
                                                                        <input type="text" name="category_id"
                                                                            class="form-control mt-2"
                                                                            value="{{ $product->category->name }}"
                                                                            disabled>
                                                                    </div>
                                                                    <div class="col-6 text-start">
                                                                        <label for="view" class=" fw-bold">Lượt
                                                                            Xem:</label>
                                                                        <input type="text" name="view"
                                                                            class="form-control mt-2"
                                                                            value="{{ $product->view }}" disabled>
                                                                        <label for="description" class=" fw-bold">Mô tả
                                                                            ngắn:</label>
                                                                        <input type="text" name="description"
                                                                            class="form-control mt-2"
                                                                            value="{{ $product->description }}" disabled>
                                                                        <label for="content" class=" fw-bold">Mô tả
                                                                            :</label>
                                                                        <textarea name="content" id="" class="form-control" disabled cols="30" rows="3">{{ $product->content }}</textarea>
                                                                        <label for="quantity" class="fw-bold">Nhãn
                                                                            :</label>
                                                                        <div class="">
                                                                            @foreach ($tags as $tag)
                                                                                @if ($product->tags->contains($tag->id))
                                                                                    <span
                                                                                        class="badge text-bg-{{ $tag->color }}">{{ $tag->name }}</span>
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                        <div class=" mt-3 d-flex align-items-center">
                                                                            <label for="image" class="fw-bold me-3">Ảnh
                                                                                sản phẩm:</label> <br>
                                                                            @if ($product->image)
                                                                                <img src="{{ Storage::url($product->image) }}"
                                                                                    height="90px" alt="">
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="mt-2">|</span>
                                                <button type="button" class="btn btn-link btn-primary "
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal2{{ $index }}">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal2{{ $index }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <form action="{{ route('admin.products.update', $product) }}"
                                                            method="POST" enctype="multipart/form-data"
                                                            class="modal-content">
                                                            @csrf
                                                            @method('PUT')

                                                            @if ($errors->any())
                                                                <div class="alert alert-danger">
                                                                    <ul>
                                                                        @foreach ($errors->all() as $error)
                                                                            <li>{{ $error }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @endif

                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Cập
                                                                    nhật sản phẩm: {{ $product->name }}</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div class="card-body row">
                                                                    <div class="col-6 text-start">
                                                                        <label for="name" class="fw-bold">Tên sản
                                                                            phẩm:</label>
                                                                        <input type="text" name="name"
                                                                            class="form-control mt-2"
                                                                            value="{{ old('name', $product->name) }}">

                                                                        <label for="price" class="fw-bold">Giá sản
                                                                            phẩm:</label>
                                                                        <input type="text" name="price"
                                                                            class="form-control mt-2"
                                                                            value="{{ old('price', $product->price) }}">

                                                                        <label for="weight" class="fw-bold">Trọng lượng
                                                                            sản phẩm:</label>
                                                                        <input type="text" name="weight"
                                                                            class="form-control mt-2"
                                                                            value="{{ old('weight', $product->weight) }}">

                                                                        <label for="quantity" class="fw-bold">Số lượng sản
                                                                            phẩm:</label>
                                                                        <input type="text" name="quantity"
                                                                            class="form-control mt-2"
                                                                            value="{{ old('quantity', $product->quantity) }}">
                                                                        <label for="category_id" class="fw-bold">Danh
                                                                            mục:</label>
                                                                        <select name="category_id" class="form-select">
                                                                            @foreach ($categories as $cate)
                                                                                <option value="{{ $cate->id }}"
                                                                                    @if ($product->category->id == $cate->id) selected @endif>
                                                                                    {{ $cate->name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-6 text-start">
                                                                        <label for="description" class="fw-bold">Mô tả
                                                                            ngắn:</label>
                                                                        <input type="text" name="description"
                                                                            class="form-control mt-2"
                                                                            value="{{ old('description', $product->description) }}">

                                                                        <label for="content" class="fw-bold">Mô
                                                                            tả:</label>
                                                                        <textarea name="content" class="form-control" cols="30" rows="3">{{ old('content', $product->content) }}</textarea>
                                                                        <label for="quantity" class="fw-bold">Nhãn
                                                                            :</label>
                                                                        <div class="form-check ms-2 d-flex">
                                                                            @foreach ($tags as $tag)
                                                                                <input class="form-check-input"
                                                                                    name="tags[]" type="checkbox"
                                                                                    @if ($product->tags->contains($tag->id)) checked @endif
                                                                                    value="{{ $tag->id }}"
                                                                                    id="defaultCheck{{ $tag->id }}">
                                                                                <label
                                                                                    class="form-check-label text-{{ $tag->color }}"
                                                                                    for="defaultCheck{{ $tag->id }}">
                                                                                    {{ $tag->name }} </label>
                                                                            @endforeach
                                                                        </div>
                                                                        <div class="mt-2">
                                                                            <label for="image" class="fw-bold">Ảnh sản
                                                                                phẩm:</label>
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <input type="file" name="image"
                                                                                        class="form-control mt-2">
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    @if ($product->image)
                                                                                        <img src="{{ Storage::url($product->image) }}"
                                                                                            height="90px" alt="">
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Đóng</button>
                                                                <button type="submit" class="btn btn-primary">Cập
                                                                    nhật</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                </a><span class="mt-2">|</span>
                                                <form action="{{ route('admin.products.destroy', $product) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Bạn có muốn xóa không ?')"
                                                        type="submit" title="Xóa" class="btn btn-link btn-danger">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div style="width: 95%;" class="d-flex justify-content-end p-2"> {{ $products->links() }} </div>
                </div>
            </div>
        </div>
    @endsection
