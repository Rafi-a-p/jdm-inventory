<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sparepart;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Show report dashboard
     */
    public function index()
    {
        $categories = Category::orderBy('nama')->get();
        return view('reports.index', compact('categories'));
    }

    /**
     * Generate Stock Report PDF
     */
    public function stockReport(Request $request)
    {
        $query = Sparepart::with('category')->orderBy('nama_barang');

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by low stock only
        if ($request->boolean('low_stock_only')) {
            $query->whereColumn('stok', '<=', 'stok_minimum');
        }

        $spareparts = $query->get();

        $totalItems = $spareparts->count();
        $totalStock = $spareparts->sum('stok');
        $totalValue = $spareparts->sum(fn($s) => $s->stok * $s->harga);
        $lowStockCount = $spareparts->filter(fn($s) => $s->isLowStock())->count();

        $pdf = Pdf::loadView('reports.pdf.stock', compact(
            'spareparts', 'totalItems', 'totalStock', 'totalValue', 'lowStockCount'
        ));

        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('laporan-stok-' . now()->format('Y-m-d') . '.pdf');
    }

    /**
     * Generate Transaction Report PDF
     */
    public function transactionReport(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
        ]);

        $query = Transaction::with(['sparepart', 'user'])
            ->whereDate('created_at', '>=', $request->from_date)
            ->whereDate('created_at', '<=', $request->to_date)
            ->orderBy('created_at', 'desc');

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Staff only see their transactions
        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }

        $transactions = $query->get();

        $stats = [
            'total' => $transactions->count(),
            'masuk' => $transactions->where('type', 'masuk')->sum('quantity'),
            'keluar' => $transactions->where('type', 'keluar')->sum('quantity'),
            'from_date' => Carbon::parse($request->from_date)->format('d M Y'),
            'to_date' => Carbon::parse($request->to_date)->format('d M Y'),
        ];

        $pdf = Pdf::loadView('reports.pdf.transactions', compact('transactions', 'stats'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('laporan-transaksi-' . $request->from_date . '-' . $request->to_date . '.pdf');
    }

    /**
     * Generate Stock Card (Kartu Stok) PDF for specific sparepart
     */
    public function stockCard(Sparepart $sparepart, Request $request)
    {
        $fromDate = $request->from_date ?? now()->startOfMonth()->format('Y-m-d');
        $toDate = $request->to_date ?? now()->format('Y-m-d');

        $transactions = Transaction::with('user')
            ->where('sparepart_id', $sparepart->id)
            ->whereDate('created_at', '>=', $fromDate)
            ->whereDate('created_at', '<=', $toDate)
            ->orderBy('created_at', 'asc')
            ->get();

        // Calculate running balance
        $balance = $sparepart->stok;
        // Get initial stock before the period
        $stockBefore = $sparepart->stok;
        foreach ($transactions->reverse() as $t) {
            if ($t->type === 'masuk') {
                $stockBefore -= $t->quantity;
            } else {
                $stockBefore += $t->quantity;
            }
        }

        // Now calculate forward
        $runningBalance = $stockBefore;
        $transactionsWithBalance = $transactions->map(function ($t) use (&$runningBalance) {
            if ($t->type === 'masuk') {
                $runningBalance += $t->quantity;
            } else {
                $runningBalance -= $t->quantity;
            }
            $t->running_balance = $runningBalance;
            return $t;
        });

        $pdf = Pdf::loadView('reports.pdf.stock-card', [
            'sparepart' => $sparepart,
            'transactions' => $transactionsWithBalance,
            'fromDate' => Carbon::parse($fromDate)->format('d M Y'),
            'toDate' => Carbon::parse($toDate)->format('d M Y'),
            'stockBefore' => $stockBefore,
        ]);

        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('kartu-stok-' . $sparepart->kode_part . '.pdf');
    }
}
