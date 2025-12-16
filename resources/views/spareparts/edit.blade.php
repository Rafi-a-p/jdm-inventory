<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('spareparts.index') }}" class="mr-4 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    {{-- Form Header --}}
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Form Edit Sparepart</h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Ubah data sparepart sesuai kebutuhan.</p>
                    </div>

                    <form action="{{ route('spareparts.update', $sparepart) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Kode Part --}}
                        <div class="mb-4">
                            <label for="kode_part" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Kode Part <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   name="kode_part"
                                   id="kode_part"
                                   value="{{ old('kode_part', $sparepart->kode_part) }}"
                                   placeholder="Contoh: SP-001"
                                   class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('kode_part') border-red-500 @enderror">
                            @error('kode_part')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nama Barang --}}
                        <div class="mb-4">
                            <label for="nama_barang" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Nama Barang <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   name="nama_barang"
                                   id="nama_barang"
                                   value="{{ old('nama_barang', $sparepart->nama_barang) }}"
                                   placeholder="Contoh: Kampas Rem Depan"
                                   class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('nama_barang') border-red-500 @enderror">
                            @error('nama_barang')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Merk --}}
                        <div class="mb-4">
                            <label for="merk" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Merk <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   name="merk"
                                   id="merk"
                                   value="{{ old('merk', $sparepart->merk) }}"
                                   placeholder="Contoh: Brembo"
                                   class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('merk') border-red-500 @enderror">
                            @error('merk')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Stok & Harga Grid --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            {{-- Stok --}}
                            <div>
                                <label for="stok" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Stok <span class="text-red-500">*</span>
                                </label>
                                <input type="number"
                                       name="stok"
                                       id="stok"
                                       value="{{ old('stok', $sparepart->stok) }}"
                                       min="0"
                                       class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('stok') border-red-500 @enderror">
                                @error('stok')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Harga --}}
                            <div>
                                <label for="harga" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Harga (Rp) <span class="text-red-500">*</span>
                                </label>
                                <input type="number"
                                       name="harga"
                                       id="harga"
                                       value="{{ old('harga', $sparepart->harga) }}"
                                       min="0"
                                       step="0.01"
                                       class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('harga') border-red-500 @enderror">
                                @error('harga')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Info Timestamps --}}
                        <div class="mb-6 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                <span class="font-medium">Dibuat:</span> {{ $sparepart->created_at->format('d M Y, H:i') }} |
                                <span class="font-medium">Diubah:</span> {{ $sparepart->updated_at->format('d M Y, H:i') }}
                            </p>
                        </div>

                        {{-- Buttons --}}
                        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('spareparts.index') }}"
                               class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Batal
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-amber-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-600 focus:bg-amber-600 active:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
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
