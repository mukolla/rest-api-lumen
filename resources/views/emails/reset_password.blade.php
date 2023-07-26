<!DOCTYPE html>
<html>
<head>
    <title>Reset Password Notification</title>
</head>
<body>
<h1>Reset Password Notification</h1>

@if(isset($token))
    <p>Password reset token: <b>{{ $token }}</b></p>
@endif

<p>You are receiving this email because we received a password reset request for your account.</p>
<p>{{ __('passwords.reset_link') }} <a href="{{ $resetPasswordUrl }}">{{ $resetPasswordUrl }}</a></p>
<p>{{ __('passwords.reset_expiration', ['count' => config('auth.passwords.users.expire')]) }}</p>

<p>If you did not request a password reset, no further action is required.</p>
</body>
</html>
