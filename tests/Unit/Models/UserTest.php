<?php

namespace Tests\Unit\Models;

use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testSendPasswordResetNotification()
    {
        Mail::fake();

        $user = new User();
        $user->email = 'test@example.com';

        $token = 'test-token';

        $user->sendPasswordResetNotification($token);

        Mail::assertSent(ResetPasswordMail::class, function ($mail) use ($token, $user) {
            return $mail->hasTo($user->email) &&
                $mail->token === $token &&
                $mail->resetPasswordUrl === url('/password/reset/'.$token);
        });
    }
}
