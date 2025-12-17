<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('spareparts.index') }}" class="mr-4 p-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tambah Sparepart Baru') }}
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
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center mr-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Form Tambah Sparepart</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Isi data sparepart baru</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('spareparts.store') }}" method="POST" id="sparepartForm">
                        @csrf

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
                                           value="{{ old('kode_part') }}"
                                           placeholder="SP-001"
                                           autofocus
                                           required
                                           class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200 @error('kode_part') border-red-500 ring-2 ring-red-500/20 @enderror">
                                    @error('kode_part')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
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
                                           value="{{ old('merk') }}"
                                           placeholder="Brembo, TDR, Aspira..."
                                           required
                                           class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200 @error('merk') border-red-500 ring-2 ring-red-500/20 @enderror">
                                    @error('merk')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
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
                                       value="{{ old('nama_barang') }}"
                                       placeholder="Kampas Rem Depan Honda Beat"
                                       required
                                       class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200 @error('nama_barang') border-red-500 ring-2 ring-red-500/20 @enderror">
                                @error('nama_barang')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
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
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                           value="{{ old('lokasi_rak') }}"
                                           placeholder="A1-01, B2-15..."
                                           class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200">
                                </div>
                            </div>

                            {{-- Stok, Stok Minimum & Harga Row --}}
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                {{-- Stok --}}
                                <div>
                                    <label for="stok" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Stok Awal <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="number"
                                               name="stok"
                                               id="stok"
                                               value="{{ old('stok', 0) }}"
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
                                               value="{{ old('stok_minimum', 5) }}"
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
                                               value="{{ old('harga', 0) }}"
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
                                    class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-indigo-500 to-indigo-600 border border-transparent rounded-lg font-medium text-sm text-white hover:from-indigo-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 shadow-md hover:shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Tips Card --}}
            <div class="mt-6 bg-blue-50 dark:bg-blue-900/30 rounded-xl p-4 border border-blue-100 dark:border-blue-800">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">Tips</h3>
                        <ul class="mt-1 text-sm text-blue-700 dark:text-blue-300 list-disc list-inside space-y-1">
                            <li>Gunakan kode part yang unik dan mudah diingat</li>
                            <li>Stok minimum akan digunakan untuk alert stok menipis</li>
                            <li>Lokasi rak membantu menemukan barang dengan cepat di gudang</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
