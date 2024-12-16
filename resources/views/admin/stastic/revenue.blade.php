@extends('admin.home')
@section('content')
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
                <div class="row">
                    <div class="col-6">
                        <div class="card-header">
                            <h5 class="text-primary">Doanh thu theo danh mục</h5>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Danh mục</th>
                                    <th>Doanh thu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($saleCategory as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ number_format($item->sumSaleCategory) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6">
                        <div class="card-header">
                            <h5 class="text-primary">Doanh thu theo khách hàng</h5>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Khách hàng</th>
                                    <th>Doanh thu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($saleUser as $item)
                                    <tr>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ number_format($item->sumSaleUser) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Doanh thu theo tháng</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Doanh thu theo tuần</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script>
        var barChart = document.getElementById("barChart").getContext("2d");
        var lineChart = document.getElementById("lineChart").getContext("2d");
        var revenueMonth = @json($revenueMonth->pluck('revenue'));
        var revenueWeek = @json($revenueWeek->pluck('revenue'));

        var myBarChart = new Chart(barChart, {
            type: "bar",
            data: {
                labels: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
                datasets: [{
                    label: "Doanh thu",
                    backgroundColor: "rgb(23, 125, 255)",
                    borderColor: "rgb(23, 125, 255)",
                    data: revenueMonth,
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        },
                    }, ],
                },
            },
        });
        var myLineChart = new Chart(lineChart, {
      type: "line",
      data: {
        labels: [
          "Mon",
          "Tue",
          "Wed",
          "Thu",
          "Fri",
          "Sat",
          "Sun",
        ],
        datasets: [
          {
            label: "Doanh thu",
            borderColor: "#1d7af3",
            pointBorderColor: "#FFF",
            pointBackgroundColor: "#1d7af3",
            pointBorderWidth: 2,
            pointHoverRadius: 4,
            pointHoverBorderWidth: 1,
            pointRadius: 4,
            backgroundColor: "transparent",
            fill: true,
            borderWidth: 2,
            data: revenueWeek,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          position: "bottom",
          labels: {
            padding: 10,
            fontColor: "#1d7af3",
          },
        },
        tooltips: {
          bodySpacing: 4,
          mode: "nearest",
          intersect: 0,
          position: "nearest",
          xPadding: 10,
          yPadding: 10,
          caretPadding: 10,
        },
        layout: {
          padding: { left: 15, right: 15, top: 15, bottom: 15 },
        },
      },
    });
    </script>
@endsection
