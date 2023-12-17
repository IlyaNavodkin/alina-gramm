<ul>
    @foreach ($users as $user)
        <li>
            <a href="#">
                <img class="content-message-image" src="{{ $user['avatar'] }}" alt="">
                <span class="content-message-info">
                    <span class="content-message-name">{{ $user['login'] }}</span>
                </span>
                <button class="add-friend" onclick="sendFriendRequest({{ $user['id'] }})">Отправить запрос</button>
            </a>
        </li>
    @endforeach
</ul>
