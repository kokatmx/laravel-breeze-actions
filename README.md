# Laravel Breeze Weather App with Actions

A Laravel Breeze (Vue + Inertia.js) application featuring a weather app, where all controllers have been replaced with [Laravel Actions](https://laravelactions.com/) by Loris Leiva.

## 🌤️ Features

-   **Weather App** - Real-time weather data from WeatherAPI
-   **Premium UI** - Modern design with TailwindCSS, gradients, and glassmorphism effects
-   **Laravel Actions** - All controllers replaced with Action classes
-   **Authentication** - Full Breeze authentication with Vue.js

## 📸 Screenshots

| Welcome Page                                | Dashboard                         | Weather App                                |
| ------------------------------------------- | --------------------------------- | ------------------------------------------ |
| Modern landing page with animated gradients | User dashboard with quick actions | Real-time weather with dynamic backgrounds |

## 🛠️ Tech Stack

| Technology      | Version   |
| --------------- | --------- |
| PHP             | ^8.2      |
| Laravel         | 12.x      |
| Laravel Breeze  | Vue Stack |
| Laravel Actions | ^2.9      |
| Vue.js          | 3.x       |
| Inertia.js      | 2.x       |
| TailwindCSS     | 3.x       |
| WeatherAPI      | v1        |

## 📦 Installation

```bash
# Clone the repository
git clone https://github.com/kokatmx/laravel-breeze-actions.git
cd laravel-breeze-actions

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Add your WeatherAPI key to .env
# Get free API key at https://www.weatherapi.com/
WEATHERAPI_API_KEY=your_api_key_here

# Build assets
npm run build

# Or run in development mode
npm run dev

# Start the server
php artisan serve
```

## 🏗️ Project Structure

```
app/
├── Actions/
│   ├── Auth/
│   │   ├── ConfirmPasswordAction.php
│   │   ├── EmailVerificationPromptAction.php
│   │   ├── LoginAction.php
│   │   ├── LogoutAction.php
│   │   ├── NewPasswordAction.php
│   │   ├── PasswordResetLinkAction.php
│   │   ├── RegisterAction.php
│   │   ├── ResetPasswordAction.php
│   │   ├── SendEmailVerificationAction.php
│   │   ├── SendPasswordResetLinkAction.php
│   │   ├── ShowConfirmPasswordAction.php
│   │   ├── ShowForgotPasswordAction.php
│   │   ├── ShowLoginAction.php
│   │   ├── ShowRegisterAction.php
│   │   ├── ShowResetPasswordAction.php
│   │   ├── UpdatePasswordAction.php
│   │   └── VerifyEmailAction.php
│   └── WeatherAction.php
└── ...

resources/js/
├── Components/
├── Layouts/
│   ├── AuthenticatedLayout.vue
│   └── GuestLayout.vue
└── Pages/
    ├── Auth/
    │   ├── Login.vue
    │   ├── Register.vue
    │   └── ...
    ├── Dashboard.vue
    ├── Weather.vue
    └── Welcome.vue
```

## 🔐 Authentication Endpoints

| Method | Endpoint                           | Action                          | Description                |
| ------ | ---------------------------------- | ------------------------------- | -------------------------- |
| GET    | `/login`                           | `ShowLoginAction`               | Show login form            |
| POST   | `/login`                           | `LoginAction`                   | Authenticate user          |
| POST   | `/logout`                          | `LogoutAction`                  | Logout user                |
| GET    | `/register`                        | `ShowRegisterAction`            | Show registration form     |
| POST   | `/register`                        | `RegisterAction`                | Register new user          |
| GET    | `/forgot-password`                 | `ShowForgotPasswordAction`      | Show forgot password form  |
| POST   | `/forgot-password`                 | `SendPasswordResetLinkAction`   | Send password reset link   |
| GET    | `/reset-password/{token}`          | `ShowResetPasswordAction`       | Show reset password form   |
| POST   | `/reset-password`                  | `ResetPasswordAction`           | Reset password             |
| GET    | `/verify-email`                    | `EmailVerificationPromptAction` | Email verification prompt  |
| GET    | `/verify-email/{id}/{hash}`        | `VerifyEmailAction`             | Verify email address       |
| POST   | `/email/verification-notification` | `SendEmailVerificationAction`   | Resend verification email  |
| GET    | `/confirm-password`                | `ShowConfirmPasswordAction`     | Show password confirmation |
| POST   | `/confirm-password`                | `ConfirmPasswordAction`         | Confirm password           |
| PUT    | `/password`                        | `UpdatePasswordAction`          | Update password            |

## 🌤️ Weather Endpoint

| Method | Endpoint                | Action          | Description                 |
| ------ | ----------------------- | --------------- | --------------------------- |
| GET    | `/weather`              | `WeatherAction` | Show weather for a city     |
| GET    | `/weather?city=Jakarta` | `WeatherAction` | Search weather by city name |

## 📝 What are Laravel Actions?

Laravel Actions is a package that allows you to organize your application logic into classes called "Actions". Each Action class can be used as:

-   ✅ **Controller** - Handle HTTP requests
-   ✅ **Job** - Queue background tasks
-   ✅ **Listener** - Handle events
-   ✅ **Command** - CLI commands
-   ✅ **Plain PHP Class** - Call from anywhere

### Example Action

```php
<?php

namespace App\Actions;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Lorisleiva\Actions\Concerns\AsAction;

class WeatherAction
{
    use AsAction;

    public function handle(string $city): array
    {
        $apiKey = config('services.weatherapi.key');

        return Cache::remember(
            'weatherapi_' . strtolower($city),
            now()->addMinutes(10),
            function () use ($city, $apiKey) {
                $response = Http::withOptions(['verify' => false])
                    ->get('https://api.weatherapi.com/v1/current.json', [
                        'key' => $apiKey,
                        'q' => $city,
                        'lang' => 'id',
                    ]);

                if ($response->failed()) {
                    return ['error' => true, 'message' => 'City not found'];
                }

                $data = $response->json();

                return [
                    'error' => false,
                    'city' => $data['location']['name'],
                    'temp' => round($data['current']['temp_c']),
                    // ...
                ];
            }
        );
    }

    public function asController()
    {
        $city = request('city', 'Jakarta');

        return Inertia::render('Weather', [
            'weather' => $this->handle($city),
            'searchCity' => $city,
        ]);
    }
}
```

### Using Actions in Routes

```php
use App\Actions\WeatherAction;

Route::get('/weather', WeatherAction::class)->name('weather');
```

## 🎨 UI Features

-   **Animated Gradients** - Dynamic background animations
-   **Glassmorphism** - Frosted glass effects
-   **Dark Mode Ready** - Full dark mode support
-   **Responsive Design** - Mobile-first approach
-   **Dynamic Weather Cards** - Background changes based on temperature

## 🔧 Configuration

Add to your `.env` file:

```env
# WeatherAPI Configuration
WEATHERAPI_API_KEY=your_api_key_here
```

Get your free API key at [weatherapi.com](https://www.weatherapi.com/)

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage
```

## 📚 Resources

-   [Laravel Documentation](https://laravel.com/docs)
-   [Laravel Breeze Documentation](https://laravel.com/docs/starter-kits#laravel-breeze)
-   [Laravel Actions Documentation](https://laravelactions.com/)
-   [Vue.js Documentation](https://vuejs.org/)
-   [Inertia.js Documentation](https://inertiajs.com/)
-   [TailwindCSS Documentation](https://tailwindcss.com/)
-   [WeatherAPI Documentation](https://www.weatherapi.com/docs/)

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
