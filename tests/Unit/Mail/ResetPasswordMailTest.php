<?php

namespace Tests\Unit\Mail;

use App\Mail\ResetPasswordMail;
use Tests\TestCase;

class ResetPasswordMailTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testBuild()
    {
        $token = 'test-token';
        $resetPasswordUrl = 'https://example.com/reset-password/test-token';

        $mail = new ResetPasswordMail($token, $resetPasswordUrl);
        $mailBuild = $mail->build();

        $this->assertEquals('Reset Password Notification', $mailBuild->subject);
        $this->assertEquals('emails.reset_password', $mailBuild->view);

        $viewData = $mailBuild->buildViewData();

        $this->assertArrayHasKey('token', $viewData);
        $this->assertArrayHasKey('resetPasswordUrl', $viewData);
        $this->assertEquals($token, $viewData['token']);
        $this->assertEquals($resetPasswordUrl, $viewData['resetPasswordUrl']);
    }
}
