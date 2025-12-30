# Laravel Breeze with Actions

A fresh Laravel installation with Breeze authentication, where all controllers have been replaced with [Laravel Actions](https://laravelactions.com/) by Loris Leiva.

## 📋 Project Overview

This project demonstrates how to replace traditional Laravel controllers with Action classes using the `lorisleiva/laravel-actions` package. Actions provide a cleaner, more reusable, and testable approach to organizing your application logic.

## 🛠️ Tech Stack

| Package         | Version   |
| --------------- | --------- |
| PHP             | ^8.2      |
| Laravel         | 12.x      |
| Laravel Breeze  | API Stack |
| Laravel Actions | ^2.9      |

## 📦 Installation

```bash
# Clone the repository
git clone https://github.com/kokatmx/laravel-breeze-actions.git
cd laravel-breeze-actions

# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Run tests
php artisan test
```

## 🏗️ Project Structure

```
app/
├── Actions/
│   └── Auth/
│       ├── EmailVerificationNotificationAction.php
│       ├── LoginAction.php
│       ├── LogoutAction.php
│       ├── NewPasswordAction.php
│       ├── PasswordResetLinkAction.php
│       ├── RegisterAction.php
│       └── VerifyEmailAction.php
├── Http/
│   └── Requests/
│       └── Auth/
│           └── LoginRequest.php
└── Models/
    └── User.php
```

## 🔐 Authentication Endpoints

| Method | Endpoint                           | Action                                | Description               |
| ------ | ---------------------------------- | ------------------------------------- | ------------------------- |
| POST   | `/register`                        | `RegisterAction`                      | Register a new user       |
| POST   | `/login`                           | `LoginAction`                         | Authenticate user         |
| POST   | `/logout`                          | `LogoutAction`                        | Logout user               |
| POST   | `/forgot-password`                 | `PasswordResetLinkAction`             | Send password reset link  |
| POST   | `/reset-password`                  | `NewPasswordAction`                   | Reset password with token |
| GET    | `/verify-email/{id}/{hash}`        | `VerifyEmailAction`                   | Verify email address      |
| POST   | `/email/verification-notification` | `EmailVerificationNotificationAction` | Resend verification email |

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

namespace App\Actions\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Response;
use Lorisleiva\Actions\Concerns\AsAction;

class LoginAction
{
    use AsAction;

    public function handle(LoginRequest $request): void
    {
        $request->authenticate();
        $request->session()->regenerate();
    }

    public function asController(LoginRequest $request): Response
    {
        $this->handle($request);
        return response()->noContent();
    }
}
```

### Using Actions in Routes

```php
use App\Actions\Auth\LoginAction;

Route::post('/login', LoginAction::class)->name('login');
```

## 🔄 Controller to Action Mapping

| Original Controller                              | Action Class                          |
| ------------------------------------------------ | ------------------------------------- |
| `AuthenticatedSessionController::store`          | `LoginAction`                         |
| `AuthenticatedSessionController::destroy`        | `LogoutAction`                        |
| `RegisteredUserController::store`                | `RegisterAction`                      |
| `PasswordResetLinkController::store`             | `PasswordResetLinkAction`             |
| `NewPasswordController::store`                   | `NewPasswordAction`                   |
| `VerifyEmailController::__invoke`                | `VerifyEmailAction`                   |
| `EmailVerificationNotificationController::store` | `EmailVerificationNotificationAction` |

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
-   [Laravel Actions GitHub](https://github.com/lorisleiva/laravel-actions)

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
