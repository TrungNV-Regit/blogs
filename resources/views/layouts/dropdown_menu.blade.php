@php
use App\Models\User;
@endphp

<ul class="dropdown-menu">
    @if (Auth::user()->role == User::ROLE_USER)
    <li><a class="dropdown-item" href="{{route('blog.my')}}">{{__('message.my_blog')}}</a></li>
    <li>
        <hr class="dropdown-divider">
    </li>
    <li><a class="dropdown-item" href="">{{__('message.profile')}}</a></li>
    <li>
        <hr class="dropdown-divider">
    </li>
    <li><a class="dropdown-item" href="">{{__('message.reset_password')}}</a></li>
    <li>
        <hr class="dropdown-divider">
    </li>
    @else
    <li><a class="dropdown-item" href="">{{__('message.blog_management')}}</a></li>
    <li>
        <hr class="dropdown-divider">
    </li>
    <li><a class="dropdown-item" href="">{{__('message.user_management')}}</a></li>
    <li>
        <hr class="dropdown-divider">
    </li>
    @endif
    <li>
        <a class="dropdown-item" onclick="document.getElementById('logout-form').submit();">
            {{ __('message.logout') }}
        </a>
        <form id="logout-form" action="{{ route('auth.logout') }}" method="POST">
            @csrf
            @method('POST')
        </form>
    </li>
</ul>
