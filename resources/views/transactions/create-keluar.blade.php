<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('transactions.index') }}" class="mr-4 p-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Catat Barang Keluar') }}
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
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-rose-500 to-rose-600 flex items-center justify-center mr-4 shadow-lg">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Barang Keluar</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Catat barang yang keluar dari gudang (penjualan/pemakaian)</p>
                            </div>
                        </div>
                    </div>

                    @if($spareparts->isEmpty())
                        <div class="text-center py-8">
                            <div class="w-16 h-16 rounded-full bg-amber-100 dark:bg-amber-900/50 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Tidak Ada Stok Tersedia</h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-4">Semua sparepart sedang kosong atau tidak ada data.</p>
                            <a href="{{ route('transactions.create.masuk') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Catat Barang Masuk Dulu
                            </a>
                        </div>
                    @else
                        <form action="{{ route('transactions.store.keluar') }}" method="POST">
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
                                            onchange="updateMaxQuantity(this)"
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 transition-all duration-200 @error('sparepart_id') border-red-500 ring-2 ring-red-500/20 @enderror">
                                        <option value="">-- Pilih Sparepart --</option>
                                        @foreach($spareparts as $sparepart)
                                            <option value="{{ $sparepart->id }}"
                                                    data-stok="{{ $sparepart->stok }}"
                                                    data-harga="{{ $sparepart->harga }}"
                                                    {{ old('sparepart_id') == $sparepart->id ? 'selected' : '' }}>
                                                {{ $sparepart->kode_part }} - {{ $sparepart->nama_barang }} (Stok: {{ $sparepart->stok }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('sparepart_id')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror

                                    {{-- Stock Info --}}
                                    <div id="stok-info" class="mt-2 hidden">
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                            Stok tersedia: <span id="stok-tersedia" class="font-semibold text-emerald-600 dark:text-emerald-400">0</span> unit
                                            • Harga: <span id="harga-satuan" class="font-semibold">Rp 0</span>
                                        </p>
                                    </div>
                                </div>

                                {{-- Quantity --}}
                                <div>
                                    <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Jumlah Barang Keluar <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="number"
                                               name="quantity"
                                               id="quantity"
                                               value="{{ old('quantity', 1) }}"
                                               min="1"
                                               max="9999"
                                               required
                                               class="w-full px-4 py-3 pr-16 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 transition-all duration-200 @error('quantity') border-red-500 ring-2 ring-red-500/20 @enderror">
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
                                              placeholder="Contoh: Penjualan ke Pak Budi, untuk servis motor Beat"
                                              class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 shadow-sm focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 transition-all duration-200">{{ old('keterangan') }}</textarea>
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
                                        class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-rose-500 to-rose-600 border border-transparent rounded-lg font-medium text-sm text-white hover:from-rose-600 hover:to-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 transition-all duration-200 shadow-md hover:shadow-lg">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Simpan Transaksi
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>

            {{-- Warning Card --}}
            <div class="mt-6 bg-rose-50 dark:bg-rose-900/30 rounded-xl p-4 border border-rose-100 dark:border-rose-800">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-rose-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-rose-800 dark:text-rose-200">Perhatian</h3>
                        <p class="mt-1 text-sm text-rose-700 dark:text-rose-300">
                            Stok akan otomatis berkurang setelah transaksi disimpan. Pastikan jumlah yang diinput sudah benar.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateMaxQuantity(select) {
            const selectedOption = select.options[select.selectedIndex];
            const stokInfo = document.getElementById('stok-info');
            const stokTersedia = document.getElementById('stok-tersedia');
            const hargaSatuan = document.getElementById('harga-satuan');
            const quantityInput = document.getElementById('quantity');

            if (selectedOption.value) {
                const stok = parseInt(selectedOption.dataset.stok);
                const harga = parseFloat(selectedOption.dataset.harga);

                stokInfo.classList.remove('hidden');
                stokTersedia.textContent = stok;
                hargaSatuan.textContent = 'Rp ' + harga.toLocaleString('id-ID');
                quantityInput.max = stok;
            } else {
                stokInfo.classList.add('hidden');
                quantityInput.max = 9999;
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('sparepart_id');
            if (select.value) {
                updateMaxQuantity(select);
            }
        });
    </script>
</x-app-layout>
