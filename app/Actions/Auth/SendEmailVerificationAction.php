<?php

namespace App\Actions\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class SendEmailVerificationAction
{
    use AsAction;

    public function handle(Request $request): bool
    {
        if ($request->user()->hasVerifiedEmail()) {
            return false;
        }

        $request->user()->sendEmailVerificationNotification();
        return true;
    }

    public function asController(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
