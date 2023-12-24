<div class="content-sidebar">
    <div class="content-sidebar-title">Чаты</div>
    <form action="" class="content-sidebar-form">
        <input type="search" class="content-sidebar-input" placeholder="Найти...">
        <button type="submit" class="content-sidebar-submit"><i class="ri-search-line"></i></button>
    </form>
    <div class="content-messages">
        <ul class="content-messages-list">
            <li class="content-message-title"><span>Недавнее</span></li>


            @foreach ($allAcceptedContacts as $contact)
            <li data-login = "{{ $contact->friend->login }}" id = "friend-list-element-{{ $contact->friend->login }}">
                <a href="{{ route('chat', ['activeContactId' => $contact->id]) }}" class="load-messages" data-contact-id="{{ $contact->id }}">
                    <img class="content-message-image" src={{ asset($contact->friend->avatar) }} alt="">
                    <span class="content-message-info">
                        <span class="content-message-name">{{ $contact->friend->login }}</span>
                        <span class="content-message-text">
                            {{ $contact->lastMessage ? $contact->lastMessage->content : 'Нет сообщения' }}
                        </span>
                        <span class="content-message-more">
                        {{-- <span class="content-message-unread">3</span> --}}
                        <span class="content-message-time"> {{ $contact->lastMessage ? $contact->lastMessage->created_at : '' }}</span>
                    </span>
                </a>
            </li>
            @endforeach

        </ul>
    </div>
</div>
