<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>

    <Head title="Login" />

    <div class="min-h-screen flex">
        <!-- Left Side - Form -->
        <div class="flex-1 flex items-center justify-center px-6 py-12 lg:px-8 bg-white dark:bg-gray-900">
            <div class="w-full max-w-md">
                <!-- Logo -->
                <div class="flex items-center gap-3 mb-8">
                    <Link href="/" class="flex items-center gap-3">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-purple-600 to-pink-600 rounded-2xl flex items-center justify-center shadow-lg shadow-purple-500/30">
                            <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">WeatherApp</span>
                    </Link>
                </div>

                <!-- Welcome Text -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Selamat Datang Kembali! 👋</h1>
                    <p class="text-gray-500 dark:text-gray-400">Masuk ke akun untuk melanjutkan</p>
                </div>

                <!-- Status Message -->
                <div v-if="status"
                    class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl">
                    <p class="text-sm font-medium text-green-600 dark:text-green-400">{{ status }}</p>
                </div>

                <form @submit.prevent="submit" class="space-y-6">
                    <!-- Email -->
                    <div>
                        <InputLabel for="email" value="Email"
                            class="text-gray-700 dark:text-gray-300 font-medium mb-2" />
                        <TextInput id="email" type="email"
                            class="w-full px-4 py-3 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-purple-500 focus:ring-purple-500 transition-all"
                            v-model="form.email" required autofocus autocomplete="username"
                            placeholder="name@example.com" />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <InputLabel for="password" value="Password"
                                class="text-gray-700 dark:text-gray-300 font-medium" />
                            <Link v-if="canResetPassword" :href="route('password.request')"
                                class="text-sm text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300 font-medium">
                                Lupa Password?
                            </Link>
                        </div>
                        <TextInput id="password" type="password"
                            class="w-full px-4 py-3 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:border-purple-500 focus:ring-purple-500 transition-all"
                            v-model="form.password" required autocomplete="current-password" placeholder="••••••••" />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <Checkbox name="remember" v-model:checked="form.remember"
                            class="rounded-md border-gray-300 dark:border-gray-600 text-purple-600 focus:ring-purple-500" />
                        <span class="ms-3 text-sm text-gray-600 dark:text-gray-400">Ingat saya</span>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" :disabled="form.processing"
                        class="w-full py-3.5 px-6 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-semibold rounded-xl shadow-lg shadow-purple-500/30 hover:shadow-purple-500/50 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span v-if="form.processing" class="flex items-center justify-center gap-2">
                            <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"
                                    fill="none" />
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                            </svg>
                            Memproses...
                        </span>
                        <span v-else>Masuk</span>
                    </button>
                </form>

                <!-- Register Link -->
                <p class="mt-8 text-center text-gray-500 dark:text-gray-400">
                    Belum punya akun?
                    <Link :href="route('register')"
                        class="text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300 font-semibold">
                        Daftar sekarang
                    </Link>
                </p>
            </div>
        </div>

        <!-- Right Side - Decorative -->
        <div
            class="hidden lg:flex flex-1 bg-gradient-to-br from-purple-600 via-pink-600 to-purple-800 relative overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute inset-0">
                <div class="absolute top-20 left-20 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-20 right-20 w-96 h-96 bg-pink-500/20 rounded-full blur-3xl"></div>
                <div
                    class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-white/5 rounded-full">
                </div>
            </div>

            <!-- Content -->
            <div class="relative z-10 flex flex-col justify-center items-center text-center px-12">
                <div
                    class="w-24 h-24 bg-white/20 backdrop-blur-xl rounded-3xl flex items-center justify-center mb-8 shadow-2xl">
                    <svg class="w-12 h-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                    </svg>
                </div>
                <h2 class="text-4xl font-bold text-white mb-4">Cek Cuaca Dimana Saja</h2>
                <p class="text-xl text-white/80 max-w-md leading-relaxed">
                    Dapatkan informasi cuaca real-time untuk kota manapun di dunia dengan satu klik.
                </p>
            </div>
        </div>
    </div>
</template>
