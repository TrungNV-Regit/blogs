<div>
    <h3>{{ __('message.content_verify_email') }}</h3>
    <h3>
        <a href="{{ route('auth.verify-email') . '?token=' . $content }}">{{ __('message.verify_email') }}</a>
    </h3>
    <p>{{ __('message.thanks') }}</p>
</div>
