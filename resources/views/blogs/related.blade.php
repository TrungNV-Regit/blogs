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

        <div class="row related-blog-list">
            @foreach ($blog->randomRelatedBlog as $relatedBlog)
                <div class=' col-lg-3 col-md-3'>
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

        <div class="slideshow-container d-lg-none d-md-none d-sm-block d-xs-block">

            @foreach ($blog->randomRelatedBlog as $relatedBlog)
                <div class='slide fade'>
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

            <div class="d-flex justify-content-center">
                @for ($i = 1; $i <= count($blog->randomRelatedBlog); $i++)
                    <span class="dot" onclick="currentSlide({{ $i }})"></span>
                @endfor
            </div>

        </div>
    </div>
@endif
