<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DetailOrder;
use App\Models\Order;
use App\Models\Product;
use App\Models\StatusOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaticsController extends Controller
{
    public function index()
    {
        $countOrder = Order::count();
        $sumOrder = Order::sum('total');
        $avgOrder = Order::avg('total');
        $countProductSales = DetailOrder::sum('quantity');
        $newOrders = DetailOrder::with('order', 'product')->latest('id')->get();
        return view('admin.index', compact('countOrder', 'sumOrder', 'avgOrder', 'countProductSales', 'newOrders'));
    }
    public function revenue()
    {
        $saleCategory = DetailOrder::select('categories.name as name', DB::raw('SUM(detail_orders.price) as sumSaleCategory'))
            ->join('products', 'products.id', '=', 'detail_orders.product_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->groupBy('categories.name')
            ->limit(10)->get();

        $saleUser = DetailOrder::select('users.username as username', DB::raw('SUM(detail_orders.price) as sumSaleUser'))
            ->join('orders', 'orders.id', '=', 'order_id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->groupBy('users.username')
            ->limit(10)
            ->get();

        $revenueMonth = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total) as revenue'))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        $revenueWeek = Order::select(
            DB::raw('WEEK(created_at) as week'),
            DB::raw('SUM(total) as revenue'))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('WEEK(created_at)'))
            ->orderBy(DB::raw('WEEK(created_at)'))
            ->get();

        return view('admin.stastic.revenue', compact('saleCategory', 'saleUser', 'revenueMonth','revenueWeek'));
    }
    public function productSales()
    {
        $products = DetailOrder::select('products.name as product_name', DB::raw('SUM(detail_orders.quantity) as total_quantity'))
            ->join('products', 'detail_orders.product_id', '=', 'products.id')
            ->groupBy('products.name')
            ->get();
        $sumQuantity = DetailOrder::sum('quantity');
        return view('admin.stastic.productSales', compact('products', 'sumQuantity'));
    }
    public function statusOrder()
    {
        $statusOrder = Order::select('status_orders.name as status', DB::raw('COUNT(1) as count'))
            ->join('status_orders', 'orders.status_order_id', '=', 'status_orders.id')
            ->groupBy('status')
            ->get();
        $status = StatusOrder::select('name')->get();
        return view('admin.stastic.statusOrder', compact('statusOrder', 'status'));
    }
    public function topProduct()
    {
        $topOrder = DetailOrder::select('products.name as name', DB::raw('SUM(detail_orders.quantity) as quantity'))
            ->join('products', 'products.id', 'detail_orders.product_id')
            ->orderBy('quantity', 'desc')->limit(10)->groupBy('name')->get();
        $topViewProduct = Product::orderBy('view', 'desc')->limit(10)->get();
        return view('admin.stastic.topProduct', compact('topOrder', 'topViewProduct'));
    }
}
