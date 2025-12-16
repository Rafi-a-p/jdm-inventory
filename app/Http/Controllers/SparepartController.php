<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
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
    public function index()
    {
        $spareparts = Sparepart::latest()->get();
        return view('spareparts.index', compact('spareparts'));
    }

    /**
     * Show the form for creating a new resource.
     * Only accessible by Admin.
     */
    public function create()
    {
        $this->authorizeAdmin();
        return view('spareparts.create');
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
        ], [
            'kode_part.required' => 'Kode Part wajib diisi.',
            'kode_part.unique' => 'Kode Part sudah digunakan.',
            'nama_barang.required' => 'Nama Barang wajib diisi.',
            'merk.required' => 'Merk wajib diisi.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.min' => 'Stok tidak boleh negatif.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.min' => 'Harga tidak boleh negatif.',
        ]);

        Sparepart::create($validated);

        return redirect()->route('spareparts.index')
            ->with('success', 'Data sparepart berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sparepart $sparepart)
    {
        return view('spareparts.show', compact('sparepart'));
    }

    /**
     * Show the form for editing the specified resource.
     * Only accessible by Admin.
     */
    public function edit(Sparepart $sparepart)
    {
        $this->authorizeAdmin();
        return view('spareparts.edit', compact('sparepart'));
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
        ], [
            'kode_part.required' => 'Kode Part wajib diisi.',
            'kode_part.unique' => 'Kode Part sudah digunakan.',
            'nama_barang.required' => 'Nama Barang wajib diisi.',
            'merk.required' => 'Merk wajib diisi.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.min' => 'Stok tidak boleh negatif.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.min' => 'Harga tidak boleh negatif.',
        ]);

        $sparepart->update($validated);

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

        $sparepart->delete();

        return redirect()->route('spareparts.index')
            ->with('success', 'Data sparepart berhasil dihapus!');
    }
}
