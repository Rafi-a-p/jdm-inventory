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
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-gray-700 hover:border-indigo-300 dark:hover:border-indigo-500 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 rounded-lg bg-indigo-50 dark:bg-indigo-900/30">
                                <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <dt class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                    Total Jenis
                                </dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-bold text-gray-900 dark:text-white">
                                        {{ number_format($totalSpareparts) }}
                                    </div>
                                </dd>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Total Stok --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-gray-700 hover:border-slate-300 dark:hover:border-slate-500 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 rounded-lg bg-slate-50 dark:bg-slate-900/30">
                                <svg class="h-6 w-6 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <dt class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                    Total Stok
                                </dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-bold text-gray-900 dark:text-white">
                                        {{ number_format($totalStok) }}
                                    </div>
                                </dd>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 3: Transaksi Hari Ini --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-gray-700 hover:border-emerald-300 dark:hover:border-emerald-500 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 rounded-lg bg-emerald-50 dark:bg-emerald-900/30">
                                <svg class="h-6 w-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <dt class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                    Transaksi Hari Ini
                                </dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-bold text-gray-900 dark:text-white">
                                        {{ $todayCount }}
                                    </div>
                                    <span class="ml-2 text-xs text-emerald-600 font-medium">+{{ $todayMasuk }} | -{{ $todayKeluar }}</span>
                                </dd>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 4: Role Saya --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-gray-700 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 rounded-lg {{ $userRole === 'admin' ? 'bg-rose-50 dark:bg-rose-900/30' : 'bg-indigo-50 dark:bg-indigo-900/30' }}">
                                <svg class="h-6 w-6 {{ $userRole === 'admin' ? 'text-rose-600 dark:text-rose-400' : 'text-indigo-600 dark:text-indigo-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <dt class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                    Akses Level
                                </dt>
                                <dd class="text-lg font-bold text-gray-900 dark:text-white capitalize">
                                    {{ $userRole }}
                                </dd>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="mb-8">
                <h4 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">Aksi Cepat</h4>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('transactions.create.masuk') }}"
                       class="flex items-center px-5 py-2.5 bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-lg font-semibold text-sm hover:bg-slate-800 dark:hover:bg-slate-100 transition-all shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Barang Masuk
                    </a>
                    <a href="{{ route('transactions.create.keluar') }}"
                       class="flex items-center px-5 py-2.5 bg-white dark:bg-slate-800 text-slate-900 dark:text-white border border-slate-200 dark:border-slate-700 rounded-lg font-semibold text-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition-all shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                        </svg>
                        Barang Keluar
                    </a>
                    @if($userRole === 'admin')
                    <a href="{{ route('spareparts.create') }}"
                       class="flex items-center px-5 py-2.5 bg-indigo-600 text-white rounded-lg font-semibold text-sm hover:bg-indigo-700 transition-all shadow-indigo-200 dark:shadow-none shadow-lg">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Master Data
                    </a>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {{-- Recent Transactions --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h4 class="text-base font-bold text-gray-900 dark:text-white flex items-center">
                                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 mr-2"></span>
                                Transaksi Terakhir
                            </h4>
                            <a href="{{ route('transactions.index') }}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline">LIHAT SEMUA</a>
                        </div>

                        @if($recentTransactions->isEmpty())
                            <div class="text-center py-10">
                                <p class="text-gray-400 text-sm">Tidak ada transaksi baru</p>
                            </div>
                        @else
                            <div class="divide-y divide-gray-50 dark:divide-gray-700">
                                @foreach($recentTransactions as $transaction)
                                    <div class="py-3 flex items-center justify-between group">
                                        <div class="flex items-center">
                                            <div class="w-2 h-2 rounded-full {{ $transaction->type === 'masuk' ? 'bg-emerald-500' : 'bg-rose-500' }} mr-4"></div>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ $transaction->sparepart->nama_barang }}</p>
                                                <p class="text-xs text-gray-400 uppercase">{{ $transaction->created_at->format('H:i') }} • {{ $transaction->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-mono font-bold {{ $transaction->type === 'masuk' ? 'text-emerald-600' : 'text-rose-600' }}">
                                                {{ $transaction->type === 'masuk' ? '+' : '-' }}{{ $transaction->quantity }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Low Stock Alert --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h4 class="text-base font-bold text-gray-900 dark:text-white flex items-center">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-2"></span>
                                Stok Menipis (Critical)
                            </h4>
                            <span class="text-[10px] font-bold px-2 py-0.5 bg-rose-50 text-rose-600 dark:bg-rose-900/30 dark:text-rose-400 rounded tracking-tighter">BELOW 5 UNIT</span>
                        </div>

                        @if($lowStockItems->isEmpty())
                            <div class="text-center py-10">
                                <p class="text-gray-400 text-sm italic">Status stok aman</p>
                            </div>
                        @else
                            <div class="space-y-3">
                                @foreach($lowStockItems as $item)
                                    <div class="flex items-center justify-between p-3 bg-slate-50 dark:bg-slate-900/40 rounded-lg border border-transparent hover:border-slate-200 dark:hover:border-slate-700 transition-all">
                                        <div class="min-w-0">
                                            <p class="text-sm font-semibold text-gray-800 dark:text-gray-200 truncate">{{ $item->nama_barang }}</p>
                                            <p class="text-[10px] text-gray-400 font-mono tracking-tighter uppercase">{{ $item->kode_part }}</p>
                                        </div>
                                        <div class="ml-4 flex-shrink-0">
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-[10px] font-bold border {{ $item->stok == 0 ? 'bg-rose-50 text-rose-700 border-rose-100 dark:bg-rose-900/20 dark:text-rose-400 dark:border-rose-900' : 'bg-orange-50 text-orange-700 border-orange-100 dark:bg-orange-900/20 dark:text-orange-400 dark:border-orange-900' }}">
                                                {{ $item->stok }} UNIT
                                            </span>
                                        </div>
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
