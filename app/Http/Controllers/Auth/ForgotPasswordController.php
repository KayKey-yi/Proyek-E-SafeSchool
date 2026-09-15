<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\UserResetPassword;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm(): View
    {
        return view('user.auth.forgot-password');
    }

    /** @throws ValidationException */
    public function sendResetLinkEmail(Request $request): RedirectResponse
    {
        $request->validate(['email' => ['required', 'email']]);

        $broker = Password::broker();
        $user = $broker->getUser($request->only('email'));

        if (! $user) {
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => __(Password::INVALID_USER)]);
        }

        $user->notify(new UserResetPassword($broker->createToken($user)));
        $status = Password::RESET_LINK_SENT;

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
    }

    public function showResetForm(Request $request, string $token): View
    {
        return view('user.auth.reset-password', compact('request', 'token'));
    }

    /** @throws ValidationException */
    public function reset(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user) use ($request): void {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('user.login')->with('status', __($status))
            : back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
    }
}