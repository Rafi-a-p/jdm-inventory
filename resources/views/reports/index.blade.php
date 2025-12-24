<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Laporan & Export') }}
            </h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Generate laporan PDF dan export data ke Excel
            </p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                {{-- Laporan Stok PDF --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center">
                            <div class="p-3 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Laporan Stok (PDF)</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Download daftar stok sparepart dalam format PDF</p>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('reports.stock') }}" method="GET" class="p-6 space-y-4">
                        <div>
                            <label for="stock_category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Filter Kategori
                            </label>
                            <select name="category_id" id="stock_category" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="low_stock_only" value="1" class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Hanya tampilkan stok menipis</span>
                            </label>
                        </div>
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download PDF Stok
                        </button>
                    </form>
                </div>

                {{-- Laporan Transaksi PDF --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center">
                            <div class="p-3 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Laporan Transaksi (PDF)</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Download riwayat transaksi dalam format PDF</p>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('reports.transactions') }}" method="GET" class="p-6 space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="trans_from" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Dari Tanggal <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="from_date" id="trans_from" required value="{{ now()->startOfMonth()->format('Y-m-d') }}"
                                       class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            </div>
                            <div>
                                <label for="trans_to" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Sampai Tanggal <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="to_date" id="trans_to" required value="{{ now()->format('Y-m-d') }}"
                                       class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            </div>
                        </div>
                        <div>
                            <label for="trans_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Tipe Transaksi
                            </label>
                            <select name="type" id="trans_type" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Semua</option>
                                <option value="masuk">Barang Masuk</option>
                                <option value="keluar">Barang Keluar</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-medium rounded-lg hover:from-emerald-600 hover:to-emerald-700 transition-all">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download PDF Transaksi
                        </button>
                    </form>
                </div>

                {{-- Export Sparepart Excel --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center">
                            <div class="p-3 rounded-xl bg-gradient-to-br from-green-600 to-green-700 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Export Sparepart (Excel/CSV)</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Download data sparepart dalam format CSV</p>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('export.spareparts') }}" method="GET" class="p-6 space-y-4">
                        <div>
                            <label for="export_category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Filter Kategori
                            </label>
                            <select name="category_id" id="export_category" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-green-600 to-green-700 text-white font-medium rounded-lg hover:from-green-700 hover:to-green-800 transition-all">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download CSV Sparepart
                        </button>
                    </form>
                </div>

                {{-- Export Transaksi Excel --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center">
                            <div class="p-3 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Export Transaksi (Excel/CSV)</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Download data transaksi dalam format CSV</p>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('export.transactions') }}" method="GET" class="p-6 space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="exp_from" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Dari Tanggal
                                </label>
                                <input type="date" name="from_date" id="exp_from" value="{{ now()->startOfMonth()->format('Y-m-d') }}"
                                       class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            </div>
                            <div>
                                <label for="exp_to" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Sampai Tanggal
                                </label>
                                <input type="date" name="to_date" id="exp_to" value="{{ now()->format('Y-m-d') }}"
                                       class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            </div>
                        </div>
                        <div>
                            <label for="exp_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Tipe Transaksi
                            </label>
                            <select name="type" id="exp_type" class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <option value="">Semua</option>
                                <option value="masuk">Barang Masuk</option>
                                <option value="keluar">Barang Keluar</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-amber-500 to-amber-600 text-white font-medium rounded-lg hover:from-amber-600 hover:to-amber-700 transition-all">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download CSV Transaksi
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
