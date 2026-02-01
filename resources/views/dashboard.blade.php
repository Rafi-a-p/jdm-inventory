<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Welcome Message --}}
            <div class="mb-8 animate-fade-in">
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
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-gray-700 hover:border-indigo-300 dark:hover:border-indigo-500 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 rounded-lg bg-indigo-50 dark:bg-indigo-900/30 group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <dt class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                    Total Jenis
                                </dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-bold text-gray-900 dark:text-white counter" data-target="{{ $totalSpareparts }}">
                                        0
                                    </div>
                                </dd>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Total Stok --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-gray-700 hover:border-slate-300 dark:hover:border-slate-500 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 rounded-lg bg-slate-50 dark:bg-slate-900/30 group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-6 w-6 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <dt class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                    Total Stok
                                </dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-bold text-gray-900 dark:text-white counter" data-target="{{ $totalStok }}">
                                        0
                                    </div>
                                </dd>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 3: Transaksi Hari Ini --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-gray-700 hover:border-emerald-300 dark:hover:border-emerald-500 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 rounded-lg bg-emerald-50 dark:bg-emerald-900/30 group-hover:scale-110 transition-transform duration-300">
                                <svg class="h-6 w-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <dt class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                    Transaksi Hari Ini
                                </dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-bold text-gray-900 dark:text-white counter" data-target="{{ $todayCount }}">
                                        0
                                    </div>
                                    <span class="ml-2 text-xs text-emerald-600 font-medium">+{{ $todayMasuk }} | -{{ $todayKeluar }}</span>
                                </dd>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 4: Role Saya --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-gray-700 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 rounded-lg {{ $userRole === 'admin' ? 'bg-rose-50 dark:bg-rose-900/30' : 'bg-indigo-50 dark:bg-indigo-900/30' }} group-hover:scale-110 transition-transform duration-300">
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
                       class="flex items-center px-5 py-2.5 bg-emerald-600 text-white rounded-lg font-semibold text-sm hover:bg-emerald-700 dark:bg-emerald-600 dark:hover:bg-emerald-500 hover:shadow-lg hover:-translate-y-0.5 transition-all shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Barang Masuk
                    </a>
                    <a href="{{ route('transactions.create.keluar') }}"
                       class="flex items-center px-5 py-2.5 bg-rose-600 text-white rounded-lg font-semibold text-sm hover:bg-rose-700 dark:bg-rose-600 dark:hover:bg-rose-500 hover:shadow-lg hover:-translate-y-0.5 transition-all shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                        </svg>
                        Barang Keluar
                    </a>
                    @if($userRole === 'admin')
                    <a href="{{ route('spareparts.create') }}"
                       class="flex items-center px-5 py-2.5 bg-indigo-600 text-white rounded-lg font-semibold text-sm hover:bg-indigo-700 hover:shadow-lg hover:-translate-y-0.5 transition-all shadow-indigo-200 dark:shadow-none shadow-lg">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Master Data
                    </a>
                    @endif
                </div>
            </div>

            {{-- Diagram Interaktif: Aktivitas & Alur Tindakan --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                {{-- Diagram Aktivitas (Doughnut) --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h4 class="text-base font-bold text-gray-900 dark:text-white flex items-center">
                                <span class="w-1.5 h-1.5 rounded-full bg-violet-500 mr-2"></span>
                                Distribusi Tindakan (7 Hari Terakhir)
                            </h4>
                            <a href="{{ route('activity-logs.index') }}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:underline">USER LOG</a>
                        </div>
                        <div class="relative h-64 flex items-center justify-center">
                            <canvas id="activityChart"></canvas>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 text-center mt-2">Klik legend untuk menyembunyikan/menampilkan. Lihat detail di menu User Log.</p>
                    </div>
                </div>

                {{-- Alur Tindakan Interaktif (Flowchart) --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h4 class="text-base font-bold text-gray-900 dark:text-white flex items-center">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-2"></span>
                                Alur Tindakan & Menu
                            </h4>
                        </div>
                        <div class="overflow-x-auto pb-4">
                            <div id="flow-diagram" class="min-w-[520px] flex flex-col items-center gap-4 py-4">
                                {{-- Baris 1: User -> Login --}}
                                <div class="flex items-center gap-2">
                                    <div class="flow-node px-4 py-2 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 font-semibold text-sm border-2 border-slate-300 dark:border-slate-600">
                                        User
                                    </div>
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                                    <a href="{{ route('dashboard') }}" class="flow-node px-4 py-2 rounded-lg bg-emerald-100 dark:bg-emerald-900/40 text-emerald-800 dark:text-emerald-200 font-semibold text-sm border-2 border-emerald-400 dark:border-emerald-600 hover:scale-105 transition-transform" title="Dashboard">
                                        Login / Dashboard
                                    </a>
                                </div>
                                {{-- Baris 2: Menu akses --}}
                                <div class="flex items-center gap-1">
                                    <svg class="w-5 h-5 text-gray-400 rotate-90 self-center" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                                </div>
                                <div class="flex flex-wrap justify-center gap-2">
                                    <a href="{{ route('spareparts.index') }}" class="flow-node px-3 py-2 rounded-lg bg-indigo-100 dark:bg-indigo-900/40 text-indigo-800 dark:text-indigo-200 font-medium text-xs border-2 border-indigo-400 dark:border-indigo-600 hover:scale-105 transition-transform" title="Data Sparepart">Sparepart</a>
                                    <a href="{{ route('transactions.index') }}" class="flow-node px-3 py-2 rounded-lg bg-rose-100 dark:bg-rose-900/40 text-rose-800 dark:text-rose-200 font-medium text-xs border-2 border-rose-400 dark:border-rose-600 hover:scale-105 transition-transform" title="Transaksi">Transaksi</a>
                                    <a href="{{ route('categories.index') }}" class="flow-node px-3 py-2 rounded-lg bg-amber-100 dark:bg-amber-900/40 text-amber-800 dark:text-amber-200 font-medium text-xs border-2 border-amber-400 dark:border-amber-600 hover:scale-105 transition-transform" title="Kategori">Kategori</a>
                                    <a href="{{ route('reports.index') }}" class="flow-node px-3 py-2 rounded-lg bg-cyan-100 dark:bg-cyan-900/40 text-cyan-800 dark:text-cyan-200 font-medium text-xs border-2 border-cyan-400 dark:border-cyan-600 hover:scale-105 transition-transform" title="Laporan">Laporan</a>
                                    <a href="{{ route('pemetaan-barang.index') }}" class="flow-node px-3 py-2 rounded-lg bg-violet-100 dark:bg-violet-900/40 text-violet-800 dark:text-violet-200 font-medium text-xs border-2 border-violet-400 dark:border-violet-600 hover:scale-105 transition-transform" title="Pemetaan Barang">Pemetaan</a>
                                    <a href="{{ route('activity-logs.index') }}" class="flow-node px-3 py-2 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-800 dark:text-slate-200 font-medium text-xs border-2 border-slate-400 dark:border-slate-600 hover:scale-105 transition-transform" title="User Log">
                                        User Log
                                    </a>
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 text-center mt-4">Klik node untuk membuka menu. Diagram ini memudahkan navigasi dan deteksi alur tindakan.</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                {{-- Transaction Chart --}}
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h4 class="text-base font-bold text-gray-900 dark:text-white flex items-center">
                                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 mr-2"></span>
                                Grafik Transaksi 7 Hari Terakhir
                            </h4>
                        </div>
                        <div class="relative h-64">
                            <canvas id="transactionChart"></canvas>
                        </div>
                    </div>
                </div>

                {{-- Low Stock Alert --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h4 class="text-base font-bold text-gray-900 dark:text-white flex items-center">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-2"></span>
                                Stok Menipis
                            </h4>
                            <span class="text-[10px] font-bold px-2 py-0.5 bg-rose-50 text-rose-600 dark:bg-rose-900/30 dark:text-rose-400 rounded tracking-tighter">BELOW 5 UNIT</span>
                        </div>

                        @if($lowStockItems->isEmpty())
                            <div class="text-center py-10">
                                <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-gray-400 text-sm italic">Status stok aman</p>
                            </div>
                        @else
                            <div class="space-y-3 max-h-80 overflow-y-auto">
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
                            <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                            <p class="text-gray-400 text-sm">Tidak ada transaksi baru</p>
                        </div>
                    @else
                        <div class="divide-y divide-gray-50 dark:divide-gray-700">
                            @foreach($recentTransactions as $transaction)
                                <div class="py-3 flex items-center justify-between group hover:bg-gray-50 dark:hover:bg-gray-700/50 px-3 -mx-3 rounded-lg transition-colors">
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
        </div>
    </div>

    <script>
        // Animated Counter
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.counter');

            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const duration = 2000;
                const increment = target / (duration / 16);
                let current = 0;

                const updateCounter = () => {
                    current += increment;
                    if (current < target) {
                        counter.textContent = Math.floor(current).toLocaleString();
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target.toLocaleString();
                    }
                };

                updateCounter();
            });

            // Chart.js - Activity Doughnut (Distribusi Tindakan)
            const activityCtx = document.getElementById('activityChart');
            if (activityCtx) {
                const isDark = document.documentElement.classList.contains('dark');
                const activityLabels = @json($activityChartLabels);
                const activityData = @json($activityChartData);
                const activityColors = [
                    'rgb(16, 185, 129)',   // emerald - login
                    'rgb(100, 116, 139)',  // slate - logout
                    'rgb(99, 102, 241)',   // indigo - create
                    'rgb(245, 158, 11)',   // amber - update
                    'rgb(244, 63, 94)',   // rose - delete
                    'rgb(16, 185, 129)',  // emerald - masuk
                    'rgb(244, 63, 94)',   // rose - keluar
                ];

                new Chart(activityCtx, {
                    type: 'doughnut',
                    data: {
                        labels: activityLabels,
                        datasets: [{
                            data: activityData,
                            backgroundColor: activityColors.slice(0, activityLabels.length),
                            borderColor: isDark ? 'rgb(31, 41, 55)' : 'rgb(255, 255, 255)',
                            borderWidth: 2,
                            hoverOffset: 8
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'bottom',
                                labels: {
                                    color: isDark ? '#9CA3AF' : '#4B5563',
                                    usePointStyle: true,
                                    padding: 12
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const pct = total > 0 ? ((context.raw / total) * 100).toFixed(1) : 0;
                                        return context.label + ': ' + context.raw + ' (' + pct + '%)';
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Chart.js - Transaction Chart
            const ctx = document.getElementById('transactionChart');
            if (ctx) {
                const isDark = document.documentElement.classList.contains('dark');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['6 Hari Lalu', '5 Hari Lalu', '4 Hari Lalu', '3 Hari Lalu', '2 Hari Lalu', 'Kemarin', 'Hari Ini'],
                        datasets: [{
                            label: 'Barang Masuk',
                            data: [12, 19, 15, 25, 22, 30, {{ $todayMasuk }}],
                            borderColor: 'rgb(16, 185, 129)',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            tension: 0.4,
                            fill: true
                        }, {
                            label: 'Barang Keluar',
                            data: [8, 12, 10, 15, 18, 20, {{ $todayKeluar }}],
                            borderColor: 'rgb(244, 63, 94)',
                            backgroundColor: 'rgba(244, 63, 94, 0.1)',
                            tension: 0.4,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'bottom',
                                labels: {
                                    color: isDark ? '#9CA3AF' : '#4B5563',
                                    usePointStyle: true,
                                    padding: 15
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: isDark ? 'rgba(75, 85, 99, 0.3)' : 'rgba(229, 231, 235, 1)'
                                },
                                ticks: {
                                    color: isDark ? '#9CA3AF' : '#6B7280'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: isDark ? '#9CA3AF' : '#6B7280'
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }
    </style>
</x-app-layout>

