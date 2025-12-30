<?php

namespace App\Actions\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Lorisleiva\Actions\Concerns\AsAction;

class LoginAction
{
    use AsAction;

    public function handle(LoginRequest $request): void
    {
        $request->authenticate();
        $request->session()->regenerate();
    }

    public function asController(LoginRequest $request): RedirectResponse
    {
        $this->handle($request);

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
