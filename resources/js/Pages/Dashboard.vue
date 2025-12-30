<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    auth: Object,
});

const currentDate = new Date().toLocaleDateString('id-ID', {
    weekday: 'long',
    year: 'numeric',
    month: 'long',
    day: 'numeric'
});

const currentTime = new Date().toLocaleTimeString('id-ID', {
    hour: '2-digit',
    minute: '2-digit'
});
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                        Selamat Datang! 👋
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ currentDate }}</p>
                </div>
            </div>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Weather Card -->
                    <Link :href="route('weather')" class="group">
                        <div
                            class="relative overflow-hidden bg-gradient-to-br from-blue-500 to-cyan-600 rounded-3xl p-6 shadow-xl shadow-blue-500/20 hover:shadow-blue-500/40 transition-all duration-300 hover:-translate-y-1">
                            <div class="relative z-10">
                                <div class="flex items-center justify-between mb-4">
                                    <div
                                        class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                        </svg>
                                    </div>
                                    <span
                                        class="text-white/80 text-sm font-medium group-hover:translate-x-1 transition-transform">
                                        Lihat →
                                    </span>
                                </div>
                                <h3 class="text-white text-lg font-semibold mb-1">Cek Cuaca</h3>
                                <p class="text-white/80 text-sm">Lihat cuaca terkini di kotamu</p>
                            </div>
                            <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-white/10 rounded-full"></div>
                            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full"></div>
                        </div>
                    </Link>

                    <!-- Profile Card -->
                    <Link :href="route('profile.edit')" class="group">
                        <div
                            class="relative overflow-hidden bg-gradient-to-br from-purple-500 to-pink-600 rounded-3xl p-6 shadow-xl shadow-purple-500/20 hover:shadow-purple-500/40 transition-all duration-300 hover:-translate-y-1">
                            <div class="relative z-10">
                                <div class="flex items-center justify-between mb-4">
                                    <div
                                        class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <span
                                        class="text-white/80 text-sm font-medium group-hover:translate-x-1 transition-transform">
                                        Edit →
                                    </span>
                                </div>
                                <h3 class="text-white text-lg font-semibold mb-1">Profil Saya</h3>
                                <p class="text-white/80 text-sm">Kelola informasi akunmu</p>
                            </div>
                            <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-white/10 rounded-full"></div>
                            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full"></div>
                        </div>
                    </Link>

                    <!-- Stats Card -->
                    <div
                        class="relative overflow-hidden bg-gradient-to-br from-orange-500 to-red-600 rounded-3xl p-6 shadow-xl shadow-orange-500/20">
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <div
                                    class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="text-white text-lg font-semibold mb-1">Laravel Actions</h3>
                            <p class="text-white/80 text-sm">Arsitektur modern & clean</p>
                        </div>
                        <div class="absolute -right-8 -bottom-8 w-32 h-32 bg-white/10 rounded-full"></div>
                        <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full"></div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Welcome Content -->
                    <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-3xl shadow-xl p-8">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">
                            🚀 Tentang Aplikasi Ini
                        </h3>
                        <div class="prose dark:prose-invert max-w-none">
                            <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-4">
                                Aplikasi ini dibangun dengan <strong>Laravel + Laravel Actions</strong> dimana semua
                                controller diganti dengan Action classes. Ini memberikan kode yang lebih bersih,
                                reusable, dan mudah di-test.
                            </p>
                            <div class="grid grid-cols-2 gap-4 mt-6">
                                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-2xl p-4">
                                    <div class="text-2xl font-bold text-purple-600 dark:text-purple-400 mb-1">16+</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Action Classes</div>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-2xl p-4">
                                    <div class="text-2xl font-bold text-blue-600 dark:text-blue-400 mb-1">Vue 3</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Frontend</div>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-2xl p-4">
                                    <div class="text-2xl font-bold text-cyan-600 dark:text-cyan-400 mb-1">Inertia</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">SPA Experience</div>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-2xl p-4">
                                    <div class="text-2xl font-bold text-pink-600 dark:text-pink-400 mb-1">Tailwind</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Styling</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl p-8">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">
                            ⚡ Quick Actions
                        </h3>
                        <div class="space-y-4">
                            <Link :href="route('weather')"
                                class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-2xl hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                <div
                                    class="w-10 h-10 bg-blue-100 dark:bg-blue-900/50 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900 dark:text-white">Cek Cuaca</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Lihat cuaca saat ini</div>
                                </div>
                            </Link>
                            <Link :href="route('profile.edit')"
                                class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-2xl hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                <div
                                    class="w-10 h-10 bg-purple-100 dark:bg-purple-900/50 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900 dark:text-white">Edit Profil</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Ubah data akun</div>
                                </div>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
