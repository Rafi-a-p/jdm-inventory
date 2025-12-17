<?php

namespace App\Http\Controllers;

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
            'lowStockItems'
        ));
    }
}
