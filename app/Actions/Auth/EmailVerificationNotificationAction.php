<?php

namespace App\Actions\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class EmailVerificationNotificationAction
{
    use AsAction;

    /**
     * Handle sending email verification notification.
     */
    public function handle(Request $request): bool
    {
        if ($request->user()->hasVerifiedEmail()) {
            return false;
        }

        $request->user()->sendEmailVerificationNotification();
        return true;
    }

    /**
     * Execute as a controller action.
     */
    public function asController(Request $request): JsonResponse|RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended('/dashboard');
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json(['status' => 'verification-link-sent']);
    }
}
