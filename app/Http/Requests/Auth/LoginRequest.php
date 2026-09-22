<?php

namespace App\Http\Requests\Auth;

use App\Modules\Pengguna\Models\Pengguna;
use App\Modules\Users\Models\Users;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isPenggunaLogin()) {
            return [
                'identitas' => ['required', 'string'],
                'password' => ['required', 'string'],
            ];
        }

        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws ValidationException
     */
    public function authenticate(string $guard = 'web'): void
    {
        $this->ensureIsNotRateLimited();

        $identityField = $guard === 'pengguna' ? 'identitas' : 'email';
        $identity = $this->string($identityField)->toString();

        if ($guard === 'pengguna') {
            $users = Pengguna::query()
                ->where('nis', $identity)
                ->orWhere('nisn', $identity)
                ->orWhere('nip', $identity)
                ->get();

            if ($users->count() !== 1 || ! Hash::check($this->input('password'), $users->first()->getAuthPassword())) {
                $this->failAuthentication($identityField);
            }

            Auth::guard($guard)->login($users->first(), $this->boolean('remember'));
            RateLimiter::clear($this->throttleKey());

            return;
        }

        $user = Users::query()->where('email', $identity)->first();

        if (! $user || ! Auth::guard($guard)->attempt(['email' => $user->email, 'password' => $this->input('password')], $this->boolean('remember'))) {
            $this->failAuthentication($identityField);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            $this->isPenggunaLogin() ? 'identitas' : 'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        $field = $this->isPenggunaLogin() ? 'identitas' : 'email';

        return Str::transliterate(Str::lower($this->string($field)).'|'.$this->ip());
    }

    private function isPenggunaLogin(): bool
    {
        return $this->routeIs('user.login.store');
    }

    private function failAuthentication(string $identityField): never
    {
        RateLimiter::hit($this->throttleKey());

        throw ValidationException::withMessages([
            $identityField => trans('auth.failed'),
        ]);
    }
}
