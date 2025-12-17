<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Welcome Message --}}
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Selamat Datang, {{ $userName }}! 👋
                </h3>
                <p class="mt-1 text-gray-600 dark:text-gray-400">
                    Berikut adalah ringkasan data inventaris bengkel hari ini.
                </p>
            </div>

            {{-- Stats Cards Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                {{-- Card 1: Total Jenis Sparepart --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 shadow-lg">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                        Total Jenis Sparepart
                                    </dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-3xl font-bold text-gray-900 dark:text-white">
                                            {{ number_format($totalSpareparts) }}
                                        </div>
                                        <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">item</span>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-3">
                        <a href="{{ route('spareparts.index') }}" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 flex items-center">
                            Lihat Semua
                            <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Card 2: Total Stok --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 shadow-lg">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                        Total Stok Barang
                                    </dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-3xl font-bold text-gray-900 dark:text-white">
                                            {{ number_format($totalStok) }}
                                        </div>
                                        <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">unit</span>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-3">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Stok tersedia di gudang</span>
                    </div>
                </div>

                {{-- Card 3: Transaksi Hari Ini --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 shadow-lg">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                        Transaksi Hari Ini
                                    </dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-3xl font-bold text-gray-900 dark:text-white">
                                            {{ $todayCount }}
                                        </div>
                                        <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">transaksi</span>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-3 flex justify-between">
                        <span class="text-sm text-emerald-600 dark:text-emerald-400">+{{ $todayMasuk }} masuk</span>
                        <span class="text-sm text-rose-600 dark:text-rose-400">-{{ $todayKeluar }} keluar</span>
                    </div>
                </div>

                {{-- Card 4: Role Saya --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 rounded-xl bg-gradient-to-br {{ $userRole === 'admin' ? 'from-rose-500 to-rose-600' : 'from-indigo-500 to-indigo-600' }} shadow-lg">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                        Role Saya
                                    </dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-3xl font-bold text-gray-900 dark:text-white capitalize">
                                            {{ $userRole }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-3">
                        <span class="text-sm {{ $userRole === 'admin' ? 'text-rose-600 dark:text-rose-400' : 'text-indigo-600 dark:text-indigo-400' }}">
                            {{ $userRole === 'admin' ? '🔓 Akses penuh ke sistem' : '📝 Kelola transaksi stok' }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700 mb-8">
                <div class="p-6">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">⚡ Aksi Cepat</h4>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('transactions.create.masuk') }}"
                           class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-500 to-emerald-600 border border-transparent rounded-lg font-medium text-sm text-white hover:from-emerald-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all duration-200 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                            </svg>
                            Barang Masuk
                        </a>
                        <a href="{{ route('transactions.create.keluar') }}"
                           class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-rose-500 to-rose-600 border border-transparent rounded-lg font-medium text-sm text-white hover:from-rose-600 hover:to-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 transition-all duration-200 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                            </svg>
                            Barang Keluar
                        </a>
                        <a href="{{ route('transactions.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg font-medium text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Riwayat Transaksi
                        </a>
                        @if($userRole === 'admin')
                        <a href="{{ route('spareparts.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-indigo-600 border border-transparent rounded-lg font-medium text-sm text-white hover:from-indigo-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Sparepart
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {{-- Recent Transactions --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white">📋 Transaksi Terbaru</h4>
                            <a href="{{ route('transactions.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">Lihat Semua</a>
                        </div>

                        @if($recentTransactions->isEmpty())
                            <div class="text-center py-8">
                                <div class="w-12 h-12 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">Belum ada transaksi</p>
                                <a href="{{ route('transactions.create.masuk') }}" class="mt-2 inline-block text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                                    + Buat transaksi pertama
                                </a>
                            </div>
                        @else
                            <div class="space-y-3">
                                @foreach($recentTransactions as $transaction)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                        <div class="flex items-center">
                                            <div class="p-2 rounded-lg {{ $transaction->type === 'masuk' ? 'bg-emerald-100 dark:bg-emerald-900/50' : 'bg-rose-100 dark:bg-rose-900/50' }} mr-3">
                                                @if($transaction->type === 'masuk')
                                                    <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                                    </svg>
                                                @else
                                                    <svg class="w-4 h-4 text-rose-600 dark:text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                                                    </svg>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $transaction->sparepart->nama_barang }}</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $transaction->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        <span class="text-sm font-bold {{ $transaction->type === 'masuk' ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }}">
                                            {{ $transaction->type === 'masuk' ? '+' : '-' }}{{ $transaction->quantity }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Low Stock Alert --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white">⚠️ Stok Menipis</h4>
                            <span class="text-xs text-gray-500 dark:text-gray-400">Stok ≤ 5 unit</span>
                        </div>

                        @if($lowStockItems->isEmpty())
                            <div class="text-center py-8">
                                <div class="w-12 h-12 rounded-full bg-emerald-100 dark:bg-emerald-900/50 flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">Semua stok dalam kondisi baik!</p>
                            </div>
                        @else
                            <div class="space-y-3">
                                @foreach($lowStockItems as $item)
                                    <div class="flex items-center justify-between p-3 bg-amber-50 dark:bg-amber-900/20 rounded-lg border border-amber-200 dark:border-amber-800">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $item->nama_barang }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $item->kode_part }} • {{ $item->merk }}</p>
                                        </div>
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $item->stok == 0 ? 'bg-red-100 text-red-700 dark:bg-red-900/50 dark:text-red-300' : 'bg-amber-100 text-amber-700 dark:bg-amber-900/50 dark:text-amber-300' }}">
                                            {{ $item->stok }} unit
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
