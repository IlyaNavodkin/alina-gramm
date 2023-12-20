<div class="content-sidebar">
    <div class="content-sidebar-title">Контакты</div>
    <form action="" class="content-sidebar-form">
        <input type="search" class="content-sidebar-input" placeholder="Найти...">
        <button type="submit" class="content-sidebar-submit"><i class="ri-search-line"></i></button>
    </form>
    <!-- Поиск пользователя для добавления -->
    <button id="open-modal-btn" class="add-new-friend">Добавить друга</button>

        @include('include\contacts\find-users\modal-window') {{-- Модальное окно поиска контактов --}}

        <!-- second modal wiindow  -->


        <!-- конец поиска -->

    <div class="content-messages">
        <ul class="content-messages-list">
            <!-- карточка друга -->

            @if($acceptedContacts->count() == 0)
            @else
                <li class="content-message-title my-friend"><span>Друзья</span></li>

                @foreach ($acceptedContacts as $contact )
                <li data-login = "{{ $contact->friend->login }}" id = "accepted-contact-list-element-{{ $contact->friend->login }}">
                    <div href="#" data-conversation="#conversation-1">
                        <img class="content-message-image" src={{ $contact->friend->avatar }} alt="">
                        <span class="content-message-info">
                            <span class="content-message-name">{{$contact->friend->login}}</span>
                            <span class="content-message-login">{{$contact->friend->email}}</span>
                        </span>
                    </div>

                    <form action="{{ route('contacts.delete',  ['contactId' => $contact->id]) }}"  method="post">
                        @csrf
                        <button type="submit" class="delete-friend">Удалить</button>
                    </form>

                </li>

                @endforeach
            @endif



            <!-- конец карточки -->

        </ul>
        <ul class="content-messages-list">
            <!-- карточка друга -->
            @if($commingContacts->count() == 0)
            @else
                <li class="content-message-title stranger"><span>Исходящие заявки</span></li>

                @foreach ($commingContacts as  $contact )
                    <li data-login = "{{ $contact->friend->login }}" id = "comming-contact-list-element-{{ $contact->friend->login }}">
                        <a href="#" data-conversation="#conversation-1">
                            <img class="content-message-image" src={{ $contact->userTo->avatar }} alt="">
                            <span class="content-message-info">
                                <span class="content-message-name">{{$contact->userTo->login}}</span>
                                <span class="content-message-login">{{$contact->userTo->email}}</span>
                            </span>

                            <button class="status-friend">Запрошено</button>

                        </a>
                    </li>
                    <form  method="post" action="{{ route('contacts.delete',  ['contactId' => $contact->id]) }}">
                        @csrf
                        <button type="submit" class="btn btn-danger mt-3">Отклонить</button>
                    </form>

                @endforeach
            @endif

            <!-- конец карточки -->


            @if($pendingContacts->count() == 0)
            @else
                <li class="content-message-title stranger"><span>Входящие заявки</span></li>

                @foreach ($pendingContacts as $contact )
                <li data-login = "{{ $contact->friend->login }}" id = "pending-contact-list-element-{{ $contact->friend->login }}">
                    <a  data-conversation="#conversation-2">
                        <img class="content-message-image" src={{ $contact->userFrom->avatar }} alt="">
                        <span class="content-message-info">
                            <span class="content-message-name">{{$contact->userFrom->login}}</span>
                            <span class="content-message-login">{{$contact->userFrom->email}}</span>
                        </span>
                        {{-- <button class="accept"><i class="ri-add-line"></i></button>
                        <button class="reject"><i class="ri-user-unfollow-line"></i></button> --}}
                    </a>

                    <form action="{{ route('contacts.accept', ['contactId' => $contact->id]) }}"  method="post">
                        @csrf
                        <button type="submit" class="btn btn-success mt-3">Принять</button>
                    </form>
                    <form action="{{ route('contacts.delete',  ['contactId' => $contact->id]) }}"  method="post">
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
