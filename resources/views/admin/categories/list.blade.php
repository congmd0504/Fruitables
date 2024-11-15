@extends('admin.home')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Danh mục</h3>
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
                    <a href="#">Danh mục</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Danh sách danh mục</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Danh sách danh mục</h4>
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-round ms-auto">
                                <i class="fa fa-plus"></i>
                                Thêm mới danh mục
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th>STT</th>
                                    <th>TÊN DANH MỤC</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $index => $cate)
                                    <tr class="text-center">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $cate->name }}</td>
                                        <td>
                                            <div class="form-button-action">
                                                <button type="button" class="btn btn-link btn-primary btn-lg"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $index }}">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <div class="modal fade" id="exampleModal{{ $index }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <form action="{{ route('admin.categories.update', $cate->id) }}"
                                                        method="POST" class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Sửa danh
                                                                    mục</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @csrf
                                                                @method('PUT')
                                                                <label for="name" class="fs-5 fw-bold">Tên danh
                                                                    mục:</label>
                                                                <input type="text" name="name"
                                                                    class="form-control mt-2"
                                                                    placeholder="Nhập tên danh mục.."
                                                                    value="{{ $cate->name }}">
                                                                <div class="text-end mt-3 me-2">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Đóng</button>
                                                                <button type="sumit" class="btn btn-primary">Cập
                                                                    nhập</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <form action="{{ route('admin.categories.destroy', $cate->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Bạn có muốn xóa không ?')"
                                                        type="submit" title="Xóa"
                                                        class="btn btn-link btn-danger btn-lg">
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
                </div>
            </div>
        </div>
    @endsection
