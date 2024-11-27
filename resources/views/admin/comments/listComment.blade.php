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
                            <h4 class="card-title">Chi tiết bình luận</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-start">NgƯỜI BÌNH LUẬN</th>
                                    <th>Tên đăng nhập</th>
                                    <th>NỘI DUNG</th>
                                    <th>Ngày bình luận</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comments as $index => $comment)
                                    <tr class="text-center">
                                        <td class="d-flex">
                                            <div>
                                                <img src="{{ Storage::url($comment->user->image) }}" height="50px"
                                                    alt="">
                                            </div>
                                            <div class="m-2 text-start">
                                                {{ $comment->user->fullname }} <br>
                                                {{ $comment->user->email }}
                                            </div>
                                        </td>
                                        <td>{{ $comment->user->username }}</td>
                                        <td>{{ $comment->content }}</td>
                                        <td>{{ $comment->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button title="trả lời" type="button" class="btn" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $index }}">
                                                <i class="fa fa-pen text-primary"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $index }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <form action="{{ route('admin.comments.replyComment') }}" method="POST"
                                                    class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Trả lời bình
                                                                luận
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="text-start">
                                                                @csrf
                                                                <input type="hidden" value="{{ $comment->id }}"
                                                                    name="comment_id">
                                                                <input type="hidden" value="{{ Auth::id() }}"
                                                                    name="user_id">
                                                                <div class="mb-3">
                                                                    <label for="" class="">Bình luận khách
                                                                        hàng</label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $comment->content }}" disabled>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="" class="">Nội dung</label>
                                                                    <textarea name="content" class="form-control" id="" cols="30" rows="3">

                                                                   </textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Đóng</button>
                                                            <button type="submit" class="btn btn-primary">Trả lời</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="form-button-action ">
                                                <form action="{{ route('admin.comments.destroy', $comment) }}"
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
                </div>
            </div>
        </div>
    </div>
@endsection
