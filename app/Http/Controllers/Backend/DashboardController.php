<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct() {}

    public function index(Request $request)
    {
        $filter = $request->input('filter', 'day');
        $startDate = null;
        $endDate = null;
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
            $endDate = Carbon::parse($request->input('end_date'))->endOfDay();
        } else {

            $startDate = match ($filter) {
                'day' => Carbon::now()->startOfDay(),
                'month' => Carbon::now()->startOfMonth(),
                'year' => Carbon::now()->startOfYear(),
                default => Carbon::now()->startOfDay(),
            };
        }

        $revenue = Order::where('status', 'completed')
            ->when($startDate, fn($query) => $query->where('created_at', '>=', $startDate))
            ->when($endDate, fn($query) => $query->where('created_at', '<=', $endDate))
            ->sum('final_total');
        $newUsers = User::where('created_at', '>=', $startDate)->count();
        $ordersByStatus = Order::select('status', DB::raw('COUNT(*) as count'))
            ->when($startDate, fn($query) => $query->where('created_at', '>=', $startDate))
            ->when($endDate, fn($query) => $query->where('created_at', '<=', $endDate))
            ->groupBy('status')
            ->get();
        $totalOrders = $ordersByStatus->sum('count');

        $config = [
            'js' => [
                'backend/js/inspinia.js',
                'backend/js/plugins/flot/jquery.flot.js',
                'backend/js/plugins/flot/jquery.flot.tooltip.min.js',
                'backend/js/plugins/flot/jquery.flot.spline.js',
                'backend/js/plugins/flot/jquery.flot.resize.js',
                'backend/js/plugins/flot/jquery.flot.pie.js',
                'backend/js/plugins/flot/jquery.flot.symbol.js',
                'backend/js/plugins/flot/jquery.flot.time.js'
            ],
            'css' => [
                'backend/js/demo/sparkline-demo.js'
            ],
        ];

        $template = 'backend.dashboard.home.index';


        return view('backend.welcome', compact(
            'template',
            'config',
            'revenue',
            'newUsers',
            'ordersByStatus',
            'totalOrders',
            'startDate',
            'endDate'
        ));
    }
}
