<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    weather: Object,
    searchCity: String,
});

const city = ref(props.searchCity || 'Jakarta');
const isLoading = ref(false);

const searchWeather = () => {
    isLoading.value = true;
    router.get('/weather', { city: city.value }, {
        preserveState: true,
        onFinish: () => {
            isLoading.value = false;
        },
    });
};

// WeatherAPI returns icon URL like "//cdn.weatherapi.com/weather/64x64/day/116.png"
const getWeatherIcon = (icon) => {
    if (!icon) return '';
    // Add https: if URL starts with //
    if (icon.startsWith('//')) {
        return 'https:' + icon;
    }
    return icon;
};

const getBackgroundClass = () => {
    if (!props.weather || props.weather.error) {
        return 'from-gray-700 via-gray-800 to-gray-900';
    }
    const temp = props.weather.temp;
    if (temp >= 30) return 'from-orange-500 via-red-500 to-pink-600';
    if (temp >= 20) return 'from-yellow-400 via-orange-400 to-red-400';
    if (temp >= 10) return 'from-green-400 via-teal-500 to-blue-500';
    return 'from-blue-400 via-blue-600 to-indigo-700';
};
</script>

<template>

    <Head title="Weather" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center gap-3">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/20">
                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                        Weather Forecast
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Pantau kondisi cuaca real-time di berbagai
                        belahan dunia</p>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
                <!-- Search Box -->
                <div class="mb-8">
                    <div class="flex gap-3">
                        <input v-model="city" type="text" placeholder="Enter city name..."
                            class="flex-1 rounded-xl border-0 bg-white dark:bg-gray-800 px-6 py-4 text-lg text-gray-900 dark:text-white placeholder-gray-400 shadow-lg focus:ring-2 focus:ring-blue-400"
                            @keyup.enter="searchWeather" />
                        <button @click="searchWeather" :disabled="isLoading"
                            class="rounded-xl bg-gradient-to-r from-blue-500 to-purple-600 px-8 py-4 font-semibold text-white shadow-lg transition-all duration-300 hover:from-blue-600 hover:to-purple-700 hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed">
                            <span v-if="isLoading" class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4" fill="none" />
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                                </svg>
                                Loading...
                            </span>
                            <span v-else>Search</span>
                        </button>
                    </div>
                </div>

                <!-- Weather Card -->
                <div class="overflow-hidden rounded-3xl shadow-2xl"
                    :class="[`bg-gradient-to-br ${getBackgroundClass()}`]">
                    <!-- Error State -->
                    <div v-if="weather?.error" class="p-12 text-center text-white">
                        <svg class="mx-auto h-20 w-20 mb-4 opacity-50" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-2xl font-medium">{{ weather.message || 'City not found' }}</p>
                        <p class="mt-2 text-white/70">Please try another city name</p>
                    </div>

                    <!-- Weather Data -->
                    <div v-else-if="weather" class="p-8 text-white">
                        <!-- Location -->
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-3xl font-bold">{{ weather.city }}</h3>
                                <p class="text-lg text-white/80">{{ weather.country }}</p>
                            </div>
                            <div class="text-right text-sm text-white/70">
                                <p>{{ new Date().toLocaleDateString('id-ID', { weekday: 'long' }) }}</p>
                                <p>{{ new Date().toLocaleDateString('id-ID', { month: 'long', day: 'numeric' }) }}</p>
                            </div>
                        </div>

                        <!-- Main Weather Display -->
                        <div class="flex items-center justify-center gap-8 py-8">
                            <img :src="getWeatherIcon(weather.icon)" :alt="weather.description"
                                class="h-32 w-32 drop-shadow-2xl" />
                            <div class="text-center">
                                <p class="text-8xl font-thin tracking-tighter">{{ weather.temp }}°C</p>
                                <p class="mt-2 text-xl capitalize text-white/90">{{ weather.description }}</p>
                            </div>
                        </div>

                        <!-- Weather Details -->
                        <div class="mt-8 grid grid-cols-3 gap-4 rounded-2xl bg-white/10 backdrop-blur-sm p-6">
                            <div class="text-center">
                                <div class="flex items-center justify-center gap-2 text-white/70 mb-2">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                    </svg>
                                    <span class="text-sm">Feels Like</span>
                                </div>
                                <p class="text-2xl font-semibold">{{ weather.feels_like }}°C</p>
                            </div>
                            <div class="text-center border-x border-white/20">
                                <div class="flex items-center justify-center gap-2 text-white/70 mb-2">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                    </svg>
                                    <span class="text-sm">Humidity</span>
                                </div>
                                <p class="text-2xl font-semibold">{{ weather.humidity }}%</p>
                            </div>
                            <div class="text-center">
                                <div class="flex items-center justify-center gap-2 text-white/70 mb-2">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                    <span class="text-sm">Wind</span>
                                </div>
                                <p class="text-2xl font-semibold">{{ weather.wind }} km/h</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Info -->
                <p class="mt-6 text-center text-sm text-gray-500 dark:text-gray-400">
                    Powered by WeatherAPI
                </p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
