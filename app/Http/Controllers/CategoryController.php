<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogger;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
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
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Category::withCount('spareparts')->orderBy('nama')->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        $this->authorizeAdmin();
        return view('categories.create');
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:categories,nama',
            'deskripsi' => 'nullable|string|max:255',
            'warna' => 'required|string|max:20',
        ], [
            'nama.required' => 'Nama kategori wajib diisi.',
            'nama.unique' => 'Nama kategori sudah digunakan.',
        ]);

        $category = Category::create($validated);

        ActivityLogger::log('create', 'category', $category->id, 'Menambah kategori: ' . $category->nama, null, $category->toArray());

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        $this->authorizeAdmin();
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category.
     */
    public function update(Request $request, Category $category)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:categories,nama,' . $category->id,
            'deskripsi' => 'nullable|string|max:255',
            'warna' => 'required|string|max:20',
        ], [
            'nama.required' => 'Nama kategori wajib diisi.',
            'nama.unique' => 'Nama kategori sudah digunakan.',
        ]);

        $oldValues = $category->toArray();
        $category->update($validated);

        ActivityLogger::log('update', 'category', $category->id, 'Mengubah kategori: ' . $category->nama, $oldValues, $category->fresh()->toArray());

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Remove the specified category.
     */
    public function destroy(Category $category)
    {
        $this->authorizeAdmin();

        $nama = $category->nama;
        $oldValues = $category->toArray();
        // Spareparts in this category will have null category_id due to nullOnDelete
        $category->delete();

        ActivityLogger::log('delete', 'category', null, 'Menghapus kategori: ' . $nama, $oldValues, null);

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}
