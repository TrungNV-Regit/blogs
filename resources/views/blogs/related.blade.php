@if ($blog->randomRelatedBlog->count() > 0)
    <div class='related-blog'>
        <div class='title d-flex justify-content-center'>
            <div>
                <div>
                    <h6>{{ __('message.related') }}</h6>
                </div>
                <div class="d-flex justify-content-center">
                    <hr>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($blog->randomRelatedBlog as $relatedBlog)
                <div class='d-lg-block d-md-none d-sm-none col-lg-3'>
                    <a href="{{ route('blog.show', ['id' => $relatedBlog->id]) }}">
                        <div class="blog">
                            @if ($relatedBlog->link_image)
                                <img src={{ $relatedBlog->link_image }} class="card-img-top"
                                    alt="{{ $relatedBlog->title }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title single-line">{{ $relatedBlog->title }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endif
