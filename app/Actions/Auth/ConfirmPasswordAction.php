<?php

namespace App\Actions\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;

class ConfirmPasswordAction
{
    use AsAction;

    public function handle(Request $request): bool
    {
        return Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ]);
    }

    public function asController(Request $request): RedirectResponse
    {
        if (! $this->handle($request)) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
