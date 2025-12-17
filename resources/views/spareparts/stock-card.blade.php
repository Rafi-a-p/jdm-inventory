<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('spareparts.show', $sparepart) }}" class="mr-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Kartu Stok') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    {{ $sparepart->nama_barang }} ({{ $sparepart->kode_part }})
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Item Info --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 mb-6">
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">Kode Part</p>
                        <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $sparepart->kode_part }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">Nama Barang</p>
                        <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $sparepart->nama_barang }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">Merk</p>
                        <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $sparepart->merk }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">Stok Saat Ini</p>
                        <p class="text-lg font-bold {{ $sparepart->stok <= $sparepart->stok_minimum ? 'text-amber-600 dark:text-amber-400' : 'text-emerald-600 dark:text-emerald-400' }}">
                            {{ $sparepart->stok }} unit
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">Stok Minimum</p>
                        <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $sparepart->stok_minimum }} unit</p>
                    </div>
                </div>
            </div>

            {{-- Filter Period --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 mb-6">
                <form method="GET" action="{{ route('spareparts.stock-card', $sparepart) }}" class="flex flex-wrap gap-4 items-end">
                    <div class="flex-1 min-w-[150px]">
                        <label for="from_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Dari Tanggal</label>
                        <input type="date" name="from_date" id="from_date" value="{{ $fromDate }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 text-sm">
                    </div>
                    <div class="flex-1 min-w-[150px]">
                        <label for="to_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sampai Tanggal</label>
                        <input type="date" name="to_date" id="to_date" value="{{ $toDate }}" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 text-sm">
                    </div>
                    <div class="flex space-x-2">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                            Filter
                        </button>
                        <a href="{{ route('reports.stock-card', $sparepart) }}?from_date={{ $fromDate }}&to_date={{ $toDate }}"
                           class="px-4 py-2 bg-gradient-to-r from-rose-500 to-rose-600 text-white text-sm font-medium rounded-lg hover:from-rose-600 hover:to-rose-700 transition-all inline-flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download PDF
                        </a>
                    </div>
                </form>
            </div>

            {{-- Transaction History Table --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">No</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Tanggal</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Keterangan</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Masuk</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Keluar</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Saldo</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">Oleh</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            {{-- Saldo Awal --}}
                            <tr class="bg-amber-50 dark:bg-amber-900/20">
                                <td class="px-4 py-3"></td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900 dark:text-white" colspan="2">
                                    Saldo Awal Periode
                                </td>
                                <td class="px-4 py-3 text-center text-sm text-gray-500">-</td>
                                <td class="px-4 py-3 text-center text-sm text-gray-500">-</td>
                                <td class="px-4 py-3 text-center text-lg font-bold text-gray-900 dark:text-white">{{ $stockBefore }}</td>
                                <td class="px-4 py-3 text-sm text-gray-500">-</td>
                            </tr>
                            @forelse($transactions as $index => $trans)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                    {{ $trans->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400">
                                    {{ $trans->keterangan ?? ($trans->type === 'masuk' ? 'Barang Masuk' : 'Barang Keluar') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @if($trans->type === 'masuk')
                                        <span class="text-lg font-bold text-emerald-600 dark:text-emerald-400">+{{ $trans->quantity }}</span>
                                    @else
                                        <span class="text-sm text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @if($trans->type === 'keluar')
                                        <span class="text-lg font-bold text-rose-600 dark:text-rose-400">-{{ $trans->quantity }}</span>
                                    @else
                                        <span class="text-sm text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center text-lg font-bold text-gray-900 dark:text-white">
                                    {{ $trans->running_balance }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400">
                                    {{ $trans->user->name }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-4 py-12 text-center text-gray-500 dark:text-gray-400">
                                    Tidak ada transaksi pada periode ini
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Summary Footer --}}
                <div class="p-4 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600 dark:text-gray-400">
                            Total {{ $transactions->count() }} transaksi
                        </span>
                        <span class="text-lg font-bold text-gray-900 dark:text-white">
                            Stok Akhir: {{ $sparepart->stok }} unit
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
