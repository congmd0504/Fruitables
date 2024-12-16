@extends('admin.home')
@section('content')
    <div>
        <div class="page-header">
            <h3 class="fw-bold mb-3">Trang chủ</h3>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Đơn đặt hàng</p>
                                    <h4 class="card-title">{{$countOrder}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                    <i class="fas fa-user-check"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Doanh thu</p>
                                    <h4 class="card-title">{{ number_format(round($sumOrder))}} VNĐ</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fas fa-luggage-cart"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Giá trung bình</p>
                                    <h4 class="card-title">{{ number_format(round($avgOrder))}} VNĐ</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                    <i class="far fa-check-circle"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Sản phẩm đã bán</p>
                                    <h4 class="card-title">{{$countProductSales}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sản phẩm được mua gần đây</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Khách hàng</th>
                                    <th>Sản phẩm</th>
                                    <th>Thể loại</th>
                                    <th>Số lượng</th>
                                    <th>Ngày đặt</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Khách hàng</th>
                                    <th>Sản phẩm</th>
                                    <th>Thể loại</th>
                                    <th>Số lượng</th>
                                    <th>Ngày đặt</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($newOrders as $item)
                                <tr>
                                    <td>{{$item->order->user->username}}</td>
                                    <td>{{$item->product->name}}</td>
                                    <td>{{$item->product->category->name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->order->created_at->format('d-m-Y')}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#basic-datatables").DataTable({});
    
            $("#multi-filter-select").DataTable({
                pageLength: 5,
                initComplete: function() {
                    this.api()
                        .columns()
                        .every(function() {
                            var column = this;
                            var select = $(
                                    '<select class="form-select"><option value=""></option></select>'
                                )
                                .appendTo($(column.footer()).empty())
                                .on("change", function() {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
    
                                    column
                                        .search(val ? "^" + val + "$" : "", true, false)
                                        .draw();
                                });
    
                            column
                                .data()
                                .unique()
                                .sort()
                                .each(function(d, j) {
                                    select.append(
                                        '<option value="' + d + '">' + d + "</option>"
                                    );
                                });
                        });
                },
            });
    
            // Add Row
            $("#add-row").DataTable({
                pageLength: 5,
            });
    
            var action =
                '<td> <div class="form-button-action"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';
    
            $("#addRowButton").click(function() {
                $("#add-row")
                    .dataTable()
                    .fnAddData([
                        $("#addName").val(),
                        $("#addPosition").val(),
                        $("#addOffice").val(),
                        action,
                    ]);
                $("#addRowModal").modal("hide");
            });
        });
    </script>
    
@endsection
