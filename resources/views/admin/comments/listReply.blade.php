@extends('admin.home')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Trả lời bình luận </h3>
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
                    <a href="#">Trả lời bình luận </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Danh sách trả lời bình luận</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Danh sách trả lời bình luận</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr class="text-start">
                                    <th>NGƯỜI PHẢN HỒI</th>
                                    <th>NỘI DUNG BÌNH LUẬN</th>
                                    <th>NỘI DUNG PHẢN HỒI</th>
                                    <th>NGÀY PHẢN HỒI</th>
                                    <th>HÀNG ĐỘNG</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listReply as $item)
                                    <tr>
                                        <td>{{ $item->user->username }}</td>
                                        <td>{{ $item->comment->content }}</td>
                                        <td>{{ $item->content }}</td>
                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                        <td class="d-flex">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn " data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $item->id }}">
                                                <i class="text-primary fa fa-edit"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('admin.comments.editReplyComment', $item) }}"
                                                        method="POST" class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Chỉnh sửa
                                                                phản hồi
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @csrf
                                                            @method('PATCH')
                                                            <label for="">Nội dung</label>
                                                            <textarea name="content" class="form-control text-start" id="" cols="30" rows="3">
                                                                    {{ $item->content }}
                                                                </textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Đóng</button>
                                                            <button type="submit" class="btn btn-primary">Cập nhập</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <form action="{{route('admin.comments.destroyReplyComment',$item)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Bạn có muốn xóa không ?')" title="Xóa" class="btn" type="submit"><i class="text-danger fa fa-times"></i></button>
                                            </form>
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
