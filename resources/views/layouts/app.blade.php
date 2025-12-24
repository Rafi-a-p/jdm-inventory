<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))" :class="{ 'dark': darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'JDM Inventory') }} - Sistem Inventaris Bengkel</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 bg-gray-100 dark:bg-gray-900 dark:text-gray-100">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Toast Notification Container -->
        <div x-data="toastNotification()"
             x-init="init()"
             @notify.window="show($event.detail)"
             class="fixed top-4 right-4 z-50 space-y-3"
             style="pointer-events: none;">
            <template x-for="(toast, index) in toasts" :key="toast.id">
                <div x-show="toast.visible"
                     x-transition:enter="transform ease-out duration-300 transition"
                     x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                     x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     :class="{
                         'bg-green-50 dark:bg-green-900/30 border-green-500': toast.type === 'success',
                         'bg-red-50 dark:bg-red-900/30 border-red-500': toast.type === 'error',
                         'bg-yellow-50 dark:bg-yellow-900/30 border-yellow-500': toast.type === 'warning',
                         'bg-blue-50 dark:bg-blue-900/30 border-blue-500': toast.type === 'info'
                     }"
                     class="max-w-sm w-full shadow-lg rounded-lg pointer-events-auto border-l-4 backdrop-blur-sm"
                     style="pointer-events: auto;">
                    <div class="p-4">
                        <div class="flex items-start">
                            <!-- Icon -->
                            <div class="flex-shrink-0">
                                <!-- Success Icon -->
                                <template x-if="toast.type === 'success'">
                                    <svg class="h-6 w-6 text-green-500 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </template>
                                <!-- Error Icon -->
                                <template x-if="toast.type === 'error'">
                                    <svg class="h-6 w-6 text-red-500 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </template>
                                <!-- Warning Icon -->
                                <template x-if="toast.type === 'warning'">
                                    <svg class="h-6 w-6 text-yellow-500 dark:text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                </template>
                                <!-- Info Icon -->
                                <template x-if="toast.type === 'info'">
                                    <svg class="h-6 w-6 text-blue-500 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </template>
                            </div>
                            <!-- Message -->
                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                <p x-text="toast.message"
                                   :class="{
                                       'text-green-800 dark:text-green-200': toast.type === 'success',
                                       'text-red-800 dark:text-red-200': toast.type === 'error',
                                       'text-yellow-800 dark:text-yellow-200': toast.type === 'warning',
                                       'text-blue-800 dark:text-blue-200': toast.type === 'info'
                                   }"
                                   class="text-sm font-medium"></p>
                            </div>
                            <!-- Close Button -->
                            <div class="ml-4 flex-shrink-0 flex">
                                <button @click="remove(index)"
                                        :class="{
                                            'text-green-500 hover:text-green-600 dark:text-green-400': toast.type === 'success',
                                            'text-red-500 hover:text-red-600 dark:text-red-400': toast.type === 'error',
                                            'text-yellow-500 hover:text-yellow-600 dark:text-yellow-400': toast.type === 'warning',
                                            'text-blue-500 hover:text-blue-600 dark:text-blue-400': toast.type === 'info'
                                        }"
                                        class="inline-flex rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2"
                                        aria-label="Close">
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <script>
            function toastNotification() {
                return {
                    toasts: [],
                    nextId: 1,

                    init() {
                        // Check for Laravel flash messages
                        @if(session('success'))
                            this.show({ message: "{{ session('success') }}", type: 'success' });
                        @endif
                        @if(session('error'))
                            this.show({ message: "{{ session('error') }}", type: 'error' });
                        @endif
                        @if(session('warning'))
                            this.show({ message: "{{ session('warning') }}", type: 'warning' });
                        @endif
                        @if(session('info'))
                            this.show({ message: "{{ session('info') }}", type: 'info' });
                        @endif
                    },

                    show(data) {
                        const toast = {
                            id: this.nextId++,
                            message: data.message || 'Notification',
                            type: data.type || 'info',
                            visible: false
                        };

                        this.toasts.push(toast);

                        // Show with slight delay for animation
                        setTimeout(() => {
                            toast.visible = true;
                        }, 100);

                        // Auto remove after 5 seconds
                        setTimeout(() => {
                            this.remove(this.toasts.indexOf(toast));
                        }, 5000);
                    },

                    remove(index) {
                        if (this.toasts[index]) {
                            this.toasts[index].visible = false;
                            setTimeout(() => {
                                this.toasts.splice(index, 1);
                            }, 300);
                        }
                    }
                }
            }
        </script>
    </body>
</html>
