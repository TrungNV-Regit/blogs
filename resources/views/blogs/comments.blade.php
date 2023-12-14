@if (auth()->check() || $blog->comments->count())
    <div class='title d-flex justify-content-center'>
        <div>
            <div>
                <h6>{{ __('message.comment') }}</h6>
            </div>
            <div class="d-flex justify-content-center">
                <hr>
            </div>
        </div>
    </div>
@endif

<div class="comment">
    @if ($user)
        <div class="my-comment">
            <img class="author-picture" src="{{ $user->link_avatar }}" alt="{{ $user->username }}">
            <form action="" method="post">
                <input type="text">
            </form>
        </div>
    @endif

    <div class="list-comment">
        @foreach ($blog->comments as $comment)
            <div class="single-comment">
                <div class="author">
                    <img class="author-picture" src="{{ $blog->author->link_avatar }}"
                        alt={{ $comment->user->username }}>
                    <span>{{ $comment->user->username }}</span>
                </div>
                <div class="comment-detail">
                    <p class="color-comment">{{ $comment->content }}</p>
                    <p class="color-time">{{ $comment->time_elapsed }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
