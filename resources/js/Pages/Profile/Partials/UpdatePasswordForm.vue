<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section>
        <header class="mb-6">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">
                    Ubah Password
                </h2>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Pastikan akun Anda menggunakan password yang panjang dan acak untuk tetap aman.
            </p>
        </header>

        <form @submit.prevent="updatePassword" class="space-y-5">
            <div>
                <InputLabel for="current_password" value="Password Saat Ini"
                    class="text-gray-700 dark:text-gray-300 font-medium mb-2" />
                <TextInput id="current_password" ref="currentPasswordInput" v-model="form.current_password"
                    type="password"
                    class="w-full px-4 py-3 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-purple-500 focus:ring-purple-500 transition-all"
                    autocomplete="current-password" placeholder="••••••••" />
                <InputError :message="form.errors.current_password" class="mt-2" />
            </div>

            <div>
                <InputLabel for="password" value="Password Baru"
                    class="text-gray-700 dark:text-gray-300 font-medium mb-2" />
                <TextInput id="password" ref="passwordInput" v-model="form.password" type="password"
                    class="w-full px-4 py-3 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-purple-500 focus:ring-purple-500 transition-all"
                    autocomplete="new-password" placeholder="••••••••" />
                <InputError :message="form.errors.password" class="mt-2" />
            </div>

            <div>
                <InputLabel for="password_confirmation" value="Konfirmasi Password"
                    class="text-gray-700 dark:text-gray-300 font-medium mb-2" />
                <TextInput id="password_confirmation" v-model="form.password_confirmation" type="password"
                    class="w-full px-4 py-3 rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:border-purple-500 focus:ring-purple-500 transition-all"
                    autocomplete="new-password" placeholder="••••••••" />
                <InputError :message="form.errors.password_confirmation" class="mt-2" />
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
                    <span v-else>Ubah Password</span>
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
