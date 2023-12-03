
@extends('alina-layout')

@section('title', 'Чат')

@section('main_content')
<form method="POST" action="/auth/logout">
    @csrf
    <button type="submit">Logout</button>
</form>
<section class="chat-section">
    <div class="chat-container">

        <aside class="chat-sidebar">
            <a href="#" class="chat-sidebar-logo">
                <img src={{ asset('img/cat_9606314 (1).png') }} class="logo"></img>
            </a>
            <ul class="chat-sidebar-menu">
                <li><a href="chat.html" data-title="Chats"><i class="ri-chat-3-line"></i></a></li>
                <li class="active"><a href="contacts.html" data-title="Contacts"><i class="ri-contacts-line"></i></a></li>

                <li class="chat-sidebar-profile">
                    <button type="button" class="chat-sidebar-profile-toggle">
                        <img src="assets/img/boy.gif" alt="">
                    </button>
                    <ul class="chat-sidebar-profile-dropdown">
                        <li><a href="#" id="open-modal"><i class="ri-user-line"></i>Профиль</a></li>
                        <li><a href="login.html"><i class="ri-logout-box-line"></i> Выйти</a></li>
                    </ul>
                </li>
            </ul>
        </aside>

        <div class="chat-content">

            <div class="content-sidebar">
                <div class="content-sidebar-title">Контакты</div>
                <form action="" class="content-sidebar-form">
                    <input type="search" class="content-sidebar-input" placeholder="Найти...">
                    <button type="submit" class="content-sidebar-submit"><i class="ri-search-line"></i></button>
                </form>
                <!-- Поиск пользователя для добавления -->
                <button id="open-modal-btn" class="add-new-friend">Добавить друга</button>

                    <div id="my-modal" class="modal ">
                        <div class="modal-box">
                            <button class="close-btn" id="close-modal-btn"><i class="ri-close-circle-line"></i></button>
                            <h2 class="modal-title">
                                Введите ник пользователя, которого вы хотите добавить:
                            </h2>
                            <form action="{{ route('contacts.create', ['userId' => $activeUser->id]) }}" method="post" class="content-sidebar-form">
                                @csrf

                                <input type="search" id="find-user" name="login" class="content-sidebar-input" placeholder="Найти...">
                                <button type="submit" class="content-sidebar-submit"><i class="ri-search-line"></i></button>
                            </form>
                            <div class="search-result">
                                <ul class="content-messages-list">
                                    <div class="search-divider"><span>Результаты поиска</span></div>
                                    <!-- карточка друга -->
                                    <li>
                                        <a href="#">
                                            <img class="content-message-image" src="assets/img/boy.gif" alt="">
                                            <span class="content-message-info">
                                                <span class="content-message-name">Илья</span>
                                                <span class="content-message-login">@champforgame</span>
                                            </span>
                                            <button class="add-friend">Отправить запрос</button>
                                        </a>
                                    </li>
                                    <div class="search-divider"><span>Результаты поиска</span></div>
                                    <!-- карточка друга -->
                                    <li>
                                        <a href="#">
                                            <h2 class="modal-headline">Нет результатов</h2>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- second modal wiindow  -->
                    <div id="profile-modal" class="modal ">
                        <div class="modal-box">
                            <button class="close-btn" id="close-modal"><i class="ri-close-circle-line"></i></button>
                            <h2 class="modal-title">
                                Профиль
                            </h2>

                            <div class="search-result">
                                <ul class="profile-list">
                                    <img class="profile-image" src="assets/img/boy.gif" alt="">
                                    <!-- Тут инпут на кнопке  -->
                                    <div class="select-menu">
                                        <form class="select-btn">
                                            <input type="file" value="Заменить изображение" class="sBtn-text"></input>
                                            <!-- <i class="ri-arrow-down-s-fill"></i> -->
                                        </form>
                                    </div>



                                    <li>
                                        <ul class="content-messages-list">
                                            <span class="profile-info">
                                                <span class="profile-item" contenteditable="true">Даша</span>
                                                <span class="profile-item" contenteditable="true">@darbae</span>
                                                <span class="profile-item" contenteditable="true">kitty@darbae.com</span>
                                                <span class="profile-item" contenteditable="true">+7 800 555 35 35</span>

                                            </span>
                                            <span class="but">
                                            <button class="delete-account">Удалить аккаунт</button>
                                            <button class="submit-changes">Сохранить изменения</button>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- конец поиска -->

                <div class="content-messages">
                    <ul class="content-messages-list">
                        <li class="content-message-title my-friend"><span>Друзья</span></li>
                        <!-- карточка друга -->

                        @if($acceptedContacts->count() == 0)
                        <li>

                            <a href="#" data-conversation="#conversation-1">
                                <img class="content-message-image" src="assets/img/boy.gif" alt="">
                                <span class="content-message-info">
                                    <span class="content-message-name">ПУСТО</span>
                                    <span class="content-message-login">Логин</span>
                                </span>

                                <button class="delete-friend">Удалить</button>
                            </a>

                            <form method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger mt-3">Удалить</button>
                            </form>
                        </li>
                        @else
                            @foreach ($acceptedContacts as $contact )
                                <li>
                                    <a href="#" data-conversation="#conversation-1">
                                        <img class="content-message-image" src="assets/img/boy.gif" alt="">
                                        <span class="content-message-info">
                                            <span class="content-message-name">{{$contact->userTo->login}}</span>
                                            <span class="content-message-login">{{$contact->userTo->email}}</span>
                                        </span>
                                        <button class="delete-friend">Удалить</button>
                                    </a>

                                    <form action="{{ route('contacts.delete', ['userIdFrom' => $contact->userFrom->id, 'userIdTo' => $contact->userTo->id]) }}"  method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger mt-3">Удалить</button>
                                    </form>

                                </li>

                            @endforeach
                        @endif



                        <!-- конец карточки -->

                        {{-- <!-- карточка друга -->
                        <li>
                            <a href="#" data-conversation="#conversation-2">
                                <img class="content-message-image" src="assets/img/virgo.gif" alt="">
                                <span class="content-message-info">
                                    <span class="content-message-name">Даша</span>
                                    <span class="content-message-login">@darbae</span>
                                </span>
                                <button class="delete-friend">Удалить</button>

                            </a>
                        </li>
                        <!-- конец карточки --> --}}
                    </ul>
                    <ul class="content-messages-list">
                        <li class="content-message-title stranger"><span>Заявки</span></li>
                        <!-- карточка друга -->
                        @if($commingContacts->count() == 0)
                        <li>

                            <a href="#" data-conversation="#conversation-1">
                                <img class="content-message-image" src="assets/img/boy.gif" alt="">
                                <span class="content-message-info">
                                    <span class="content-message-name">ПУСТО</span>
                                    <span class="content-message-login">Логин</span>
                                </span>

                                <button class="status-friend">Запрошено</button>
                                <form  method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger mt-3">Отклонить</button>
                                </form>

                            </a>
                        </li>
                        @else
                            @foreach ($commingContacts as  $contact )
                                <li>
                                    <a href="#" data-conversation="#conversation-1">
                                        <img class="content-message-image" src="assets/img/boy.gif" alt="">
                                        <span class="content-message-info">
                                            <span class="content-message-name">{{$contact->userTo->login}}</span>
                                            <span class="content-message-login">{{$contact->userTo->email}}</span>
                                        </span>

                                        <button class="status-friend">Запрошено</button>

                                    </a>
                                </li>

                            @endforeach
                        @endif

                        <!-- конец карточки -->

                        <!-- карточка друга -->
                            {{-- <li>
                                <a href="#" data-conversation="#conversation-1">
                                <img class="content-message-image" src="assets/img/boy.gif" alt="">
                                <span class="content-message-info">
                                    <span class="content-message-name">Имя</span>
                                    <span class="content-message-login">Логин</span>
                                </span> --}}

                        @if($pendingContacts->count() == 0)
                            <li>
                                <a href="#" data-conversation="#conversation-1">
                                    <img class="content-message-image" src="assets/img/boy.gif" alt="">
                                    <span class="content-message-info">
                                        <span class="content-message-name">ПУСТО</span>
                                        <span class="content-message-login">Логин</span>
                                    </span>

                                    <form  method="post">
                                        @csrf
                                        <button type="submit" class="accept"><i class="ri-add-line"></i></button>
                                    </form>
                                    <form   method="post">
                                        @csrf
                                        <button  type="submit" class="reject"><i class="ri-user-unfollow-line"></i></button>
                                    </form>

                                </a>
                            </li>
                        @else
                            @foreach ($pendingContacts as $contact )
                            <li>
                                <a  data-conversation="#conversation-2">
                                    <img class="content-message-image" src="assets/img/virgo.gif" alt="">
                                    <span class="content-message-info">
                                        <span class="content-message-name">{{$contact->userFrom->login}}</span>
                                    </span>
                                    {{-- <button class="accept"><i class="ri-add-line"></i></button>
                                    <button class="reject"><i class="ri-user-unfollow-line"></i></button> --}}
                                </a>

                                <form action="{{ route('contacts.accept', ['userIdFrom' => $contact->userFrom->id, 'userIdTo' => $contact->userTo->id]) }}"  method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-success mt-3">Принять</button>
                                </form>
                                <form action="{{ route('contacts.delete', ['userIdFrom' => $contact->userFrom->id, 'userIdTo' => $contact->userTo->id]) }}"  method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger mt-3">Отклонить</button>
                                </form>
                            </li>

                            @endforeach
                        @endif
                        <!-- конец карточки -->
                    </ul>
                </div>
            </div>

            <!-- диалоговое окно дефолт -->
            <div class="conversation conversation-default active">
                <i class="ri-chat-3-line"></i>
                <p>Пора поболтать? Выбери того, кому хочешь написать!</p>
            </div>
            <!-- конец дефолт окна -->
            <!-- диалоговое окно с сообщениями -->
            <div class="conversation" id="conversation-1">
                <div class="conversation-top">
                    <button type="button" class="conversation-back"><i class="ri-arrow-left-line"></i></button>
                    <div class="conversation-user">

                        <div>
                            <div class="conversation-user-name">Илья</div>
                            <div class="conversation-user-status online">online</div>
                        </div>
                    </div>
                    <div class="conversation-buttons">

                        <button type="button"><i class="ri-information-line"></i></button>
                        <button type="button"><i class="ri-close-circle-line"></i></button>
                    </div>
                </div>
                <div class="conversation-main">
                    <ul class="conversation-wrapper">
                        <div class="coversation-divider"><span>Среда</span></div>
                        <li class="conversation-item me">
                            <div class="conversation-item-side">

                            </div>
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

                                                <li<li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
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

                                                <li<li><a href="#"><i class="ri-share-forward-line"></i>Ответить</a></li>
                                                <li><a href="#"><i class="ri-delete-bin-line"></i> Удалить</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="conversation-item">
                            <div class="conversation-item-side">

                            </div>
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
                            <div class="conversation-item-side">

                            </div>
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
                    <div class="conversation-buttons">
                        <button type="button"><i class="ri-information-line"></i></button>
                    </div>
                </div>
                <div class="conversation-main">
                    <ul class="conversation-wrapper">
                        <li class="conversation-item me">
                            <div class="conversation-item-side">

                            </div>
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
                            <div class="conversation-item-side">

                            </div>
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

