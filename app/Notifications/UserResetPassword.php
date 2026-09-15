<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;

class UserResetPassword extends ResetPassword
{
    protected function resetUrl($notifiable): string
    {
        return url(route('user.password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));
    }
}
