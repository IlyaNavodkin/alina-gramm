
@if(count($users) == 0)
    <li>Пользователи не найдены</li>
@else
    @foreach ($users as $user)
        <li >
            <a href="#" class="strangers">
                <img class="content-message-image" src="{{ $user['avatar'] }}" alt="">
                <span class="content-message-info">
                    <span class="content-message-name">{{ $user['login'] }}</span>
                </span>
                <button class="add-friend" onclick="sendFriendRequest({{ $user['id'] }})">Отправить запрос</button>
            </a>
        </li>
    @endforeach
@endif

