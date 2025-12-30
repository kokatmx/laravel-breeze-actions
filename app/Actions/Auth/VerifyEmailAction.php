<?php

namespace App\Actions\Auth;

use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Lorisleiva\Actions\Concerns\AsAction;

class VerifyEmailAction
{
    use AsAction;

    /**
     * Handle email verification.
     */
    public function handle(EmailVerificationRequest $request): bool
    {
        if ($request->user()->hasVerifiedEmail()) {
            return false;
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
            return true;
        }

        return false;
    }

    /**
     * Execute as a controller action.
     */
    public function asController(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(
                config('app.frontend_url') . '/dashboard?verified=1'
            );
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(
            config('app.frontend_url') . '/dashboard?verified=1'
        );
    }
}
