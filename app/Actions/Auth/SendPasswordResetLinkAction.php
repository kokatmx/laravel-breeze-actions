<?php

namespace App\Actions\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;

class SendPasswordResetLinkAction
{
    use AsAction;

    public function rules(): array
    {
        return [
            'email' => 'required|email',
        ];
    }

    public function handle(string $email): string
    {
        return Password::sendResetLink(['email' => $email]);
    }

    public function asController(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules());
        $status = $this->handle($validated['email']);

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
