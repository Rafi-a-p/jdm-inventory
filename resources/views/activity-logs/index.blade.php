<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('User Log') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Riwayat tindakan pengguna dalam sistem</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Filter --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm mb-6 p-4">
                <form method="GET" action="{{ route('activity-logs.index') }}" class="flex flex-wrap gap-4 items-end">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Tindakan</label>
                        <select name="action" class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm w-40">
                            <option value="">Semua</option>
                            @foreach($actionOptions as $key => $label)
                                <option value="{{ $key }}" {{ request('action') === $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Subjek</label>
                        <select name="subject_type" class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm w-40">
                            <option value="">Semua</option>
                            @foreach($subjectTypeOptions as $key => $label)
                                <option value="{{ $key }}" {{ request('subject_type') === $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if(auth()->user()->role === 'admin' && $users->isNotEmpty())
                    <div>
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">User</label>
                        <select name="user_id" class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm w-48">
                            <option value="">Semua User</option>
                            @foreach($users as $u)
                                <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div>
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Dari Tanggal</label>
                        <input type="date" name="from_date" value="{{ request('from_date') }}"
                               class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm w-40">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Sampai Tanggal</label>
                        <input type="date" name="to_date" value="{{ request('to_date') }}"
                               class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm w-40">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Cari</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Deskripsi..."
                               class="rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 text-sm w-48">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700">Filter</button>
                        <a href="{{ route('activity-logs.index') }}" class="px-4 py-2 bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-lg text-sm font-medium hover:bg-gray-300 dark:hover:bg-gray-500">Reset</a>
                    </div>
                </form>
            </div>

            {{-- Table --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-xl border border-gray-100 dark:border-gray-700">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Waktu</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">User</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tindakan</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Subjek</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Deskripsi</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">IP</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($logs as $log)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                    <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300 whitespace-nowrap">
                                        {{ $log->created_at->format('d/m/Y H:i') }}
                                        <span class="text-gray-400 text-xs block">{{ $log->created_at->diffForHumans() }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        @if($log->user)
                                            <span class="font-medium text-gray-900 dark:text-white">{{ $log->user->name }}</span>
                                            <span class="text-gray-500 text-xs block">{{ $log->user->email }}</span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @php
                                            $actionColors = [
                                                'login' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
                                                'logout' => 'bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-300',
                                                'create' => 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-400',
                                                'update' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
                                                'delete' => 'bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400',
                                                'transaction_masuk' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
                                                'transaction_keluar' => 'bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400',
                                            ];
                                            $color = $actionColors[$log->action] ?? 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300';
                                        @endphp
                                        <span class="inline-flex px-2 py-1 rounded-md text-xs font-medium {{ $color }}">{{ $log->action_label }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">{{ $log->subject_type_label }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-200 max-w-xs truncate" title="{{ $log->description }}">{{ $log->description }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400 font-mono text-xs">{{ $log->ip_address }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-12 text-center text-gray-500 dark:text-gray-400">Tidak ada data log.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($logs->hasPages())
                    <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700">
                        {{ $logs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
