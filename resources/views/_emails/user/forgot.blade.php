@component('mail::message')
# Forgot your password?

You are receiving this email because we received a password reset request for your account.

@component('mail::button', ['url' => route('get::auth.reset', ['token' => $token])])
Reset Password
@endcomponent

If you did not request a password reset, no further action is required.

Thanks,<br>
{{ $application->name }}
@endcomponent
