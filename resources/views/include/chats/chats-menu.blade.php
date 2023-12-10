<div class="content-sidebar">
    <div class="content-sidebar-title">Chats</div>
    <form action="" class="content-sidebar-form">
        <input type="search" class="content-sidebar-input" placeholder="Search...">
        <button type="submit" class="content-sidebar-submit"><i class="ri-search-line"></i></button>
    </form>
    <div class="content-messages">
        <ul class="content-messages-list">
            <li class="content-message-title"><span>Недавнее</span></li>


            @if ($allAcceptedContacts->count() == 0)
                <li>
                    <a href="#" data-conversation="#conversation-1">
                        <img class="content-message-image" src="assets/img/boy.gif" alt="">
                        <span class="content-message-info">
                            <span class="content-message-name">ТЕСТ</span>
                            <span class="content-message-text">ТЕСТ?</span>
                        </span>
                        <span class="content-message-more">
                            <span class="content-message-unread">3</span>
                            <span class="content-message-time">10:00</span>
                        </span>
                    </a>
                </li>

            @endif
            @foreach ($allAcceptedContacts as $contact)
            <li>
                <a href="#" class="load-messages" data-contact-id="{{ $contact->id }}" onclick="refreshConversation('{{ $contact->id }}')">
                    <img class="content-message-image" src="{{ $contact->friend->avatar }}" alt="">
                    <span class="content-message-info">
                        <span class="content-message-name">{{ $contact->friend->login }}</span>
                        <span class="content-message-text">
                            {{ $contact->lastMessage ? $contact->lastMessage->content : 'Нет сообщения' }}
                        </span>                                <span class="content-message-more">
                        <span class="content-message-unread">3</span>
                        <span class="content-message-time">10:00</span>
                    </span>
                </a>
            </li>
            @endforeach

        </ul>
    </div>
</div>
