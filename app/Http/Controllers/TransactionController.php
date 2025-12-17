<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the transactions.
     */
    public function index(Request $request)
    {
        $query = Transaction::with(['sparepart', 'user'])->latest();

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by date range
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        // Staff can only see their own transactions, Admin sees all
        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }

        $transactions = $query->paginate(15);

        // Stats
        $todayTransactions = Transaction::whereDate('created_at', today());
        if (Auth::user()->role !== 'admin') {
            $todayTransactions->where('user_id', Auth::id());
        }

        $stats = [
            'total_today' => $todayTransactions->count(),
            'masuk_today' => (clone $todayTransactions)->where('type', 'masuk')->sum('quantity'),
            'keluar_today' => (clone $todayTransactions)->where('type', 'keluar')->sum('quantity'),
        ];

        return view('transactions.index', compact('transactions', 'stats'));
    }

    /**
     * Show the form for creating a new transaction (Barang Masuk).
     */
    public function createMasuk()
    {
        $spareparts = Sparepart::orderBy('nama_barang')->get();
        return view('transactions.create-masuk', compact('spareparts'));
    }

    /**
     * Show the form for creating a new transaction (Barang Keluar).
     */
    public function createKeluar()
    {
        $spareparts = Sparepart::where('stok', '>', 0)->orderBy('nama_barang')->get();
        return view('transactions.create-keluar', compact('spareparts'));
    }

    /**
     * Store a newly created transaction (Barang Masuk).
     */
    public function storeMasuk(Request $request)
    {
        $validated = $request->validate([
            'sparepart_id' => 'required|exists:spareparts,id',
            'quantity' => 'required|integer|min:1',
            'keterangan' => 'nullable|string|max:500',
        ], [
            'sparepart_id.required' => 'Pilih sparepart terlebih dahulu.',
            'sparepart_id.exists' => 'Sparepart tidak ditemukan.',
            'quantity.required' => 'Jumlah wajib diisi.',
            'quantity.min' => 'Jumlah minimal 1.',
        ]);

        DB::transaction(function () use ($validated) {
            // Create transaction
            Transaction::create([
                'type' => 'masuk',
                'sparepart_id' => $validated['sparepart_id'],
                'user_id' => Auth::id(),
                'quantity' => $validated['quantity'],
                'keterangan' => $validated['keterangan'],
            ]);

            // Update stock
            $sparepart = Sparepart::find($validated['sparepart_id']);
            $sparepart->increment('stok', $validated['quantity']);
        });

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi Barang Masuk berhasil dicatat! Stok telah diperbarui.');
    }

    /**
     * Store a newly created transaction (Barang Keluar).
     */
    public function storeKeluar(Request $request)
    {
        $validated = $request->validate([
            'sparepart_id' => 'required|exists:spareparts,id',
            'quantity' => 'required|integer|min:1',
            'keterangan' => 'nullable|string|max:500',
        ], [
            'sparepart_id.required' => 'Pilih sparepart terlebih dahulu.',
            'sparepart_id.exists' => 'Sparepart tidak ditemukan.',
            'quantity.required' => 'Jumlah wajib diisi.',
            'quantity.min' => 'Jumlah minimal 1.',
        ]);

        $sparepart = Sparepart::find($validated['sparepart_id']);

        // Check if enough stock
        if ($sparepart->stok < $validated['quantity']) {
            return back()->withErrors([
                'quantity' => 'Stok tidak mencukupi! Stok tersedia: ' . $sparepart->stok . ' unit.'
            ])->withInput();
        }

        DB::transaction(function () use ($validated, $sparepart) {
            // Create transaction
            Transaction::create([
                'type' => 'keluar',
                'sparepart_id' => $validated['sparepart_id'],
                'user_id' => Auth::id(),
                'quantity' => $validated['quantity'],
                'keterangan' => $validated['keterangan'],
            ]);

            // Update stock
            $sparepart->decrement('stok', $validated['quantity']);
        });

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi Barang Keluar berhasil dicatat! Stok telah diperbarui.');
    }

    /**
     * Display the specified transaction.
     */
    public function show(Transaction $transaction)
    {
        // Staff can only view their own transactions
        if (Auth::user()->role !== 'admin' && $transaction->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk melihat transaksi ini.');
        }

        $transaction->load(['sparepart', 'user']);
        return view('transactions.show', compact('transaction'));
    }
}
