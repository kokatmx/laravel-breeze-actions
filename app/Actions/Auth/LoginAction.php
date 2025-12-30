<?php

namespace App\Actions\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Response;
use Lorisleiva\Actions\Concerns\AsAction;

class LoginAction
{
    use AsAction;

    /**
     * Handle user authentication.
     */
    public function handle(LoginRequest $request): void
    {
        $request->authenticate();
        $request->session()->regenerate();
    }

    /**
     * Execute as a controller action.
     */
    public function asController(LoginRequest $request): Response
    {
        $this->handle($request);

        return response()->noContent();
    }
}
