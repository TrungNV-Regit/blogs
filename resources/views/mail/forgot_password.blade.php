<div>
    <h3>{{ __('message.email_forgot_password_line_1') }}</h3>
    <h3>{{ __('message.email_forgot_password_line_2') }}</h3>
    <h3>{{ __('message.new_password') }}: {{ $content }}</h3>
    <h3>
        <a href="{{ route('auth.sign-in') }}">{{ __('message.login') }}</a>
    </h3>
    <p>{{ __('message.thanks') }}</p>
</div>
