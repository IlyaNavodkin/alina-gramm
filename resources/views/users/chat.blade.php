@extends('alina-layout')

@section('title', 'Чат')

@section('main_content')

<section class="chat-section">
    <div class="chat-container">

        <aside class="chat-sidebar">
            <a href=# class="chat-sidebar-logo">
                <img src="{{ asset('img/chat-logo-sidebar.png') }}" class="logo">
            </a>
            <ul class="chat-sidebar-menu">
                <li class="active"><a href=# data-title="Chats"><i class="ri-chat-3-line"></i></a></li>
                <li><a href="{{ route('dashboard') }}" data-title="Contacts"><i class="ri-contacts-line"></i></a></li>

                <li class="chat-sidebar-profile">
                    <button type="button" class="chat-sidebar-profile-toggle">
                        <img src={{$activeUser->avatar}} alt="">
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
        <!-- end: Sidebar -->
        <!-- start: Content -->
        <div class="chat-content">
            <!-- start: Content side -->
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
                            <a href="#" class="load-messages" data-contact-id="{{ $contact->id }}">
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

            <!-- start: Conversation -->
            <div class="conversation conversation-default active">
                <i class="ri-chat-3-line"></i>
                <p>Пора поболтать? Выбери того, кому хочешь написать!</p>
            </div>

            <div id="conversation-main" >
                <!-- Здесь будет отображаться содержимое чата -->
            </div>


            <script>
                $(document).ready(function () {
                    $(document).on('click', '.load-messages', function (e) {
                        e.preventDefault();

                        var contactId = $(this).data('contact-id');

                        $.ajax({
                            url: '/chat/' + contactId,
                            method: 'GET',
                            success: function (data) {
                                // Очищаем содержимое блока с сообщениями
                                $('#conversation-main').empty();

                                // Добавляем сообщения к блоку с сообщениями
                                $.each(data.contact.messages, function (index, message) {
                                    var isCurrentUser = message.user_id === {{ $activeUser->id }};

                                    var messageHtml = '<div class="conversation-item-wrapper ' + (isCurrentUser ? 'current-user' : 'other-user') + '">';                                    messageHtml += '<div class="conversation-item-box">';
                                    messageHtml += '<div class="conversation-item-text">';
                                    messageHtml += '<p>' + message.content + '</p>';
                                    messageHtml += '</div>';
                                    messageHtml += '<div class="conversation-item-dropdown">';
                                    messageHtml += '<button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>';
                                    messageHtml += '<ul class="conversation-item-dropdown-list">';
                                    messageHtml += '<li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>';
                                    messageHtml += '<li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>';
                                    messageHtml += '</ul>';
                                    messageHtml += '</div>';
                                    messageHtml += '</div>';
                                    messageHtml += '</div>';

                                    // Добавляем сообщение к блоку с сообщениями
                                    $('#conversation-main').append(messageHtml);
                                });

                                // Добавляем верстку для чата
                                var chatHtml = '<div class="conversation">';
                                chatHtml += '<div class="conversation-top">';
                                chatHtml += '<button type="button" class="conversation-back"><i class="ri-arrow-left-line"></i></button>';
                                chatHtml += '<div class="conversation-user">';
                                chatHtml += '<img class="conversation-user-image" src="' + data.contact.friend.avatar + '" alt="">';
                                chatHtml += '<div>';
                                chatHtml += '<div class="conversation-user-name">' + data.contact.friend.login + '</div>';
                                chatHtml += '<div class="conversation-user-status online">online</div>';
                                chatHtml += '</div>';
                                chatHtml += '</div>';
                                chatHtml += '</div>';
                                chatHtml += '<div class="conversation-main">';
                                // ... (здесь код, который добавляет сообщения, уже добавлен)

                                chatHtml += '</div>';
                                chatHtml += '<div class="conversation-form">';
                                chatHtml += '<form method="post" action="{{ route('sendContactMessage') }}" >';
                                chatHtml += '@csrf';
                                chatHtml += '<button type="button" class="conversation-form-button"><i class="ri-emotion-line"></i></button>';
                                chatHtml += '<div class="conversation-form-group">';
                                chatHtml += '<input type="text" name="content" id="content" class="conversation-form-input" rows="1" placeholder="Type here..."></input>';
                                chatHtml += '<input type="hidden" name="contact_id" value="' + contactId + '" id="contact_id" class="conversation-form-input" rows="1" placeholder="Type here..."></input>';                                chatHtml += '<button type="button" class="conversation-form-record"><i class="ri-mic-line"></i></button>';
                                chatHtml += '</div>';
                                chatHtml += '<button type="submit" class="conversation-form-button conversation-form-submit"><i class="ri-send-plane-2-line"></i></button>';
                                chatHtml += '</div>';
                                chatHtml += '</form>';
                                chatHtml += '</div>';

                                // Добавляем верстку чата к блоку с сообщениями
                                $('#conversation-main').prepend(chatHtml);
                                $('.conversation-default').hide();
                                console.log("sdfsdf");
                                console.log(contactId);
                            },
                            error: function (error) {
                                console.error('Ошибка при загрузке сообщений:', error);
                            }
                        });
                    });
                });
            </script>


        </div>
    </div>
</section>
@endsection

