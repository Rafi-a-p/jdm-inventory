<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Pemetaan Barang') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Pencarian barang secara fisik berdasarkan jenis dan lokasi rak</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Filter --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm mb-6 p-4">
                <form method="GET" action="{{ route('pemetaan-barang.index') }}" class="flex flex-wrap gap-4 items-end">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Kategori / Jenis</label>
                        <select name="category_id" class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm w-56">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->nama }} ({{ $cat->spareparts_count }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Lokasi Rak</label>
                        <select name="lokasi_rak" class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm w-48">
                            <option value="">Semua Lokasi</option>
                            @foreach($lokasiList as $loc)
                                <option value="{{ $loc }}" {{ request('lokasi_rak') === $loc ? 'selected' : '' }}>{{ $loc }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Cari (kode, nama, merk, lokasi)</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Kode / Nama / Merk / Lokasi..."
                               class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm w-64">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700">Cari</button>
                        <a href="{{ route('pemetaan-barang.index') }}" class="px-4 py-2 bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-lg text-sm font-medium hover:bg-gray-300 dark:hover:bg-gray-500">Reset</a>
                    </div>
                </form>
            </div>

            {{-- Map by Category & Location --}}
            <div class="space-y-6">
                @forelse($byCategory as $catId => $data)
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center gap-3"
                             style="border-left: 4px solid {{ $data['category_color'] }};">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ $data['category_name'] }}</h3>
                            <span class="text-sm text-gray-500 dark:text-gray-400">({{ $data['items']->sum(fn($i) => $i->count()) }} barang)</span>
                        </div>
                        <div class="p-6">
                            @foreach($data['items'] as $lokasi => $items)
                                <div class="mb-6 last:mb-0">
                                    <div class="flex items-center gap-2 mb-3">
                                        <svg class="w-5 h-5 text-indigo-500 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span class="font-semibold text-gray-700 dark:text-gray-300">Lokasi: {{ $lokasi ?: 'Belum diisi' }}</span>
                                    </div>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                                        @foreach($items as $item)
                                            <a href="{{ route('spareparts.show', $item) }}"
                                               class="block p-4 rounded-lg border border-gray-200 dark:border-gray-600 hover:border-indigo-300 dark:hover:border-indigo-500 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all group">
                                                <div class="flex justify-between items-start">
                                                    <div class="min-w-0 flex-1">
                                                        <p class="font-semibold text-gray-900 dark:text-white truncate group-hover:text-indigo-600 dark:group-hover:text-indigo-400">{{ $item->nama_barang }}</p>
                                                        <p class="text-xs font-mono text-gray-500 dark:text-gray-400 mt-0.5">{{ $item->kode_part }}</p>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $item->merk }}</p>
                                                    </div>
                                                    <span class="flex-shrink-0 ml-2 inline-flex items-center px-2 py-1 rounded-md text-xs font-bold
                                                        {{ $item->stok <= 0 ? 'bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400' : ($item->stok <= $item->stok_minimum ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' : 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400') }}">
                                                        {{ $item->stok }} unit
                                                    </span>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm p-12 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400">Tidak ada barang yang sesuai filter.</p>
                        <a href="{{ route('pemetaan-barang.index') }}" class="mt-4 inline-flex text-indigo-600 dark:text-indigo-400 hover:underline">Tampilkan semua</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
