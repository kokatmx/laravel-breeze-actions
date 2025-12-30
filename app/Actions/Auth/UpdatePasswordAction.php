<?php

namespace App\Actions\Auth;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdatePasswordAction
{
    use AsAction;

    public function rules(): array
    {
        return [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ];
    }

    public function handle(Request $request, array $validated): void
    {
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);
    }

    public function asController(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules());
        $this->handle($request, $validated);

        return back();
    }
}
