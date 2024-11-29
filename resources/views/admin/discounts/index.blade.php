@extends('admin.home')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Mã giảm giá</h3>
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
                    <a href="#">Mã giảm giá</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Danh sách mã giảm giá</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Danh sách mã giảm giá</h4>
                            <a href="{{ route('admin.discounts.create') }}" class="btn btn-primary btn-round ms-auto">
                                <i class="fa fa-plus"></i> Thêm mới mã giảm giá
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th>STT</th>
                                    <th>MÃ CODE</th>
                                    <th>GIẢM</th>
                                    <th>SỐ LƯỢNG</th>
                                    <th>NGÀY HẾT HẠN</th>
                                    <th>THAO TÁC</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($discounts as $index => $item)
                                    <tr class="text-center">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->discount }}%</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->end_date}}</td>
                                        <td class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-link btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $index }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <div class="modal fade" id="editModal{{ $index }}" tabindex="-1"
                                                aria-labelledby="editModalLabel{{ $index }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel{{ $index }}">
                                                                Sửa mã giảm giá</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('admin.discounts.update', $item) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="row text-start" >
                                                                    <div class="col-6">
                                                                        <label for="code" class="fw-bold">Mã giảm
                                                                            giá:</label>
                                                                        <input type="text" name="code"
                                                                            class="form-control mt-2"
                                                                            value="{{ $item->code }}">
                                                                        <label for="discount" class="fw-bold">Giảm giá
                                                                            (%):</label>
                                                                        <input type="number" name="discount"
                                                                            class="form-control mt-2"
                                                                            value="{{ $item->discount }}" min="1"
                                                                            max="100">
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label for="quantity" class="fw-bold">Số
                                                                            lượng:</label>
                                                                        <input type="number" name="quantity"
                                                                            class="form-control mt-2"
                                                                            value="{{ $item->quantity }}">
                                                                        <label for="end_date" class="fw-bold ">Ngày hết
                                                                            hạn:</label>
                                                                        <input type="date" name="end_date"
                                                                            class="form-control mt-2"
                                                                            value="{{ $item->end_date }}">
                                                                    </div>
                                                                </div>
                                                                <div class="text-end mt-4">
                                                                    <button type="submit" class="btn btn-success w-100">Cập
                                                                        nhật</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="{{ route('admin.discounts.destroy', $item->id) }}" method="POST"
                                                class="ms-2">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Bạn có chắc chắn muốn xóa?')"
                                                    type="submit" class="btn btn-link btn-danger">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Phân trang -->
                    <div class="d-flex justify-content-end p-2" style="width: 95%;">
                        {{ $discounts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
