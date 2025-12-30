<?php

namespace App\Actions\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class LogoutAction
{
    use AsAction;

    /**
     * Handle user logout.
     */
    public function handle(Request $request): void
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    /**
     * Execute as a controller action.
     */
    public function asController(Request $request): Response
    {
        $this->handle($request);

        return response()->noContent();
    }
}
