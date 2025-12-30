<?php

namespace App\Actions\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;

class PasswordResetLinkAction
{
    use AsAction;

    /**
     * Get the validation rules.
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
        ];
    }

    /**
     * Handle sending password reset link.
     */
    public function handle(string $email): string
    {
        return Password::sendResetLink(['email' => $email]);
    }

    /**
     * Execute as a controller action.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function asController(Request $request): JsonResponse
    {
        $validated = $request->validate($this->rules());
        $status = $this->handle($validated['email']);

        if ($status != Password::RESET_LINK_SENT) {
            throw ValidationException::withMessages([
                'email' => [__($status)],
            ]);
        }

        return response()->json(['status' => __($status)]);
    }
}
