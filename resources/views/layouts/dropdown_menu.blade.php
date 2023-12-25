@php
    use App\Models\User;
    use App\Models\Blog;
@endphp

<ul class="dropdown-menu">
    <li class="dropdown-moblie">
        <a class="dropdown-item" href="{{ route('blog.top') }}">
            {{ __('message.top_blog') }}
        </a>
    </li>
    <li class="dropdown-moblie">
        <hr class="dropdown-divider">
    </li>
    @if (Auth::user()->role == User::ROLE_USER)
        <li class="dropdown-moblie">
            <a class="dropdown-item" href="{{ route('user.blog.create') }}">
                {{ __('message.create') }}
            </a>
        </li>
        <li class="dropdown-moblie">
            <hr class="dropdown-divider">
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('user.blog.my-blogs') }}">
                {{ __('message.my_blog') }}
            </a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('user.profile.show') }}">
                {{ __('message.profile') }}
            </a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('user.change-password') }}">
                {{ __('message.change_password') }}
            </a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
    @else
        <li>
            <a class="dropdown-item" href="{{ route('admin.blog.index', ['status' => Blog::STATUS_PENDING]) }}">
                {{ __('message.blog_management') }}
            </a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('admin.user.index') }}">
                {{ __('message.user_management') }}
            </a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('admin.category.index') }}">
                {{ __('message.category_management') }}
            </a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('admin.change-password') }}">
                {{ __('message.change_password') }}
            </a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
    @endif
    <li>
        <a class="dropdown-item" onclick="document.getElementById('logoutForm').submit();">
            {{ __('message.logout') }}
        </a>
        <form id="logoutForm" action="{{ route('auth.logout') }}" method="POST">
            @csrf
            @method('POST')
        </form>
    </li>
</ul>
