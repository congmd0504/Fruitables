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
                    <a href="#">Tình trạng đơn hàng</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Thống kê tình trạng của đơn hàng</div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="text-center">
                                <th>Status</th>
                                <th>Số lượng</th>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($status as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        @php
                                            $found = false;
                                        @endphp
                                        @foreach ($statusOrder as $status)
                                            @if ($status->status == $item->name)
                                                <td>{{ $status->count }}</td>
                                                @php
                                                    $found = true;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @if (!$found)
                                            <td>0</td>
                                        @endif

                                    </tr>
                                @endforeach
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
        var statusName = @json($statusOrder->pluck('status')); 
        var statusCount = @json($statusOrder->pluck('count')); 
        var myPieChart = new Chart(pieChart, {
            type: "pie",
            data: {
                datasets: [{
                    data: statusCount,
                    backgroundColor: ["#1d7af3", "#f3545d", "#fdaf4b", "#4caf50", "#9c27b0"],
                    borderWidth: 0,
                }, ],
                labels: statusName,
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
