<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('categories.index') }}" class="mr-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Tambah Kategori') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Buat kategori baru untuk mengelompokkan sparepart
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-700">
                <form method="POST" action="{{ route('categories.store') }}" class="p-6 space-y-6">
                    @csrf

                    {{-- Nama --}}
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Nama Kategori <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                               class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 transition-colors @error('nama') border-red-500 @enderror"
                               placeholder="Contoh: Body Parts, Engine Parts, dll"
                               required>
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Deskripsi
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                                  class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 transition-colors"
                                  placeholder="Deskripsi singkat kategori (opsional)">{{ old('deskripsi') }}</textarea>
                    </div>

                    {{-- Warna --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Warna Badge <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-8 gap-2">
                            @php
                                $colors = [
                                    '#ef4444' => 'Merah',
                                    '#f97316' => 'Orange',
                                    '#eab308' => 'Kuning',
                                    '#22c55e' => 'Hijau',
                                    '#14b8a6' => 'Teal',
                                    '#3b82f6' => 'Biru',
                                    '#6366f1' => 'Indigo',
                                    '#8b5cf6' => 'Ungu',
                                    '#ec4899' => 'Pink',
                                    '#78716c' => 'Abu',
                                ];
                            @endphp
                            @foreach($colors as $hex => $name)
                                <label class="relative cursor-pointer">
                                    <input type="radio" name="warna" value="{{ $hex }}" class="sr-only peer" {{ old('warna', '#6366f1') === $hex ? 'checked' : '' }}>
                                    <div class="w-10 h-10 rounded-lg peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-gray-400 transition-all" style="background-color: {{ $hex }};" title="{{ $name }}"></div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Preview --}}
                    <div x-data="{ nama: '{{ old('nama', 'Nama Kategori') }}', warna: '{{ old('warna', '#6366f1') }}' }">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Preview Badge
                        </label>
                        <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium"
                                  :style="'background-color: ' + warna + '20; color: ' + warna">
                                <span class="w-2 h-2 rounded-full mr-2" :style="'background-color: ' + warna"></span>
                                <span x-text="nama || 'Nama Kategori'"></span>
                            </span>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('categories.index') }}"
                           class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-lg hover:from-indigo-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all">
                            Simpan Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('input[name="warna"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelector('[x-data]').__x.$data.warna = this.value;
            });
        });
        document.getElementById('nama').addEventListener('input', function() {
            document.querySelector('[x-data]').__x.$data.nama = this.value;
        });
    </script>
</x-app-layout>
