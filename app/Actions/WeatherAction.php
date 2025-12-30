<?php

namespace App\Actions;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Lorisleiva\Actions\Concerns\AsAction;

class WeatherAction
{
    use AsAction;

    public function handle(string $city): array
    {
        $apiKey = config('services.weatherapi.key');

        if (empty($apiKey)) {
            return [
                'error' => true,
                'message' => 'WeatherAPI key not configured.',
            ];
        }

        return Cache::remember(
            'weatherapi_' . strtolower($city),
            now()->addMinutes(10),
            function () use ($city, $apiKey) {

                $response = Http::withOptions([
                    'verify' => false, // disable ssl
                ])->get(
                    'https://api.weatherapi.com/v1/current.json',
                    [
                        'key' => $apiKey,
                        'q' => $city,
                        'lang' => 'id',
                    ]
                );

                if ($response->failed()) {
                    return [
                        'error' => true,
                        'message' => 'City not found or API error.',
                    ];
                }

                $data = $response->json();

                return [
                    'error' => false,
                    'city' => $data['location']['name'],
                    'country' => $data['location']['country'],
                    'temp' => round($data['current']['temp_c']),
                    'feels_like' => round($data['current']['feelslike_c']),
                    'humidity' => $data['current']['humidity'],
                    'description' => $data['current']['condition']['text'],
                    'icon' => $data['current']['condition']['icon'],
                    'wind' => $data['current']['wind_kph'],
                ];
            }
        );
    }

    public function asController(): InertiaResponse
    {
        $city = request('city', 'Jakarta');

        return Inertia::render('Weather', [
            'weather' => $this->handle($city),
            'searchCity' => $city,
        ]);
    }
}
