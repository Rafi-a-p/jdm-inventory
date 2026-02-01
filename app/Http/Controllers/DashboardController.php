<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Sparepart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with summary data.
     */
    public function index()
    {
        $totalSpareparts = Sparepart::count();
        $totalStok = Sparepart::sum('stok');
        $totalNilai = Sparepart::selectRaw('SUM(stok * harga) as total')->value('total') ?? 0;
        $userRole = Auth::user()->role;
        $userName = Auth::user()->name;

        // Get recent transactions
        $recentTransactionsQuery = Transaction::with(['sparepart', 'user'])->latest()->limit(5);

        // Staff only sees their own transactions
        if ($userRole !== 'admin') {
            $recentTransactionsQuery->where('user_id', Auth::id());
        }

        $recentTransactions = $recentTransactionsQuery->get();

        // Today's transaction stats
        $todayTransactionsQuery = Transaction::whereDate('created_at', today());
        if ($userRole !== 'admin') {
            $todayTransactionsQuery->where('user_id', Auth::id());
        }

        $todayMasuk = (clone $todayTransactionsQuery)->where('type', 'masuk')->sum('quantity');
        $todayKeluar = (clone $todayTransactionsQuery)->where('type', 'keluar')->sum('quantity');
        $todayCount = $todayTransactionsQuery->count();

        // Low stock items (stok <= 5)
        $lowStockItems = Sparepart::where('stok', '<=', 5)->orderBy('stok')->limit(5)->get();

        // Activity log stats for interactive diagram (last 7 days)
        $activityQuery = ActivityLog::where('created_at', '>=', now()->subDays(7));
        if ($userRole !== 'admin') {
            $activityQuery->where('user_id', Auth::id());
        }
        $activityByAction = $activityQuery->selectRaw('action, count(*) as total')->groupBy('action')->pluck('total', 'action');
        $activityLabels = [
            'login' => 'Login',
            'logout' => 'Logout',
            'create' => 'Tambah Data',
            'update' => 'Ubah Data',
            'delete' => 'Hapus Data',
            'transaction_masuk' => 'Barang Masuk',
            'transaction_keluar' => 'Barang Keluar',
        ];
        $activityChartData = [];
        $activityChartLabels = [];
        foreach ($activityLabels as $key => $label) {
            if (($activityByAction[$key] ?? 0) > 0) {
                $activityChartLabels[] = $label;
                $activityChartData[] = $activityByAction[$key];
            }
        }
        // If no data, show placeholder
        if (empty($activityChartData)) {
            $activityChartLabels = ['Belum ada aktivitas'];
            $activityChartData = [1];
        }

        return view('dashboard', compact(
            'totalSpareparts',
            'totalStok',
            'totalNilai',
            'userRole',
            'userName',
            'recentTransactions',
            'todayMasuk',
            'todayKeluar',
            'todayCount',
            'lowStockItems',
            'activityChartLabels',
            'activityChartData',
            'activityByAction'
        ));
    }
}
