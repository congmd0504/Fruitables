@extends('admin.home')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Thống kê</h3>
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
                    <a href="#">Thống kê</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Doanh thu</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Số lượng của sản phẩm bán</div>
                    </div>
                    <div class="card-body">

                        <table class="table table-head-bg-primary">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Số lượng</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($products as $item)
                                <tr>
                                    <td>{{$item->product_name}}</td>
                                    <td>{{$item->total_quantity}}</td>
                                   
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2" class="text-center fw-bold">Tổng: <span class="text-danger">{{$sumQuantity}}</span> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Biểu đồ</div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="pieChart" style="width: 50%; height: 50%"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script>
        var pieChart = document.getElementById("pieChart").getContext("2d");
        var productLabels = @json($products->pluck('product_name')); 
        var productSales = @json($products->pluck('total_quantity')); 
        var myPieChart = new Chart(pieChart, {
            type: "pie",
            data: {
                datasets: [{
                    data: productSales,
                    backgroundColor: ["#1d7af3", "#f3545d", "#fdaf4b", "#4caf50", "#9c27b0"],
                    borderWidth: 0,
                }, ],
                labels: productLabels,
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: "bottom",
                    labels: {
                        fontColor: "rgb(154, 154, 154)",
                        fontSize: 11,
                        usePointStyle: true,
                        padding: 20,
                    },
                },
                pieceLabel: {
                    render: "percentage",
                    fontColor: "white",
                    fontSize: 14,
                },
                tooltips: false,
                layout: {
                    padding: {
                        left: 20,
                        right: 20,
                        top: 20,
                        bottom: 20,
                    },
                },
            },
        });
    </script>
@endsection
