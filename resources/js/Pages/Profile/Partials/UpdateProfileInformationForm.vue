<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <section>
        <header class="mb-6">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                    Informasi Profil
                </h2>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Perbarui informasi profil dan alamat email akun Anda.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="space-y-5">
            <div>
                <InputLabel for="name" value="Nama" class="text-gray-700 dark:text-gray-300 font-medium mb-2" />
                <TextInput id="name" type="text"
                    class="w-full px-4 py-3 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-purple-500 focus:ring-purple-500 transition-all"
                    v-model="form.name" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap" />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="Email" class="text-gray-700 dark:text-gray-300 font-medium mb-2" />
                <TextInput id="email" type="email"
                    class="w-full px-4 py-3 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-purple-500 focus:ring-purple-500 transition-all"
                    v-model="form.email" required autocomplete="username" placeholder="name@example.com" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null"
                class="p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl">
                <p class="text-sm text-amber-800 dark:text-amber-200">
                    Alamat email Anda belum diverifikasi.
                    <Link :href="route('verification.send')" method="post" as="button"
                        class="font-semibold text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300 underline ml-1">
                        Klik di sini untuk mengirim ulang email verifikasi.
                    </Link>
                </p>

                <div v-show="status === 'verification-link-sent'"
                    class="mt-3 p-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                    <p class="text-sm font-medium text-green-600 dark:text-green-400">
                        Link verifikasi baru telah dikirim ke alamat email Anda.
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-4 pt-2">
                <button type="submit" :disabled="form.processing"
                    class="px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-semibold rounded-xl shadow-lg shadow-purple-500/30 hover:shadow-purple-500/50 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                    <span v-if="form.processing" class="flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"
                                fill="none" />
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                        </svg>
                        Menyimpan...
                    </span>
                    <span v-else>Simpan Perubahan</span>
                </button>

                <Transition enter-active-class="transition ease-in-out duration-300"
                    enter-from-class="opacity-0 translate-y-1" leave-active-class="transition ease-in-out duration-300"
                    leave-to-class="opacity-0 translate-y-1">
                    <div v-if="form.recentlySuccessful"
                        class="flex items-center gap-2 px-4 py-2 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                        <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <p class="text-sm font-medium text-green-600 dark:text-green-400">
                            Tersimpan!
                        </p>
                    </div>
                </Transition>
            </div>
        </form>
    </section>
</template>
