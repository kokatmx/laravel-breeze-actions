<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;
</script>

<template>

    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-3">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-purple-600 to-pink-600 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/20">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                        Pengaturan Profil
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Kelola informasi akun Anda</p>
                </div>
            </div>
        </template>

        <div class="py-8">
            <div class="mx-auto max-w-4xl space-y-6 px-4 sm:px-6 lg:px-8">
                <!-- Profile Card -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <!-- Header with Avatar -->
                    <div
                        class="bg-gradient-to-r from-purple-600 via-pink-600 to-purple-800 px-6 py-8 relative overflow-hidden">
                        <!-- Decorative Elements -->
                        <div class="absolute inset-0">
                            <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                            <div class="absolute bottom-0 left-0 w-32 h-32 bg-pink-500/20 rounded-full blur-2xl"></div>
                        </div>

                        <div class="relative z-10 flex items-center gap-5">
                            <div
                                class="w-20 h-20 bg-white/20 backdrop-blur-xl rounded-2xl flex items-center justify-center shadow-xl">
                                <span class="text-3xl font-bold text-white">{{ user.name.charAt(0).toUpperCase()
                                }}</span>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white">{{ user.name }}</h3>
                                <p class="text-white/80">{{ user.email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Form -->
                    <div class="p-6">
                        <UpdateProfileInformationForm :must-verify-email="mustVerifyEmail" :status="status" />
                    </div>
                </div>

                <!-- Password Card -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-6">
                        <UpdatePasswordForm />
                    </div>
                </div>

                <!-- Delete Account Card -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl shadow-gray-200/50 dark:shadow-none border border-red-100 dark:border-red-900/30 overflow-hidden">
                    <div class="p-6">
                        <DeleteUserForm />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
