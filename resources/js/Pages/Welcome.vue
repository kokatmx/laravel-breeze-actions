<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>

    <Head title="Welcome" />

    <div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
        <!-- Animated Background -->
        <div class="absolute inset-0 overflow-hidden">
            <div
                class="absolute -top-40 -right-40 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
            </div>
            <div
                class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000">
            </div>
        </div>

        <!-- Navigation -->
        <nav class="relative z-10 flex items-center justify-between px-6 py-4 lg:px-12">
            <div class="flex items-center gap-2">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="text-xl font-bold text-white">WeatherApp</span>
            </div>

            <div v-if="canLogin" class="flex items-center gap-4">
                <Link :href="route('login')"
                    class="text-sm font-medium text-gray-300 hover:text-white transition-colors">
                    Masuk
                </Link>
                <Link v-if="canRegister" :href="route('register')"
                    class="px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-purple-600 to-pink-600 rounded-xl hover:from-purple-700 hover:to-pink-700 transition-all duration-300 shadow-lg shadow-purple-500/25 hover:shadow-purple-500/40">
                    Daftar Gratis
                </Link>
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="relative z-10 flex flex-col items-center justify-center px-6 pt-20 pb-32 lg:pt-32">
            <div class="text-center max-w-4xl">
                <!-- Badge -->
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 mb-8 text-sm font-medium text-purple-300 bg-purple-500/10 border border-purple-500/20 rounded-full backdrop-blur-sm">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    Powered by Laravel Actions
                </div>

                <!-- Heading -->
                <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
                    Cek Cuaca
                    <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-pink-400 to-purple-400">
                        Kapan Saja
                    </span>
                    <br>Dimana Saja
                </h1>

                <!-- Description -->
                <p class="text-xl text-gray-400 mb-12 max-w-2xl mx-auto leading-relaxed">
                    Aplikasi cuaca modern dengan data real-time dari OpenWeatherMap.
                    Dibangun dengan Laravel, Vue.js, dan TailwindCSS.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <Link v-if="canRegister" :href="route('register')"
                        class="w-full sm:w-auto px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl hover:from-purple-700 hover:to-pink-700 transition-all duration-300 shadow-2xl shadow-purple-500/30 hover:shadow-purple-500/50 hover:-translate-y-1">
                        Mulai Sekarang
                        <span class="ml-2">→</span>
                    </Link>
                    <Link :href="route('login')"
                        class="w-full sm:w-auto px-8 py-4 text-lg font-semibold text-gray-300 bg-white/5 border border-white/10 rounded-2xl hover:bg-white/10 hover:text-white transition-all duration-300 backdrop-blur-sm">
                        Sudah punya akun?
                    </Link>
                </div>
            </div>

            <!-- Features Grid -->
            <div class="grid md:grid-cols-3 gap-6 mt-24 max-w-5xl w-full">
                <!-- Feature 1 -->
                <div
                    class="group p-8 bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl hover:bg-white/10 transition-all duration-300 hover:-translate-y-2">
                    <div
                        class="w-14 h-14 mb-6 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                        <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Real-time Data</h3>
                    <p class="text-gray-400 leading-relaxed">Data cuaca update setiap saat langsung dari OpenWeatherMap
                        API.</p>
                </div>

                <!-- Feature 2 -->
                <div
                    class="group p-8 bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl hover:bg-white/10 transition-all duration-300 hover:-translate-y-2">
                    <div
                        class="w-14 h-14 mb-6 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg shadow-purple-500/30">
                        <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Laravel Actions</h3>
                    <p class="text-gray-400 leading-relaxed">Dibangun dengan arsitektur Actions untuk kode yang lebih
                        bersih dan maintainable.</p>
                </div>

                <!-- Feature 3 -->
                <div
                    class="group p-8 bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl hover:bg-white/10 transition-all duration-300 hover:-translate-y-2">
                    <div
                        class="w-14 h-14 mb-6 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center shadow-lg shadow-orange-500/30">
                        <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Modern UI</h3>
                    <p class="text-gray-400 leading-relaxed">Interface modern dengan TailwindCSS, Vue 3, dan Inertia.js.
                    </p>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="relative z-10 py-8 text-center text-gray-500 text-sm">
            <p>Laravel v{{ laravelVersion }} • PHP v{{ phpVersion }}</p>
        </footer>
    </div>
</template>

<style>
@keyframes blob {

    0%,
    100% {
        transform: translate(0, 0) scale(1);
    }

    25% {
        transform: translate(20px, -30px) scale(1.1);
    }

    50% {
        transform: translate(-20px, 20px) scale(0.9);
    }

    75% {
        transform: translate(30px, 30px) scale(1.05);
    }
}

.animate-blob {
    animation: blob 8s infinite ease-in-out;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}
</style>
