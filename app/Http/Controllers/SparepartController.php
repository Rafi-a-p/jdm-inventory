<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogger;
use App\Models\Category;
use App\Models\Sparepart;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SparepartController extends Controller
{
    /**
     * Check if current user is admin
     */
    private function isAdmin(): bool
    {
        return Auth::user()->role === 'admin';
    }

    /**
     * Abort if user is not admin
     */
    private function authorizeAdmin(): void
    {
        if (!$this->isAdmin()) {
            abort(403, 'Unauthorized. Only admin can access this feature.');
        }
    }

    /**
     * Display a listing of the resource.
     * Accessible by both Admin and Staff.
     */
    public function index(Request $request)
    {
        $query = Sparepart::with('category');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('kode_part', 'like', "%{$search}%")
                  ->orWhere('nama_barang', 'like', "%{$search}%")
                  ->orWhere('merk', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by merk
        if ($request->filled('merk')) {
            $query->where('merk', $request->merk);
        }

        // Filter by stock status
        if ($request->filled('stock_status')) {
            switch ($request->stock_status) {
                case 'low':
                    $query->whereColumn('stok', '<=', 'stok_minimum')->where('stok', '>', 0);
                    break;
                case 'out':
                    $query->where('stok', '<=', 0);
                    break;
                case 'normal':
                    $query->whereColumn('stok', '>', 'stok_minimum');
                    break;
            }
        }

        // Sorting
        $sortBy = $request->get('sort', 'created_at');
        $sortDir = $request->get('dir', 'desc');
        $query->orderBy($sortBy, $sortDir);

        $spareparts = $query->paginate(15)->withQueryString();

        // Get data for filters
        $categories = Category::orderBy('nama')->get();
        $merks = Sparepart::select('merk')->distinct()->orderBy('merk')->pluck('merk');

        // Stats
        $stats = [
            'total' => Sparepart::count(),
            'low_stock' => Sparepart::whereColumn('stok', '<=', 'stok_minimum')->where('stok', '>', 0)->count(),
            'out_of_stock' => Sparepart::where('stok', '<=', 0)->count(),
            'total_value' => Sparepart::selectRaw('SUM(stok * harga) as total')->value('total') ?? 0,
        ];

        return view('spareparts.index', compact('spareparts', 'categories', 'merks', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     * Only accessible by Admin.
     */
    public function create()
    {
        $this->authorizeAdmin();
        $categories = Category::orderBy('nama')->get();
        return view('spareparts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * Only accessible by Admin.
     */
    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'kode_part' => 'required|string|max:50|unique:spareparts,kode_part',
            'nama_barang' => 'required|string|max:255',
            'merk' => 'required|string|max:100',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'lokasi_rak' => 'nullable|string|max:50',
            'stok_minimum' => 'required|integer|min:0',
        ], [
            'kode_part.required' => 'Kode Part wajib diisi.',
            'kode_part.unique' => 'Kode Part sudah digunakan.',
            'nama_barang.required' => 'Nama Barang wajib diisi.',
            'merk.required' => 'Merk wajib diisi.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.min' => 'Stok tidak boleh negatif.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.min' => 'Harga tidak boleh negatif.',
            'stok_minimum.required' => 'Stok minimum wajib diisi.',
        ]);

        $sparepart = Sparepart::create($validated);

        ActivityLogger::log('create', 'sparepart', $sparepart->id, 'Menambah sparepart: ' . $sparepart->nama_barang . ' (' . $sparepart->kode_part . ')', null, $sparepart->toArray());

        return redirect()->route('spareparts.index')
            ->with('success', 'Data sparepart berhasil ditambahkan!');
    }

    /**
     * Display the specified resource with transaction history.
     */
    public function show(Sparepart $sparepart)
    {
        $sparepart->load(['category', 'transactions' => function($q) {
            $q->with('user')->latest()->take(10);
        }]);

        $totalMasuk = $sparepart->transactions()->where('type', 'masuk')->sum('quantity');
        $totalKeluar = $sparepart->transactions()->where('type', 'keluar')->sum('quantity');

        return view('spareparts.show', compact('sparepart', 'totalMasuk', 'totalKeluar'));
    }

    /**
     * Show stock card for specific sparepart.
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
        $stockBefore = $sparepart->stok;
        foreach ($transactions->reverse() as $t) {
            if ($t->type === 'masuk') {
                $stockBefore -= $t->quantity;
            } else {
                $stockBefore += $t->quantity;
            }
        }

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

        return view('spareparts.stock-card', [
            'sparepart' => $sparepart,
            'transactions' => $transactionsWithBalance,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'stockBefore' => $stockBefore,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * Only accessible by Admin.
     */
    public function edit(Sparepart $sparepart)
    {
        $this->authorizeAdmin();
        $categories = Category::orderBy('nama')->get();
        return view('spareparts.edit', compact('sparepart', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * Only accessible by Admin.
     */
    public function update(Request $request, Sparepart $sparepart)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'kode_part' => 'required|string|max:50|unique:spareparts,kode_part,' . $sparepart->id,
            'nama_barang' => 'required|string|max:255',
            'merk' => 'required|string|max:100',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'lokasi_rak' => 'nullable|string|max:50',
            'stok_minimum' => 'required|integer|min:0',
        ], [
            'kode_part.required' => 'Kode Part wajib diisi.',
            'kode_part.unique' => 'Kode Part sudah digunakan.',
            'nama_barang.required' => 'Nama Barang wajib diisi.',
            'merk.required' => 'Merk wajib diisi.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.min' => 'Stok tidak boleh negatif.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.min' => 'Harga tidak boleh negatif.',
            'stok_minimum.required' => 'Stok minimum wajib diisi.',
        ]);

        $oldValues = $sparepart->toArray();
        $sparepart->update($validated);

        ActivityLogger::log('update', 'sparepart', $sparepart->id, 'Mengubah sparepart: ' . $sparepart->nama_barang . ' (' . $sparepart->kode_part . ')', $oldValues, $sparepart->fresh()->toArray());

        return redirect()->route('spareparts.index')
            ->with('success', 'Data sparepart berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     * Only accessible by Admin.
     */
    public function destroy(Sparepart $sparepart)
    {
        $this->authorizeAdmin();

        $nama = $sparepart->nama_barang;
        $kode = $sparepart->kode_part;
        $oldValues = $sparepart->toArray();
        $sparepart->delete();

        ActivityLogger::log('delete', 'sparepart', null, 'Menghapus sparepart: ' . $nama . ' (' . $kode . ')', $oldValues, null);

        return redirect()->route('spareparts.index')
            ->with('success', 'Data sparepart berhasil dihapus!');
    }
}

