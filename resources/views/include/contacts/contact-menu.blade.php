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

                <form id="searchForm" class="content-sidebar-form">
                    @csrf
                    <input type="search" id="login" name="login" class="content-sidebar-input" placeholder="Найти...">
                    <button type="button" onclick="searchUsers()" class="content-sidebar-submit"><i class="ri-search-line"></i></button>
                </form>

                <div class="search-result">
                    <ul class="content-messages-list">
                        <div class="search-divider"><span>Результаты поиска</span></div>
                        <!-- карточка друга -->
                        <div id="searchResults"></div>
                        <div id="friendRequestMessage"></div>
                        <div id="errorMessage"></div>

                    </ul>
                </div>
                <script>
                    function searchUsers() {
                        var login = document.getElementById('login').value;
                        var url = '/users/findByLogin';

                        // Получение токена CSRF из мета-тега
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');

                        // Выполнение AJAX-запроса с токеном CSRF
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: { login: login },
                            headers: { 'X-CSRF-TOKEN': csrfToken },
                            success: function(data) {
                                if (data.users.length > 0) {
                                    console.log("Нету");
                                    // Генерация HTML для каждого пользователя
                                    var html = '<ul>';
                                    data.users.forEach(function(user) {
                                        html += '<li>';
                                        html += '<a href="#">';
                                        html += '<img class="content-message-image" src="' + user.avatar + '" alt="">';
                                        html += '<span class="content-message-info">';
                                        html += '<span class="content-message-name">' + user.login + '</span>';
                                        html += '</span>';
                                        // Добавление кнопки с отправкой запроса и id пользователя
                                        html += '<button class="add-friend" onclick="sendFriendRequest(' + user.id + ')">Отправить запрос</button>';
                                        html += '</a>';
                                        html += '</li>';
                                    });
                                    html += '</ul>';

                                    // Обновление части страницы с результатами
                                    $('#searchResults').html(html);
                                } else {
                                    console.log("Пусто");
                                    // Вывод сообщения, если нет пользователей
                                    $('#searchResults').html('<p>No users found.</p>');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                // Вывод сообщения об ошибке на странице
                                $('#errorMessage').html('<p>Error occurred. Please try again later.</p>');
                            }
                        });
                    }

                    // Функция для отправки запроса на добавление в друзья с использованием id пользователя
                    function sendFriendRequest(userId) {
                        var url = '/contacts/create';  // Замените на ваш путь к обработчику запроса на сервере

                        // Получение токена CSRF из мета-тега
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');

                        // Выполнение AJAX-запроса с токеном CSRF и id пользователя
                        $.post(url, { userId: userId, _token: csrfToken }, function(response) {
                            // Обновление элемента с сообщением об успехе или ошибке
                            if (response.error) {
                                // Если есть ошибка, выводим сообщение об ошибке
                                $('#errorMessage').html('<p>' + response.error + '</p>');
                            } else {
                                // В противном случае, выводим сообщение об успехе
                                $('#successMessage').html('<p>' + response.message + '</p>');
                            }
                        })
                        .fail(function(xhr) {
                            // Обработка ошибок при отправке запроса на добавление в друзья
                            console.error(xhr.responseText);

                            var decodedError = $('<div/>').html(xhr.responseJSON.error).text();

                            // Вывод сообщения об ошибке на странице
                            $('#errorMessage').html('<p>' + decodedError + '</p>');
                        });
                    }
                </script>
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
                        <img class="profile-image" src={{$activeUser->avatar}} alt="">
                        <!-- Тут инпут на кнопке  -->
                        <div class="select-menu">
                            <form class="select-btn" action="{{ route('users.uploadAvatar') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input name="id" id="id" class="form-control"  type="hidden" value="{{ $activeUser->id }}">

                                <div class="mb-3">
                                    <input class="sBtn-text" type="file" name="image" id="image" accept="image/*">
                                </div>

                                <button class="submit-changes" type="submit">Загрузить</button>
                            </form>
                        </div>



                        <li>
                            <ul class="content-messages-list">
                                <span class="profile-info">
                                    {{-- <span class="profile-item" contenteditable="true">{{$activeUser->login}}</span>
                                    <span class="profile-item" contenteditable="true">{{$activeUser->email}}</span>
                                    <span class="profile-item" contenteditable="true">{{$activeUser->phone}}</span> --}}


                                    @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                    @endif

                                    <form method="post" action="/users/edit">
                                        @csrf

                                        <input name="id" id="id" class="form-control"  type="hidden" value="{{ $activeUser->id }}">

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Электронный адресс:</label>
                                            <br>
                                            <input type="email" name="email" id="email" placeholder="Введите email" class="profile-item" contenteditable="true"
                                            value="{{ $activeUser->email }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Номер телефона:</label>
                                            <br>
                                            <input type="text" name="phone" id="phone" placeholder="Введите phone" class="profile-item" contenteditable="true"
                                            value="{{ $activeUser->phone }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="login" class="form-label">Логин:</label>
                                            <br>
                                            <input type="text" name="login" id="login" placeholder="Введите login" class="profile-item" contenteditable="true"
                                            value="{{ $activeUser->login }}">
                                        </div>


                                        </span>
                                        <span class="but">

                                        <a type="submit" class="delete-account" >Удалить аккаунт</a>
                                        <button type="submit" class="submit-changes">Сохранить изменения</button>

                                    </form>
                                </span>
                            </ul>
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
                    <img class="content-message-image" src={{ asset('img/chat-logo-sidebar.png') }} alt="">
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
                    <img class="content-message-image" src={{ asset('img/chat-logo-sidebar.png') }} alt="">
                    <span class="content-message-info">
                        <span class="content-message-name">ПУСТО</span>
                        <span class="content-message-login">Логин</span>
                    </span>

                    <button class="status-friend">Запрошено</button>
                </a>
            </li>
            @else
                @foreach ($commingContacts as  $contact )
                    <li>
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
                        <img class="content-message-image" src={{ asset('img/chat-logo-sidebar.png') }} alt="">
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
