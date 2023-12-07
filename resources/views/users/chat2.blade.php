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
                <li class="active"><a href="chat.html" data-title="Chats"><i class="ri-chat-3-line"></i></a></li>
                <li><a href="{{ route('dashboard') }}" data-title="Contacts"><i class="ri-contacts-line"></i></a></li>

                <li class="chat-sidebar-profile">
                    <button type="button" class="chat-sidebar-profile-toggle">
                        <img src="assets/img/boy.gif" alt="">
                    </button>
                    <ul class="chat-sidebar-profile-dropdown">
                        <li><a href="#"><i class="ri-user-line"></i>Профиль</a></li>
                        <li><a href="#"><i class="ri-logout-box-line"></i> Выйти</a></li>
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
                                <img class="content-message-image" src="assets/img/boy.gif" alt="">
                                <span class="content-message-info">
                                    <span class="content-message-name">{{ $contact->friend->login }}</span>
                                    <span class="content-message-text">{{ $contact->lastMessage->content }}</span>
                                </span>
                                <span class="content-message-more">
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
                <div class="conversation" id="conversation-1">
                    <div class="conversation-top">
                        <button type="button" class="conversation-back"><i class="ri-arrow-left-line"></i></button>
                        <div class="conversation-user">
                            <img class="conversation-user-image" src="assets/img/boy.gif" alt="">
                            <div>
                                <div class="conversation-user-name">Илья</div>
                                <div class="conversation-user-status online">online</div>
                            </div>
                        </div>

                    </div>
                    <div class="conversation-main">
                        <ul class="conversation-wrapper">
                            <div class="coversation-divider"><span>Среда</span></div>
                            <li class="conversation-item me">

                                <div class="conversation-item-content">
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Слушай, а сегодня мы разве не собирались на каток?</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">

                                                    <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Взяли официальный комментарий у дизайнера нового лого Яндекс Музыки: Мне пофиг, я так чувствую!</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">

                                                    <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="conversation-item">

                                <div class="conversation-item-content">
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Коты-диверсанты закрыли москвичку на холодном балконе в одном халате</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">

                                                    <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Пушистые злодеи захлопнули дверь за своей 61-летней хозяйкой, когда она буквально на пару мгновений выскочила на балкон. </p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">

                                                    <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Попытки вернуться в комнату самостоятельно не увенчались успехом, а коты лишь любовались на хозяйку через стекло. Женщина попросила о помощи прохожих, которые вызвали спасателей — пришлось вскрывать дверь, всё закончилось благополучно.</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">

                                                    <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <div class="coversation-divider"><span>Сегодня</span></div>
                            <li class="conversation-item me">

                                <div class="conversation-item-content">
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Солнце внезапно «треснуло и порвалось» 🚬
                                                    </p>
                                                <div class="conversation-item-time">10:00</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">

                                                    <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p> На светиле образовалась колоссальная корональная дыра, которая разразилась сильнейшей вспышкой M9.82. </p>
                                                <div class="conversation-item-time">10:00</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">

                                                    <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Землю ожидает мощная геомагнитная буря и яркие полярные сияния. Помянем всех метеозависимых.</p>
                                                <div class="conversation-item-time">10:00</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">

                                                    <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="conversation-form">
                        <button type="button" class="conversation-form-button"><i class="ri-emotion-line"></i></button>
                        <div class="conversation-form-group">
                            <textarea class="conversation-form-input" rows="1" placeholder="Type here..."></textarea>
                            <button type="button" class="conversation-form-record"><i class="ri-mic-line"></i></button>
                        </div>
                        <button type="button" class="conversation-form-button conversation-form-submit"><i class="ri-send-plane-2-line"></i></button>
                    </div>
                </div>
                <div class="conversation" id="conversation-2">
                    <div class="conversation-top">
                        <button type="button" class="conversation-back"><i class="ri-arrow-left-line"></i></button>
                        <div class="conversation-user">
                            <div>
                                <div class="conversation-user-name">Даша</div>
                                <div class="conversation-user-status online">online</div>
                            </div>
                        </div>
                    </div>
                    <div class="conversation-main">
                        <ul class="conversation-wrapper">
                            <li class="conversation-item me">

                                <div class="conversation-item-content">
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Подъехали спойлеры на 2024 год: в Китае вспышка нового крайне заразного вируса-мутанта — ежедневно госпитализируют по 7000 человек, также присутствует высокий риск распространения по миру</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">

                                                    <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Симптомы нового вируса:

                                                    — Озноб;
                                                    — Высокая температура;
                                                    — Образование «узелков» в лёгких;
                                                    — Отсутствие кашля.</p>
                                                    <div class="conversation-item-time">12:30</div>
                                                </div>
                                                <div class="conversation-item-dropdown">
                                                    <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                    <ul class="conversation-item-dropdown-list">

                                                        <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                        <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="conversation-item">
                                    <div class="conversation-item-side">
                                        <img class="conversation-item-image" src="assets/img/boy.gif" alt="">
                                    </div>
                                    <div class="conversation-item-content">
                                        <div class="conversation-item-wrapper">
                                            <div class="conversation-item-box">
                                                <div class="conversation-item-text">
                                                    <p>Изначально симптомы проявлялись только у детей, но потом их стали обнаруживать и у взрослых.</p>
                                                    <div class="conversation-item-time">12:30</div>
                                                </div>
                                                <div class="conversation-item-dropdown">
                                                    <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">
                                                    <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Больницы в Пекине и Ляонине переполнены, занятия в школах отменили на неопределённый срок, врачам увеличили количество рабочих часов, а власти Китая пытаются сгладить ситуацию и выяснить происхождение вируса как можно быстрее.</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">
                                                    <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </li>
                            <div class="coversation-divider"><span>Сегодня</span></div>
                            <li class="conversation-item me">

                                <div class="conversation-item-content">
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Не ждём, а готовимся 😐</p>
                                                <div class="conversation-item-time">9:28</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">
                                                    <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Сегодня на удаленке кстати</p>
                                                <div class="conversation-item-time">9:28</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">
                                                    <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="conversation-form">
                        <button type="button" class="conversation-form-button"><i class="ri-emotion-line"></i></button>
                        <div class="conversation-form-group">
                            <textarea class="conversation-form-input" rows="1" placeholder="Type here..."></textarea>

                        </div>
                        <button type="button" class="conversation-form-button conversation-form-submit"><i class="ri-send-plane-2-line"></i></button>
                    </div>
                </div>


            <!-- start: Conversation -->
            <div class="conversation conversation-default active">
                <i class="ri-chat-3-line"></i>
                <p>Пора поболтать? Выбери того, кому хочешь написать!</p>
            </div>
            <div class="conversation" id="conversation-1">
                <div class="conversation-top">
                    <button type="button" class="conversation-back"><i class="ri-arrow-left-line"></i></button>
                    <div class="conversation-user">
                        <img class="conversation-user-image" src="assets/img/boy.gif" alt="">
                        <div>
                            <div class="conversation-user-name">Илья</div>
                            <div class="conversation-user-status online">online</div>
                        </div>
                    </div>

                </div>





                <div class="conversation-main" id="conversation-main">
                    <h1>asdasasdasdasd</h1>
                </div>
                <div class="conversation-main" id="conversation-main">
                    @foreach ($contact->messages as $message)
                        @if($message->user_id == Auth::user()->id)
                            <div class="conversation-item-box">
                                <div class="conversation-item-text">
                                    <p>{{$message->content}}</p>
                                    <div class="conversation-item-time">2222</div>
                                </div>
                                <div class="conversation-item-dropdown">
                                    <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                    <ul class="conversation-item-dropdown-list">

                                        <li<li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                        <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                    </ul>
                                </div>
                            </div>
                        @else
                            <div class="conversation-item-box">
                                <div class="conversation-item-text">
                                    <h4>{{$message->content}}</h4>
                                    <div class="conversation-item-time">12:34</div>
                                </div>
                                <div class="conversation-item-dropdown">
                                    <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                    <ul class="conversation-item-dropdown-list">

                                        <li<li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                        <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                    </ul>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <script>
                    $(document).ready(function() {

                        $(document).on('click', '.load-messages', function (e) {
                            e.preventDefault();

                            var contactId = $(this).data('contact-id');

                            $.ajax({
                                url: '/chat/' + contactId,
                                method: 'GET',
                                success: function (data) {
                                    // Обновляем содержимое блока с сообщениями
                                    $('#conversation-main').html('');
                                    console.log(data.messages);
                                    $.each(data.messages, function(index, message) {
                                        var html = '<div class="conversation-item-box">';
                                        html += '<div class="conversation-item-text">';
                                        html += '<p>' + message.content + '</p>';
                                        html += '<div class="conversation-item-time">' + message.created_at + '</div>';
                                        html += '</div>';
                                        html += '<div class="conversation-item-dropdown">';
                                        html += '<button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>';
                                        html += '<ul class="conversation-item-dropdown-list">';
                                        html += '<li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>';
                                        html += '<li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>';
                                        html += '</ul>';
                                        html += '</div>';
                                        html += '</div>';

                                        // Добавляем сообщение к блоку с сообщениями
                                        $('#conversation-main').append(html);
                                    });


                                },

                                error: function (error) {
                                    console.error('Ошибка при загрузке сообщений:', error);
                                }
                            });



                        });
                    });
                </script>


                <div class="conversation-form">
                    <button type="button" class="conversation-form-button"><i class="ri-emotion-line"></i></button>
                    <div class="conversation-form-group">
                        <textarea class="conversation-form-input" rows="1" placeholder="Type here..."></textarea>
                        <button type="button" class="conversation-form-record"><i class="ri-mic-line"></i></button>
                    </div>
                    <button type="button" class="conversation-form-button conversation-form-submit"><i class="ri-send-plane-2-line"></i></button>
                </div>
            </div>
            <div class="conversation" id="conversation-2">
                <div class="conversation-top">
                    <button type="button" class="conversation-back"><i class="ri-arrow-left-line"></i></button>
                    <div class="conversation-user">
                        <div>
                            <div class="conversation-user-name">Даша</div>
                            <div class="conversation-user-status online">online</div>
                        </div>
                    </div>
                </div>
                <div class="conversation-main">
                    <ul class="conversation-wrapper">
                        <li class="conversation-item me">

                            <div class="conversation-item-content">
                                <div class="conversation-item-wrapper">
                                    <div class="conversation-item-box">
                                        <div class="conversation-item-text">
                                            <p>Подъехали спойлеры на 2024 год: в Китае вспышка нового крайне заразного вируса-мутанта — ежедневно госпитализируют по 7000 человек, также присутствует высокий риск распространения по миру</p>
                                            <div class="conversation-item-time">12:30</div>
                                        </div>
                                        <div class="conversation-item-dropdown">
                                            <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                            <ul class="conversation-item-dropdown-list">

                                                <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="conversation-item-wrapper">
                                    <div class="conversation-item-box">
                                        <div class="conversation-item-text">
                                            <p>Симптомы нового вируса:

                                                — Озноб;
                                                — Высокая температура;
                                                — Образование «узелков» в лёгких;
                                                — Отсутствие кашля.</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                                <ul class="conversation-item-dropdown-list">

                                                    <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                    <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="conversation-item">
                                <div class="conversation-item-side">
                                    <img class="conversation-item-image" src="assets/img/boy.gif" alt="">
                                </div>
                                <div class="conversation-item-content">
                                    <div class="conversation-item-wrapper">
                                        <div class="conversation-item-box">
                                            <div class="conversation-item-text">
                                                <p>Изначально симптомы проявлялись только у детей, но потом их стали обнаруживать и у взрослых.</p>
                                                <div class="conversation-item-time">12:30</div>
                                            </div>
                                            <div class="conversation-item-dropdown">
                                                <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                            <ul class="conversation-item-dropdown-list">
                                                <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                                <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="conversation-item-wrapper">
                                    <div class="conversation-item-box">
                                        <div class="conversation-item-text">
                                            <p>Больницы в Пекине и Ляонине переполнены, занятия в школах отменили на неопределённый срок, врачам увеличили количество рабочих часов, а власти Китая пытаются сгладить ситуацию и выяснить происхождение вируса как можно быстрее.</p>
                                            <div class="conversation-item-time">12:30</div>
                                        </div>
                                        <div class="conversation-item-dropdown">
                                            <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                            <ul class="conversation-item-dropdown-list">
                                                <li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </li>
                        <div class="coversation-divider"><span>Сегодня</span></div>
                        <li class="conversation-item me">

                            <div class="conversation-item-content">
                                <div class="conversation-item-wrapper">
                                    <div class="conversation-item-box">
                                        <div class="conversation-item-text">
                                            <p>Не ждём, а готовимся 😐</p>
                                            <div class="conversation-item-time">9:28</div>
                                        </div>
                                        <div class="conversation-item-dropdown">
                                            <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                            <ul class="conversation-item-dropdown-list">
                                                <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                                <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="conversation-item-wrapper">
                                    <div class="conversation-item-box">
                                        <div class="conversation-item-text">
                                            <p>Сегодня на удаленке кстати</p>
                                            <div class="conversation-item-time">9:28</div>
                                        </div>
                                        <div class="conversation-item-dropdown">
                                            <button type="button" class="conversation-item-dropdown-toggle"><i class="ri-more-2-line"></i></button>
                                            <ul class="conversation-item-dropdown-list">
                                                <li><a href="#"><i class="ri-share-forward-line"></i> Forward</a></li>
                                                <li><a href="#"><i class="ri-delete-bin-line"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="conversation-form">
                    <button type="button" class="conversation-form-button"><i class="ri-emotion-line"></i></button>
                    <div class="conversation-form-group">
                        <textarea class="conversation-form-input" rows="1" placeholder="Type here..."></textarea>

                    </div>
                    <button type="button" class="conversation-form-button conversation-form-submit"><i class="ri-send-plane-2-line"></i></button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

