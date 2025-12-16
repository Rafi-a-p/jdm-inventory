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

                {{-- Card 3: Total Nilai Inventaris --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 p-3 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 shadow-lg">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                        Nilai Inventaris
                                    </dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-bold text-gray-900 dark:text-white">
                                            Rp {{ number_format($totalNilai, 0, ',', '.') }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-3">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Estimasi nilai total</span>
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
                            {{ $userRole === 'admin' ? '🔓 Akses penuh ke sistem' : '👁️ Akses terbatas (view only)' }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Quick Actions (Admin Only) --}}
            @if($userRole === 'admin')
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">⚡ Aksi Cepat</h4>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('spareparts.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-indigo-600 border border-transparent rounded-lg font-medium text-sm text-white hover:from-indigo-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Sparepart Baru
                        </a>
                        <a href="{{ route('spareparts.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg font-medium text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Kelola Data Sparepart
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
