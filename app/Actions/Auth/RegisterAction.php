<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Lorisleiva\Actions\Concerns\AsAction;

class RegisterAction
{
    use AsAction;

    /**
     * Get the validation rules.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    /**
     * Handle user registration.
     */
    public function handle(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        event(new Registered($user));

        return $user;
    }

    /**
     * Execute as a controller action.
     */
    public function asController(Request $request): Response
    {
        $validated = $request->validate($this->rules());
        $user = $this->handle($validated);

        Auth::login($user);

        return response()->noContent();
    }
}
