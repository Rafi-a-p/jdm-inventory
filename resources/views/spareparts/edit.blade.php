<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('spareparts.index') }}" class="mr-4 p-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Sparepart') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="p-6 sm:p-8">
                    {{-- Form Header --}}
                    <div class="mb-8">
                        <div class="flex items-center mb-2">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center mr-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Edit Data Sparepart</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $sparepart->kode_part }} - {{ $sparepart->nama_barang }}</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('spareparts.update', $sparepart) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            {{-- Kode Part & Merk Row --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Kode Part --}}
                                <div>
                                    <label for="kode_part" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Kode Part <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text"
                                           name="kode_part"
                                           id="kode_part"
                                           value="{{ old('kode_part', $sparepart->kode_part) }}"
                                           required
                                           class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200 @error('kode_part') border-red-500 ring-2 ring-red-500/20 @enderror">
                                    @error('kode_part')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Merk --}}
                                <div>
                                    <label for="merk" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Merk <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text"
                                           name="merk"
                                           id="merk"
                                           value="{{ old('merk', $sparepart->merk) }}"
                                           required
                                           class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200 @error('merk') border-red-500 ring-2 ring-red-500/20 @enderror">
                                    @error('merk')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- Nama Barang --}}
                            <div>
                                <label for="nama_barang" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Nama Barang <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                       name="nama_barang"
                                       id="nama_barang"
                                       value="{{ old('nama_barang', $sparepart->nama_barang) }}"
                                       required
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200 @error('nama_barang') border-red-500 ring-2 ring-red-500/20 @enderror">
                                @error('nama_barang')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Kategori & Lokasi Rak Row --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Kategori --}}
                                <div>
                                    <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Kategori
                                    </label>
                                    <select name="category_id"
                                            id="category_id"
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $sparepart->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Lokasi Rak --}}
                                <div>
                                    <label for="lokasi_rak" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Lokasi Rak
                                    </label>
                                    <input type="text"
                                           name="lokasi_rak"
                                           id="lokasi_rak"
                                           value="{{ old('lokasi_rak', $sparepart->lokasi_rak) }}"
                                           placeholder="A1-01, B2-15..."
                                           class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200">
                                </div>
                            </div>

                            {{-- Stok, Stok Minimum & Harga Row --}}
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                {{-- Stok --}}
                                <div>
                                    <label for="stok" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Stok <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="number"
                                               name="stok"
                                               id="stok"
                                               value="{{ old('stok', $sparepart->stok) }}"
                                               min="0"
                                               required
                                               class="w-full px-4 py-3 pr-16 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200 @error('stok') border-red-500 ring-2 ring-red-500/20 @enderror">
                                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm">unit</span>
                                    </div>
                                    @error('stok')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Stok Minimum --}}
                                <div>
                                    <label for="stok_minimum" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Stok Minimum <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="number"
                                               name="stok_minimum"
                                               id="stok_minimum"
                                               value="{{ old('stok_minimum', $sparepart->stok_minimum) }}"
                                               min="0"
                                               required
                                               class="w-full px-4 py-3 pr-16 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200 @error('stok_minimum') border-red-500 ring-2 ring-red-500/20 @enderror">
                                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm">unit</span>
                                    </div>
                                    @error('stok_minimum')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Harga --}}
                                <div>
                                    <label for="harga" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Harga Satuan <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm">Rp</span>
                                        <input type="number"
                                               name="harga"
                                               id="harga"
                                               value="{{ old('harga', $sparepart->harga) }}"
                                               min="0"
                                               step="100"
                                               required
                                               class="w-full px-4 py-3 pl-12 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200 @error('harga') border-red-500 ring-2 ring-red-500/20 @enderror">
                                    </div>
                                    @error('harga')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('spareparts.index') }}"
                               class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Batal
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-amber-500 to-amber-600 border border-transparent rounded-lg font-medium text-sm text-white hover:from-amber-600 hover:to-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all duration-200 shadow-md hover:shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Update Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
