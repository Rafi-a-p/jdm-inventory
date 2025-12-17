<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('spareparts.index') }}" class="mr-4 p-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Detail Sparepart') }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $sparepart->kode_part }}</p>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('spareparts.stock-card', $sparepart) }}"
                   class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Kartu Stok
                </a>
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('spareparts.edit', $sparepart) }}"
                   class="inline-flex items-center px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white text-sm font-medium rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Main Info Card --}}
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-start justify-between">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $sparepart->nama_barang }}</h3>
                                <div class="mt-2 flex items-center space-x-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-mono font-medium bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                                        {{ $sparepart->kode_part }}
                                    </span>
                                    @if($sparepart->category)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium"
                                              style="background-color: {{ $sparepart->category->warna }}20; color: {{ $sparepart->category->warna }};">
                                            {{ $sparepart->category->nama }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @php
                                if ($sparepart->stok <= 0) {
                                    $statusClass = 'bg-red-100 text-red-700 dark:bg-red-900/50 dark:text-red-300';
                                    $statusText = 'Habis';
                                } elseif ($sparepart->stok <= $sparepart->stok_minimum) {
                                    $statusClass = 'bg-amber-100 text-amber-700 dark:bg-amber-900/50 dark:text-amber-300';
                                    $statusText = 'Menipis';
                                } else {
                                    $statusClass = 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/50 dark:text-emerald-300';
                                    $statusText = 'Tersedia';
                                }
                            @endphp
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold {{ $statusClass }}">
                                {{ $statusText }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider">Merk</p>
                                <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $sparepart->merk }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider">Lokasi Rak</p>
                                <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ $sparepart->lokasi_rak ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider">Harga Satuan</p>
                                <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">Rp {{ number_format($sparepart->harga, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Nilai Stok</p>
                                <p class="mt-1 text-lg font-semibold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($sparepart->stok * $sparepart->harga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Stock Info Card --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Info Stok</h4>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="text-center">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Stok Saat Ini</p>
                            <p class="text-5xl font-bold {{ $sparepart->stok <= $sparepart->stok_minimum ? 'text-amber-600 dark:text-amber-400' : 'text-emerald-600 dark:text-emerald-400' }}">
                                {{ $sparepart->stok }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">unit</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="text-center">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Stok Minimum</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $sparepart->stok_minimum }}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Buffer</p>
                                <p class="text-2xl font-bold {{ $sparepart->stok - $sparepart->stok_minimum >= 0 ? 'text-emerald-600' : 'text-red-600' }}">
                                    {{ $sparepart->stok - $sparepart->stok_minimum >= 0 ? '+' : '' }}{{ $sparepart->stok - $sparepart->stok_minimum }}
                                </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="text-center">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Total Masuk</p>
                                <p class="text-xl font-bold text-emerald-600 dark:text-emerald-400">+{{ $totalMasuk }}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-sm text-gray-500 dark:text-gray-400">Total Keluar</p>
                                <p class="text-xl font-bold text-rose-600 dark:text-rose-400">-{{ $totalKeluar }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Recent Transactions --}}
                <div class="lg:col-span-3 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Transaksi Terakhir</h4>
                        <a href="{{ route('spareparts.stock-card', $sparepart) }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">Lihat Semua →</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700/50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Tipe</th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Keterangan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Oleh</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($sparepart->transactions as $trans)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                                        {{ $trans->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($trans->type === 'masuk')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700 dark:bg-emerald-900/50 dark:text-emerald-300">
                                                Masuk
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-100 text-rose-700 dark:bg-rose-900/50 dark:text-rose-300">
                                                Keluar
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="text-lg font-bold {{ $trans->type === 'masuk' ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }}">
                                            {{ $trans->type === 'masuk' ? '+' : '-' }}{{ $trans->quantity }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $trans->keterangan ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                                        {{ $trans->user->name }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                        Belum ada transaksi untuk item ini
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
