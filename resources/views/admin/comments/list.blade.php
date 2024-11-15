@extends('admin.home')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Bình luận </h3>
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
                    <a href="#">Bình luận </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Danh sách bình luận</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Danh sách bình luận</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th>STT</th>
                                    <th>TÊN SẢN PHẨM</th>
                                    <th>SỐ BÌNH LUẬN</th>
                                    <th>HÀNH ĐỘNG</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $index => $product)
                                @if($product->comments_count == 0) @continue @endif
                                    <tr class="text-center">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->comments_count}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$index}}">
                                                <i title="Chi tiết" class="fa fa-folder-open"></i>
                                              </button>

                                            <div class="modal fade" id="exampleModal{{$index}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h1 class="modal-title fs-5" id="exampleModalLabel">Bình luận</h1>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body ">
                                                        <div class="card-body">
                                                            <table class="table table-bordered table-hover">
                                                                <thead>
                                                                    <tr class="text-center">
                                                                        <th>STT</th>
                                                                        <th>NgƯỜI BÌNH LUẬN</th>
                                                                        <th>NỘI DUNG</th>
                                                                        <th>Ngày bình luận</th>
                                                                        <th>ACTION</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($product->comments as $index => $comment)
                                                                        <tr class="text-center">
                                                                            <td>{{ $index + 1 }}</td>
                                                                            <td>{{ $comment->user->username }}</td>
                                                                            <td>{{ $comment->content }}</td>
                                                                            <td>{{ $comment->created_at->format('d-m-Y') }}</td>
                                                                            <td>
                                                                                <div class="form-button-action ">
                                                                                    <form action="{{route('admin.comments.destroy',$comment)}}" method="POST">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button onclick="return confirm('Bạn có muốn xóa không ?')" type="submit" title="Xóa" class="btn btn-link btn-danger">
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
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                    </div>
                                                  </div>
                                                </div>
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
