@include('include.sidebar.sidebar-profile-modal') {{-- Сайдбар модальное окно --}}

<aside class="chat-sidebar">
    <a href="#" class="chat-sidebar-logo">
        <img src={{ asset('img/chat-logo-sidebar.png') }} class="logo"></img>
    </a>
    <ul class="chat-sidebar-menu">
        <li class="{{ request()->routeIs('chat') ? 'active' : '' }}">
            <a href="{{ route('chat') }}" data-title="Chats"><i class="ri-chat-3-line"></i></a>
        </li>
        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" data-title="Contacts"><i class="ri-contacts-line"></i></a>
        </li>

        <li class="chat-sidebar-profile">
            <button type="button" class="chat-sidebar-profile-toggle">
                <img src={{ asset($activeUser->avatar) }} alt="">
            </button>
            <ul class="chat-sidebar-profile-dropdown">
                <li><a href="#" id="open-modal"><i class="ri-user-line"></i>Профиль</a></li>

                <li>
                    <a href={{ route('auth.logout') }}><i class="ri-logout-box-line"></i> Выйти</a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
