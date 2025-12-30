<?php

namespace App\Actions\Auth;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Lorisleiva\Actions\Concerns\AsAction;

class NewPasswordAction
{
    use AsAction;

    /**
     * Get the validation rules.
     */
    public function rules(): array
    {
        return [
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    /**
     * Handle password reset.
     */
    public function handle(array $credentials): string
    {
        return Password::reset(
            $credentials,
            function ($user) use ($credentials) {
                $user->forceFill([
                    'password' => Hash::make($credentials['password']),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );
    }

    /**
     * Execute as a controller action.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function asController(Request $request): JsonResponse
    {
        $validated = $request->validate($this->rules());
        $status = $this->handle($validated);

        if ($status != Password::PASSWORD_RESET) {
            throw ValidationException::withMessages([
                'email' => [__($status)],
            ]);
        }

        return response()->json(['status' => __($status)]);
    }
}
