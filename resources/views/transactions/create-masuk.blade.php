<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('transactions.index') }}" class="mr-4 p-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Catat Barang Masuk') }}
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
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center mr-4 shadow-lg">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Barang Masuk</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Catat barang yang masuk ke gudang (restok dari supplier)</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('transactions.store.masuk') }}" method="POST">
                        @csrf

                        <div class="space-y-6">
                            {{-- Sparepart Selection --}}
                            <div>
                                <label for="sparepart_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Pilih Sparepart <span class="text-red-500">*</span>
                                </label>
                                <select name="sparepart_id"
                                        id="sparepart_id"
                                        required
                                        autofocus
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all duration-200 @error('sparepart_id') border-red-500 ring-2 ring-red-500/20 @enderror">
                                    <option value="">-- Pilih Sparepart --</option>
                                    @foreach($spareparts as $sparepart)
                                        <option value="{{ $sparepart->id }}"
                                                data-stok="{{ $sparepart->stok }}"
                                                {{ old('sparepart_id') == $sparepart->id ? 'selected' : '' }}>
                                            {{ $sparepart->kode_part }} - {{ $sparepart->nama_barang }} (Stok: {{ $sparepart->stok }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('sparepart_id')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Quantity --}}
                            <div>
                                <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Jumlah Barang Masuk <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="number"
                                           name="quantity"
                                           id="quantity"
                                           value="{{ old('quantity', 1) }}"
                                           min="1"
                                           required
                                           class="w-full px-4 py-3 pr-16 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all duration-200 @error('quantity') border-red-500 ring-2 ring-red-500/20 @enderror">
                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm">unit</span>
                                </div>
                                @error('quantity')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Keterangan --}}
                            <div>
                                <label for="keterangan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Keterangan <span class="text-gray-400">(opsional)</span>
                                </label>
                                <textarea name="keterangan"
                                          id="keterangan"
                                          rows="3"
                                          placeholder="Contoh: Restok dari Supplier ABC, PO #12345"
                                          class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 transition-all duration-200">{{ old('keterangan') }}</textarea>
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('transactions.index') }}"
                               class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Batal
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-emerald-500 to-emerald-600 border border-transparent rounded-lg font-medium text-sm text-white hover:from-emerald-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all duration-200 shadow-md hover:shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Transaksi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="mt-6 bg-emerald-50 dark:bg-emerald-900/30 rounded-xl p-4 border border-emerald-100 dark:border-emerald-800">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-emerald-800 dark:text-emerald-200">Info</h3>
                        <p class="mt-1 text-sm text-emerald-700 dark:text-emerald-300">
                            Stok akan otomatis bertambah setelah transaksi disimpan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
